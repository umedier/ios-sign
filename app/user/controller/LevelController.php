<?php


namespace app\user\controller;


use app\admin\service\UserService;
use app\communal\Count;
use cmf\controller\UserBaseController;
use think\Db;

/**
 * 普通用户查看下线数据
 * Class LevelController
 * @package app\user\controller
 */
class LevelController extends UserBaseController
{
    public function index(){
        $uid  = get_user('id');
        $list = UserService::getDataToUid($uid,10);

        $sup_down_public = Db::name('user')->where('id',$uid)->field('sup_down_public')->find();
        $sup_down_public = $sup_down_public['sup_down_public'];//自身公有池数量
        $this->assign([
            'nav'=>'level',
            'page'=>$list->render(),
            'list'=>$list,
            'sup_down_public'=>$sup_down_public
        ]);
        return $this->fetch();
    }

    //详细下载数据
    public function downData($uid,$time=false){
    
        $list = Count::getDownCounByWeek($uid,7,true,$time);
        //dump($list);exit
        $time = $time?strtotime($time.' 00:00:00'):time();
        $week = Count::getDays(7,$time);
        $data_arr=[];
        $data_arr['count_udid'][0] = isset($list['count_udid'][$time])?$list['count_udid'][$time]:0;
        $data_arr['count_down'][0] = isset($list['count_down'][$time])?$list['count_down'][$time]:0;
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
            'week' => json_encode($week),
            'count_down' =>json_encode(array_reverse($data_arr['count_down'])),
            'count_udid' => json_encode(array_reverse($data_arr['count_udid'])),
            'uid'=>$uid,
            'time'=>date('Y-m-d',$time)


        ]);
        return $this->fetch();
    }


    //下线充值
    public function recharge(){
        $uid = get_user('id');
        $sup_down_public = Db::name('user')->where('id',$uid)->field('sup_down_public')->find();
        $sup_down_public = $sup_down_public['sup_down_public'];//自身公有池数量
        $num = input('num');
        $sid = input('sid');
        if(!is_numeric($num) || $num > $sup_down_public){
            return json(['code'=>0,'msg'=>'数据无效']);
        }
        //事务开始
        Db::startTrans();
        try{
            //为下线充值
            $s_info = Db::name('user')->where('id',$sid)->where('pid',$uid)->field('sup_down_public')->find();
            $s_sup_down_public = $s_info['sup_down_public'] + $num;
            Db::name('user')->where('id',$sid)->where('pid',$uid)->update(['sup_down_public'=>$s_sup_down_public]);
            Db::name('sup_charge_log')->insert([
                'uid'=>$sid,
                'puid'=>$uid,
                'num'=>$num,
                'type'=>1,
                'addtime'=>time(),
                'addtype'=>2,
            ]);
            //扣除自身数量
            $sup_down_public = $sup_down_public - $num;
            Db::name('user')->where('id',$uid)->update(['sup_down_public'=>$sup_down_public]);
            Db::name('sup_charge_log')->insert([
                'uid'=>$uid,
                'num'=>$num,
                'type'=>1,
                'addtime'=>time(),
                'addtype'=>2,
                'is_add'=>0,
                'msg'=>'给id:'.$sid.'用户充值'.$num.'设备数'
            ]);
            // 提交事务
            Db::commit();
            return json(['code'=>200,'msg'=>'充值成功']);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return json(['code'=>0,'msg'=>'充值失败']);
        }
    }
}