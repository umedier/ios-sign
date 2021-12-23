<?php
# @Author: JokenLiu <Jason>
# @Date:   2018-04-20 13:23:29
# @Email:  190646521@qq.com
# @Project: Demon
# @Filename: AppController.php
# @Last modified by:   Jason
# @Last modified time: 2018-04-20 16:38:40
# @License: 北京乐维世纪网络科技有限公司开发者协议
# @Copyright: DemonLive


// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use Qiniu\Auth;    // 引入鉴权类
use Qiniu\Storage\UploadManager;    // 引入上传类
class AppController extends AdminBaseController
{
    public function index()
    {
        $where = [];
        /**搜索条件**/
        $name = $this->request->param('name');
        $bundle = $this->request->param('bundle');
         $uid = $this->request->param('uid');

        if ($name) {
            $where['name'] = ['like', "%$name%"];
        }
        
        if ($uid) {
            $where['uid'] = $uid;
        }

        if ($bundle) {
            $where['bundle'] = ['like', "%$bundle%"];
        }

       
        $app = Db::name('user_posted')
            ->where($where)
            ->order("id DESC")
            ->paginate(20)
            ->each(function ($item, $key) {
                $user = Db::name('user')
                    ->where('id',$item['uid'])
                    ->find();
                $pid = $user['pid']?:1;
                $url = Db::name('domain')->where('uid',$pid)->find();
                $item['domain'] = $url['domain'];
                     //应用安装次数
                $item['udid_count'] = Db::name('ios_udid_list')->where('user_id',$item['uid'])->where('app_id',$item['id'])->count('user_id');
                $item['andriod'] = Db::name('super_download_log')->where('uid',$item['id'])->where('app_id',$item['id'])->where('device','andriod')->count('uid');
                if (isset($user['user_nickname'])&&$user['user_nickname']) {
                    $item['user_nickname'] = $user['user_nickname'] . ' - ID:' . $item['uid'];
                    return $item;
                } else {
                    $item['user_nickname'] = '未填写 - ID：' . $item['uid'];
                    return $item;
                }
            });

        // 获取分页显示
        $page = $app->render();
        $this->assign("page", $page);
        $this->assign("app", $app);
        return $this->fetch();
    }
    
     public function get_user_info(){
        $id = input('uid');
        $user_info = Db::name('user')->where('id',$id)->field('mobile,sup_down_public,pid')->find();
        $pid = $user_info['pid'] == 0?1:$user_info['pid'];
        $domain = Db::name('domain')->where('uid',$pid)->field('domain')->find();
        $user_info['domain'] = $domain['domain'];
        $user_info['tid'] = input('id');
        return json(['code'=>1,'data'=>$user_info]);
    }

    //获取udid数据
    public function udid($appId){
        $list = Db::name('ios_udid_list')->where('app_id',$appId)->field('udid')->select();
        $this->assign([
            'list'=>$list
        ]);
        return $this->fetch();
    }

    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        if (!empty($id)) {
            //状态：1正常，2审核中，3已删除，4官方删除
            $result = Db::name('user_posted')->where(["id" => $id])->setField('status', '4');
            if ($result !== false) {
                $this->success("应用删除成功！", url("App/index"));
            } else {
                $this->error('应用删除失败！');
            }
        } else {
            $this->error('数据传入失败！');
        }
    }

    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');
        $app = DB::name('user_posted')->where(["id" => $id])->find();
        $this->assign($app);
        return $this->fetch();
    }

    public function editPost()
    {
        if ($this->request->isPost()) {
            if (strpos($_POST['img'], 'base64') === false && strpos($_POST['img'], '/upload') === false) {
                $_POST['img'] = '/upload/' . $_POST['img'];
            }
            $result = DB::name('user_posted')->update($_POST);
            if ($result !== false) {
                $this->success("保存成功！");
            } else {
                $this->error("保存失败！");
            }

        }
    }

    //修改APP状态
    public function edit_app_status()
    {
        $status = intval(input('param.status'));
        $id = intval(input('param.id'));

        db('user_posted')->where('id=' . $id)->setField('status', $status);
        $this->success('操作成功！');
    }

    //删除app并删除文件
    public function delete_file()
    {
        $id = intval(input('param.id'));

        $record = Db::name("user_posted")->where("id=" . $id)->find();
        $type = false;
        if (!$record) {
            $this->error('应用不存在！');
        }
        if ($record['url_name'] != '1') {
            if($record['is_open_super_sign']!=1){
                $ymurl = explode('/', $record['url']);
               // $type = $this->del_tok($ymurl[3]);
            }
        }

        $result = Db::name("user_posted")->where("id=" . $id)->delete();
        if (!$type) {
            $this->success("删除成功");
        } else {
            $this->success("文件删除失败");
        }
    }

    public function del_tok($url)
    {
        require_once(PLUGINS_PATH . '/qiniu/autoload.php');
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = $_SESSION['think']['user']['accessKey'];
        $secretKey = $_SESSION['think']['user']['secretKey'];
        $bucket = $_SESSION['think']['user']['bucket'];

        // 构建鉴权对象
        $key = $url;
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        return $err ? true : false;
    }

}
