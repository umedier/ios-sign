<?php
use AlibabaCloud\Client\AlibabaCloud;
use app\communal\Count;
use OSS\Core\OssException;
use OSS\OssClient;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

// TODO cmf_common
function get_user($key=""){
    $user = session('user');
//    if($key=='id'){
//        return 89;
//    }
    return isset($user[$key])?$user[$key]:$user;
}


//获取七牛信息
function get_qiniu_config()
{
    $plugin = db('plugin')->where('name', '=', 'Qiniu')->find();
    $qiniu  = json_decode($plugin['config'], true);
    return $qiniu;
}


//获取公共配置信息
function get_config()
{
    $list = db('config')->select()->toArray();

    foreach ($list as $item) {
        $m_config[$item['code']] = $item['val'];
    }
    return $m_config;
}

//获取站点地址
function get_site_url(){
    return 'https://' . $_SERVER['HTTP_HOST'];
}

function make_password($length = 8){
    // 密码字符集，可任意添加你需要的字符
    $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',);
    // 在 $chars 中随机取 $length 个数组元素键名
    $keys     = array_rand($chars, $length);
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        // 将 $length 个数组元素连接成字符串
        $password .= $chars[$keys[$i]];
    }
    return $password;
}



/**
 *  生成指定长度的随机字符串(包含大写英文字母, 小写英文字母, 数字)
 *
 * @param int $length 需要生成的字符串的长度
 * @return string 包含 大小写英文字母 和 数字 的随机字符串
 */
function random_str($length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $arr_len - 1);
        $str .= $arr[$rand];
    }

    return $str;
}

//将XML转为array
function xmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $values;
}

// Binary representation of a binary-string
function bstr2bin($input)
{
    if (!is_string($input)) return null; // Sanity check

    // Unpack as a hexadecimal string
    $value = unpack('H*', $input);

    // Output binary representation
    $value = str_split($value[1], 1);
    $bin = '';
    foreach ($value as $v) {
        $b = str_pad(base_convert($v, 16, 2), 4, '0', STR_PAD_LEFT);

        $bin .= $b;
    }

    return $bin;
}

function getsite()
{
    return 'https://' . $_SERVER['HTTP_HOST'];
}

function post_curls($url, $post)
{
    $curl = curl_init();                                            // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url);                  // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);   // 对认证证书来源的检查
    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);                // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $res = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno' . curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $res; // 返回数据，json格式

}

function get_page($tab){
    $_tab = input('tab');
    if($_tab == $tab){
        return input('page');
    }
    return 1;
}

//上传到阿里云
function alUpload($param){
    require_once(PLUGINS_PATH.'/aliyun/autoload.php');
    $config = get_config();

    $param['accessKeyId']      = $config['ali_save_access_key'];
    $param['accessKeySecret']  = $config['ali_save_access_secret'];
    $param['uploadUrl']        = $config['ali_save_upload_url'];
    $param['downUrl']          = $config['ali_save_down_url'];
    $param['bucket']           = $config['ali_save_bucket'];

    // 阿里云主账号AccessKey拥有所有API的访问权限，风险很高。强烈建议您创建并使用RAM账号进行API访问或日常运维，请登录 https://ram.console.aliyun.com 创建RAM账号。
    $accessKeyId     = $param['accessKeyId'];
    $accessKeySecret = $param['accessKeySecret'];
    $endpoint        = $param['uploadUrl'];
    $bucket          = $param['bucket'];
    $object          = $param['fileName'];
    $filePath        = $param['filePath'];

    try{
        $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

        $ossClient->uploadFile($bucket, $object, $filePath);
    } catch(OssException $e) {
        printf($e->getMessage() . "\n");
        return;
    }

    return $param['downUrl'].'/'.$param['fileName'];
}
function upd_tok_config(){
    $user_info = Db::name('user')->where("id=" . session('user.id'))->find();
    if ($user_info['accessKey'] && $user_info['secretKey'] && $user_info['bucket'] && $user_info['domain']) {
        return $user_info;
    }else{
        $user = Db::name('user')->find('1');
        return $user;
    }
}
//上传七牛
function upd_tok($file, $file_name,$is_url=true)
{
    require_once(PLUGINS_PATH . '/qiniu/autoload.php');
    // 需要填写你的 Access Key 和 Secret Key
    //$user=Db::name('user')->where("id=".session('user.id'))->find();
    //$accessKey = $user['accessKey'];
    //$secretKey =$user['secretKey'];
    //$bucket = $user['bucket'];
    $user_info = upd_tok_config();
    $domain="";
    $accessKey = $user_info['accessKey'];
    $secretKey = $user_info['secretKey'];
    $bucket = $user_info['bucket'];
    $domain = $user_info['domain'];

    // 构建鉴权对象
    $auth = new Auth($accessKey, $secretKey);
    // 上传到七牛后保存的文件名

    //$key = $_FILES['upfile']["name"] . rand(0, 9);
    // 生成上传 Token
    $token = $auth->uploadToken($bucket, $file_name);
    // 初始化 UploadManager 对象并进行文件的上传。
    $uploadMgr = new UploadManager();

    try {
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $file_name, $file);
    } catch (\Exception $exception) {
        $result['msg'] = "配置文件错误，请查看七牛配置";
        echo json_encode($result);
        exit;
    }

    if ($err !== null) {
        return $err;
    } else {
        if($is_url){
            return [
                'code'=>200,
                'url'=>$ret['key'],
                'all_url'=>'http://'.$domain.'/'.$ret['key']
            ];
        }
        return $ret;
    }
}

//下载数量预警
function is_warning($uid,$down_num,$mobile){
    $info = Db::name('user_warning')->where('uid',$uid)->find();
    if(!$info || !$info['num'] || $down_num > $info['num']){
        if($info['sms_num']){
            //已经触发过一次，这里将触发标记归0
            Db::name('user_warning')->where('uid',$uid)->update(['sms_num'=>0]);
        }
        return;
    }
    if($info['sms_num'] && $info['num'] == $info['sms_num']){
        return;
    }
    //发送预警信息
    $data = json_encode(['status'=>'预警提示','remark'=>'设备数还剩余'.$down_num.',请及时充值购买']);
    $gets = ali_sms_send($mobile,$data,'aliyun_warning_tpl_id');
    dump($gets);
    if($gets['Message']=='OK'){
        //记录本次预警出发时的警戒数
        Db::name('user_warning')->where('uid',$uid)->update(['sms_num'=>$info['num']]);
    }
}
function get_verification_config(){
    $config = Db::name('config')->where('group_id','短信配置')->select();
    $arr=[];
    foreach ($config as $k=>$v){
        $arr[$v['code']] = $v['val'];
    }
    return $arr;
}
/**
 * 阿里短信发送
 * @param $mobile 手机号
 * @param $data 发送数据
 * @param $tpl_id 模板id
 */
function ali_sms_send($mobile,$data,$tpl_id='aliyun_sms_tpl_id'){
    require_once(PLUGINS_PATH . 'alicloud/autoload.php');
    $config = get_verification_config();
    $accessKeyId = $config['aliyun_access_key_id'];//'LTAI4FfaRAyJbhk1iVpSVyeD';
    $accessSecret = $config['aliyun_access_secret'];//'zzSnqGM6ky43ReiRTPp5ZDcAfe41fb';
    //$PhoneNumbers = ;
    $SignName = $config['aliyun_sms_sign'];
    $TemplateCode = $config[$tpl_id];//aliyun_warning_tpl_id
    //$TemplateParam = ;
    AlibabaCloud::accessKeyClient($accessKeyId, $accessSecret)
        ->regionId('cn-hangzhou')
        ->asDefaultClient();
    // dump($SignName);
    try {
        $result = AlibabaCloud::rpc()
            ->product('Dysmsapi')
            // ->scheme('https') // https | http
            ->version('2017-05-25')
            ->action('SendSms')
            ->method('POST')
            ->host('dysmsapi.aliyuncs.com')
            ->options([
                'query' => [
                    'RegionId' => "cn-hangzhou",
                    'PhoneNumbers' => "$mobile",
                    'SignName' => "$SignName",
                    'TemplateCode' => "$TemplateCode",
                    'TemplateParam' => " $data",
                ],
            ])
            ->request();
        return $result->toArray();
    } catch (ClientException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    } catch (ServerException $e) {
        echo $e->getErrorMessage() . PHP_EOL;
    }
}

function get_down_count($id){
    $uid=get_user('id');
    $count = Count::getDownCount($uid,$id);
    return $count;
}

