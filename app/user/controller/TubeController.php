<?php

namespace app\user\controller;

use app\communal\Count;
use cmf\controller\UserBaseController;
use MingYuanYun\AppStore\Client;
use think\Db;
use Qiniu\entry;
use Qiniu\Auth;

class TubeController extends UserBaseController
{

    function _initialize(){
        parent::_initialize();
    }

    public function index()
    {
        $uid       = session('user.id');
        $userInfo  = Db::name("user")->where("id",$uid)->find();

        //设备列表
        $appResult = Db::name("user_posted")
            ->where('uid',$uid)
            ->where('status', '<',2)
            ->order("id desc")
            ->select();

        //今日IOS装机量
        $todayApp= Db::name('ios_udid_list')
            ->where('user_id',$uid)
            ->whereTime('create_time','today')
            ->count();

        //总共装机数量
        $allApp  = Db::name('ios_udid_list')
            ->where('user_id',$uid)
            ->count();

        //总共装机数量
        $allApp  = Db::name('ios_udid_list')
            ->where('user_id',$uid)
            ->count();

        //今日下载数量
        $todayDownload = Db::name('super_download_log')
            ->where('uid',$uid)
            ->whereTime('addtime','today')
            ->count();

        //总共下载数量
        $allDownload = Db::name('super_download_log')
            ->where('uid',$uid)
            ->count();

        //获取7天的下载数据
       $week = Count::getDays(7);
       $list = Count::getDownCounByWeek($uid,7,true);

        $data_arr = [];
        foreach ($week as $k=>$v){
            if(isset($list['count_down'][$v])){
                $data_arr['count_udid'][]= $list['count_udid'][$v];
                $data_arr['count_down'][]= $list['count_down'][$v];
            }else{
                $data_arr['count_udid'][] = 0;
                $data_arr['count_down'][] = 0;
            }
        }
       
        $this->assign([
            'week'         => json_encode($week),
            'count_udid'   => json_encode($data_arr['count_udid']),
            'count_down'   => json_encode($data_arr['count_down']),
            'assets'       => $appResult,
            'todayApp'     => $todayApp,
            'allApp'       => $allApp,
            'todayDownload'=> $todayDownload,
            'allDownload'  => $allDownload,
            'user'         => $userInfo,
            'nav'          => 'tube',
            'config'       => get_config()
        ]);

        return $this->fetch();
    }

    //超级签应用详情
    public function sup_details($id){
        $user_id   = session('user.id');
        $tab = input('tab');
        $supResult = Db::name("user_posted")
            ->where('id',$id)
            ->where('uid',$user_id)
            ->find();

        if(!$supResult){
            $this->error('页面不存在!');
        }

        //超级签
        $appCount = Db::name('ios_udid_list')
            ->where('user_id',$user_id)
            ->where('app_id',$id)
            ->count();

        $this->assign([
            'appCount'     => $appCount,
            'assets'       => $supResult,
            'nav'          => 'tube',
            'id'           => $id,
            'tab'         =>$tab
        ]);

        return $this->fetch();
    }

    
    //获取数据统计接口
    public function get_sup_details_data($id,$type){
        $user_id   = get_user('id');  // || session('user.id');
        $data      = [];
        if($type=='sup'){
            //超级签
            $data = Db::name('ios_udid_list')
                ->where('user_id',$user_id)
                ->where('app_id',$id)
                ->paginate(10)
                ->each(function($item){
                    $item['create_time'] = date('Y-m-d',$item['create_time']);
                    return $item;
                })
                ->toArray();
        }else if($type == 'old'){
            $data = Db::name('user_posted_log')
                ->where('uid',$user_id)
                ->where('posted_id',$id)
                ->paginate(10)
                ->each(function($item){
                    $item['creattime'] = date('Y-m-d',$item['creattime']);
                    //下载次数
                    $item['version'] = $item['version']?$item['version']:0;
                    $down_count = Db::name('super_download_log')->where('app_id = '.$item['posted_id'].' and version = \''.$item['version'].'\'')->count();
                    $uuid_count = Db::name('ios_udid_list')->where('app_id = '.$item['posted_id'].' and version = \''.$item['version'].'\'')->count();
                    $item['down_count']=$down_count;
                    $item['uuid_count']=$uuid_count;
                    return $item;
                })
                ->toArray();
        }else if($type == 'down'){
            $data = Db::name('super_download_log')
                ->where('uid',$user_id)
                ->where('app_id',$id)
                ->paginate(10)
                ->each(function($item){
                    $item['addtime'] = date('Y-m-d',$item['addtime']);
                    return $item;
                })
                ->toArray();
        }else if($type == 'hb'){
            $data = Db::name('user_posted')
                ->where('uid',$user_id)
                ->where('id',$id)
                ->field('andriod_url')
                ->find();
            if($data['andriod_url']){
                if(strpos($data['andriod_url'],'http') === false && strpos($data['andriod_url'],'https') === false){
                    $userInfo = upd_tok_config();
                    $data['andriod_url'] = 'http://'.$userInfo['domain'].'/'.$data['andriod_url'];
                }
            }

        }

        return json($data);
    }

    //应用状态修改
    public function sup_status_update(){
        $uid = get_user('id');
        $id  = input('id');

        $data['status'] = input('status');

        $result = Db::name('user_posted')
            ->where('uid',$uid)
            ->where('id',$id)
            ->update($data);

        return $result?json(['code'=>200]):json(['code'=>0]);
    }

    //应用合并上传安卓包
    public function sup_upload_apk(){
        $id          = input('id');
        $uid         = get_user('id');
        $file        = request()->file('file');
        $andriod_url = input('andriod_url');

        if($file){
            $filename_new = md5(time()).'.apk';
            $path = ROOT_PATH.'public/upload/super_signature/'.date('Ymd',time()).'/';
            $info = $file->validate(['ext'=>'apk'])->move($path,$filename_new);
            if($info){
                $res = upd_tok($path.$filename_new,$filename_new);
                if($res['code']==200){
                    //删除本地文件
                    $real_path = $info->getRealPath();
                    unset($info);
                    unlink($real_path);
                    //写入
                    Db::name('user_posted')
                        ->where('uid',$uid)
                        ->where('id',$id)
                        ->update(['andriod_url'=>$res['url']]);
                    return json(['code'=>200,'msg'=>'上传成功','url'=>$res['all_url']]);
                }else{
                    return json(['code'=>0,'msg'=>'上传失败']);
                }
            }
        }else if($andriod_url){
            Db::name('user_posted')
                ->where('uid',$uid)
                ->where('id',$id)
                ->update(['andriod_url'=>$andriod_url]);
            return json(['code'=>200,'msg'=>'上传成功']);
        }
    }

    //超级签应用详情修改
    public function sup_details_update(){
        $uid  = get_user('id');
        $data = input('post.');
        $id   = $data['id'];
        if(isset($data['status'])){
            $data['status'] = $data['status']=='on' ? 1 : 0;
        }
        unset($data['id']);
        $result = Db::name('user_posted')
            ->where('uid',$uid)
            ->where('id',$id)
            ->update($data);

        return $result ? json(['code'=>200]) : json(['code'=>0]);
    }

    public function delApp($id){
        $uid    = session('user.id');
        $record = Db::name("user_posted")->where('uid', $uid)->where("id=" . $id)->find();

        if (!$record) {
            $this->error('应用不存在！');
        }

        $result = Db::name("user_posted")->where("id=" . $id)->update(['status'=>3]);

        if ($result) {
            return json(['code'=>200,'msg'=>'删除成功']);
        } else {
            return json(['code'=>0,'msg'=>'删除失败']);
        }
    }
}
