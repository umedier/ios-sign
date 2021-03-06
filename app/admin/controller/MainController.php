<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;

class MainController extends AdminBaseController
{

    /**
     *  后台欢迎页
     */
    public function index()
    {
        $time=strtotime(date("Y-m-d"));
        //下载
        $new['download']=Db::name("user_posted_log")->count();
        $new['day_download']=Db::name("user_posted_log")->where("creattime >".$time)->count();
        //充值金额
        $new['coin']=Db::name("charge_log")->where("status = 1")->sum("download_coin");
        $new['day_coin']=Db::name("charge_log")->where("status = 1 && addtime >".$time)->sum("download_coin");
        //普通充值
        $new['down_goods'] = Db::name("charge_log")->where("status = 1 and goods_type=1")->sum("download_coin");
        $new['sup_goods'] = Db::name("charge_log")->where("status = 1 and goods_type=2")->sum("download_coin");
        //用户注册
        $new['user']=Db::name("user")->count();
        $new['day_user']=Db::name("user")->where("create_time >".$time)->count();
        //上传应用
        $new['posted']=Db::name("user_posted")->count();
        $new['day_posted']=Db::name("user_posted")->where("addtime >".$time)->count();

        //充值用户
        $charges=Db::name("charge_log")->order("status = 1 && addtime desc")->limit(8)->select();
        $charge=array();
        foreach($charges as $v){
            $id=$v['uid'];
            $cha=Db::name("user")->where("id=$id")->find();
            $v['name']=$cha['user_nickname'];
            $charge[]=$v;
        }

        //最新用户注册
        $user=Db::name("user")->where("user_type=2")->order("create_time desc")->limit(8)->select();
        $this->assign("new",$new);
        $this->assign("charge",$charge);
        $this->assign("user",$user);

        //今日一周日期
        $week = [date('Y-m-d',$time-86400*6),date('Y-m-d',$time-86400*5),date('Y-m-d',$time-86400*4),date('Y-m-d',$time-86400*3),date('Y-m-d',$time-86400*2),date('Y-m-d',$time-86400*1),date('Y-m-d')];
       
       
        
        //超级签名总上传
        $super = db('user_posted')->count();
        //超级签名总下载
        $superdow = db('ios_udid_list')->count();
        //今日上传
        $time = strtotime(date('Y-m-d'));
        $super_day = db('user_posted')->where(' addtime >='.$time)->count();
        //今日下载
        $superdow_day = db('ios_udid_list')
            ->where('create_time >='.$time)
            ->count();
            
        //今日一周下载
        $superdow_week = [];
        foreach($week as $val){
            $start_time = strtotime($val.' 00:00:00');
            $end_time = strtotime($val.' 23:59:59');
            $superdow_week[] = db('ios_udid_list')
                ->where('create_time >= '.$start_time)
                ->where('create_time <= '.$end_time)
                ->count();
        }
        //一周充值
        $coin_week = [];
       foreach($week as $val){
            $start_time = strtotime($val.' 00:00:00');
            $end_time = strtotime($val.' 23:59:59');
            $coin_week[] = Db::name("charge_log")
                ->where("status = 1 && addtime > ".$start_time)
                ->where("addtime < ".$end_time)
                ->sum("download_coin");
        }
        //一周注册
        $user_week = [];
        foreach($week as $val){
            $start_time = strtotime($val.' 00:00:00');
            $end_time = strtotime($val.' 23:59:59');
            $user_week[] = Db::name("user")
                ->where("create_time >".$start_time)
                ->where("create_time <".$end_time)
                ->count();
        }
        //用户总下载次数
        $user_down = Db::name('user')->sum('sup_down_public');
        $cert_num = Db::name('ios_certificate')->sum('limit_count');
        $dataAll = [
        	'user_down'=>$user_down,
            'cert_num'=>$cert_num,
            'week'=>json_encode($week),
            'super'=>$super,
            'superdow'=>$superdow,
            'super_day'=>$super_day,
            'superdow_day'=>$superdow_day,
            'coin_week'=>json_encode($coin_week),
            'user_week'=>json_encode($user_week),
            'superdow_week'=>json_encode($superdow_week),
        ];
        $this->assign($dataAll);
        return $this->fetch();
    }

    public function dashboardWidget()
    {
        $dashboardWidgets = [];
        $widgets          = $this->request->param('widgets/a');
        if (!empty($widgets)) {
            foreach ($widgets as $widget) {
                if ($widget['is_system']) {
                    array_push($dashboardWidgets, ['name' => $widget['name'], 'is_system' => 1]);
                } else {
                    array_push($dashboardWidgets, ['name' => $widget['name'], 'is_system' => 0]);
                }
            }
        }

        cmf_set_option('admin_dashboard_widgets', $dashboardWidgets, true);

        $this->success('更新成功!');

    }

}
