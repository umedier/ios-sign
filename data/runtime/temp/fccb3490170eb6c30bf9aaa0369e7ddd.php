<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"themes/simpleboot3/user/profile/financialinfo.html";i:1577937062;s:35:"themes/simpleboot3/public/head.html";i:1577937062;s:35:"themes/simpleboot3/public/tube.html";i:1577956280;s:37:"themes/simpleboot3/public/footer.html";i:1577937062;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <title>闪签</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="author" content="shangqian.vip">
        <meta name="renderer" content="webkit">

        <link rel="icon" href="__TMPL__/public/assets/images/favicon.ico" type="image/png">

        <link href="__STATIC__/js/layui/css/layui.css" rel="stylesheet">
        <link href="__TMPL__/public/assets/css/shanqian.css" rel="stylesheet">

        <script type="text/javascript">
            var GV = {
                ROOT     : "__ROOT__/",
                WEB_ROOT : "__WEB_ROOT__/",
                JS_ROOT  : "static/js/"
            };
        </script>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <![endif]-->

        <script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
        <script src="__TMPL__/public/assets/js/jquery.qrcode.min.js"></script>
        <script src="__TMPL__/public/assets/js/jquery-migrate-1.2.1.js"></script>
        <script src="__TMPL__/public/assets/js/plist_parser.js"></script>
        <script src="__TMPL__/public/assets/simpleboot3/bootstrap/js/bootstrap.min.js"></script>

        <script src="/themes/simpleboot3/public/assets/qiniu_sdk/highlight.js"></script>
        <script src="/themes/simpleboot3/public/assets/qiniu_sdk/dist/qiniu.min.js"></script>
        <script src="/themes/simpleboot3/public/assets/qiniu_sdk/ui.js"></script>

        <script src="__STATIC__/js/wind.js"></script>
        <script src="__STATIC__/js/layui/layui.all.js"></script>
        <script src="__STATIC__/js/app-info-parser.js"></script>
    </head>


<style>
    .financial{background-color: #fff;padding: 30px;display:flex;align-items:center;justify-content:space-between;border: 1px solid #ececec;background-color: #fff;box-shadow: 3px 3px 3px #ececec}
    .financial-count{}
    .financial-count__title{color: #999;margin-bottom: 10px;}
    .financial-count__num{font-size: 30px;}
    .financial-count__num .small{font-size: 16px;position: relative;top: -2px;}
    .record{margin-top: 20px;}
    .record-tab{display: flex;align-items: baseline}
    .record-tab__item{margin-right: 15px;font-size: 18px;color: #999}
    .record-tab__item.active{color: #000;font-size: 22px;}
</style>

<body>
    <div class="templatemo-content">'
        <!--  我的应用左侧 -->
        <!--  我的应用左侧 -->
<div class="templatemo-sidebar">
    <div class="sq-logo">
        <a href="/"><img src="__TMPL__/public/static/image/aaa.png"></a>
    </div>

    <div class="templatemo-sidebar-nav">
        <ul>
            <li>
                <a class="<?php echo $nav=='tube'?'active' : ''; ?>" href="<?php echo cmf_url('user/tube/index'); ?>">数据统计</a>
            </li>
            <li>
                <a class="<?php echo $nav=='user'?'active' : ''; ?>" href="/user/profile/center">账户设置</a>
            </li>
			<li>
			    <a class="<?php echo $nav=='level'?'active' : ''; ?>" href="<?php echo url('user/level/index'); ?>">下线管理</a>
			</li>
            <li>
                <a class="" href="<?php echo url('user/install/ud_id'); ?>" target="_blank">UDID工具</a>
            </li>
        </ul>
    </div>

    <span href="javascript:void(0);" class="j-upload-app__btn sq-btn">
        发布应用
    </span>
	<span href="javascript:void(0);" class="sq-btn j-pay-btn" style="background:#ff0000">
        购买设备
    </span>

   
</div>


        <!--  我的应用左侧 -->

        <div class="templatemo-body">
            <h5>财务信息</h5>
            <div class="financial">
                <div class="financial-count">
                    <div class="financial-count__title">剩余装机数</div>
                    <div class="financial-count__num">
                        <span class=""><?php echo $user['sup_down_public']; ?></span>
                        <span class="small">台</span>
                    </div>
                </div>
                <div class="layui-btn layui-btn-normal layui-btn-radius j-pay-btn">
                    购买设备
                </div>
            </div>

            <div class="record">
                <div class="record-tab">
                    <span class="record-tab__item active">消费记录</span>
                    <a href="<?php echo cmf_url('user/Profile/payLog'); ?>" class="record-tab__item">充值记录</a>
                </div>
                <div class="">
                    <div class="sq-app__table">
                        <table class="layui-table sq-table">
                            <thead>
                                <tr>
                                    <th>时间</th>
                                    <th>数量</th>
									<th>详情</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($iosList) == 0): ?>
                                    <tr class="">
                                        <td colspan="4">
                                            <img src="https://img.cengxuyuan.com/wechat/abnor_no_data.png?x-oss-process=style/default">
                                            <p style="font-size: 16px;margin-top: 20px;margin-bottom: 20px">
                                                消费记录为空
                                            </p>
                                        </td>
                                    </tr>
                                <?php else: if(is_array($iosList) || $iosList instanceof \think\Collection || $iosList instanceof \think\Paginator): if( count($iosList)==0 ) : echo "" ;else: foreach($iosList as $key=>$item): ?>
                                        <tr>
                                            <td><?php echo $item['addtime']; ?></td>
                                            <td><?php echo $item['num']; ?>台</td>
											 <td><?php echo $item['msg']; ?></td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="sq-page">
                        <?php echo $page; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- begin 发布IOS超级签名 -->
<div class="sq-upload-app" id="j-upload-app__form">
    <div class="j-form-agree app-agree" style="display: block">
        <h2 class="app-agree__title">
            服务使用条款
        </h2>

        <div class="app-agree__content">
            <p>请在使用iOS 超级签名服务前，仔细阅读并充分理解以下内容及条款：</p>
            <p class="bold">您知晓并同意，由我们提供软件签名的技术，您购买此服务是用于您的 App 的内部测试之用途，且需符合苹果iOS 超级签名的所有规定，否则，因此而产生的法律后果由您自行全部承担；</p>
            <p class="bold">您知晓并同意，苹果iOS 超级签名因受到苹果政策影响，在未来可能会存在被苹果撤销从而导致应用出现无法安装、或已经安装的应用无法打开等情况，您同意并愿意独立承担该风险以及该风险导致的后续一切损失，并接受我们在后续可能为此而做出任何补偿等措施；</p>
            <p class="bold">您知晓并同意，我们提供签名技术来供您下载您的应用，因您对外分发导致App被滥用、恶意下载、刷量而造成的损失，我们仅提供必要的数据支持和反作弊服务，您同意并愿意独立承担因对外分发和推广而导致的风险和风险后续的一切损失。</p>
            <p>您已仔细阅读并同意《超级签名服务协议》中的全部内容。</p>
            <p>点击“我同意”代表您已仔细阅读并同意以上所有内容。</p>
        </div>

        <div style="text-align: center;margin-top: 10px">
            <button class="j-to-form layui-btn layui-btn-normal">我同意</button>
        </div>
    </div>

    <div class="j-form-upload app-form" style="display: none">
        <dl>
            <dt>上传ipa提示：</dt>
            <dd>ipa包里必须要有embedded.mobileprovision，确保权限完整；</dd>
            <dd>ipa包里确保info.plist里的bundleid与二进制执行文件中的bundleid一致；</dd>
            <dd>ipa包最好是没有被其他机构重签过的包，不然可能会导致应用闪退；</dd>
        </dl>
        <div>
            <button class="j-upload-btn sq-upload-btn">
                <i class="layui-icon">&#xe67c;</i>
                <span>立即上传</span>
            </button>
            <input style="display: none" type="file" id="j-upload-ipa" name="upload" onchange="uploadIpa(this);">
        </div>
        <div style="text-align: center;margin-top: 20px;color: #777">
            <p>点击按钮选择应用的安装包</p>
            <p>(支持IPA文件，单个文件最大支持2GB，支持中断后续传)</p>
        </div>

        <div class="j-upload-ing" style="display: none">
            <div class="layui-progress" style="margin-top: 30px">
                <div class="j-upload-progress layui-progress-bar layui-bg-blue"></div>
            </div>

            <div class="" style="margin-top: 6px;color: #999">
                <span>应用上传中，请不要关闭页面</span>
                <span class="j-upload-loaded">0M</span>
                /
                <span class="j-upload-total">0M</span>
            </div>
        </div>
    </div>
</div>
<!-- end  发布IOS超级签名 -->
<script src="__STATIC__/js/frontend.js"></script>

<script>
    function uploadIpa(obj) {
        var fd   = new FormData();
        var file = obj['files'][0];
        var ipa  = file.name;
        var num  = file.size/1024/1024;
        var id   = $(obj).attr('data-id');

        if(ipa.indexOf('ipa')==-1){
            layer.msg('请上传正确的ipa包！');
            return false;
        }

        if(num>1024){
            layer.msg('您上传的文件为'+num+'MB');
            return false;
        }

        new AppInfoParser(file).parse().then(result=>{
            fd.append("file"          , file);
            fd.append("name"          , result.CFBundleDisplayName || result.CFBundleName);
            fd.append("build"         , result.MinimumOSVersion);//编译版本号
            fd.append("version"       , result.CFBundleShortVersionString);//编译版本号
            fd.append("icon"          , result.icon);//图标
            fd.append("bundle"        , result.CFBundleIdentifier);//包名
            fd.append("isProvisioned" , !result.mobileProvision.ProvisionedDevices);
            fd.append('id'            ,id||0);
     
            $.ajax({
                url         : "<?php echo cmf_url('portal/index/uploadIpa'); ?>",
                type        : 'POST',
                processData : false,
                contentType : false,
                dataType    : 'json',
                data        : fd,
                beforeSend  : function(){
                    $('.j-upload-ing').show();
                    $('.j-upload-total').html(num.toFixed(2)+'M');
                    $('.j-upload-btn').addClass('disabled');
                },
                success: function (res) {
                    if(res.code==1){
                        $('.j-upload-progress').css('width','100%');

                        window.location.href="/user/tube/sup_details/id/"+res.appId+'.html';

                        layer.closeAll();
                    }else{
                        layer.msg(res.message);
                    }
                },
                complete(){
                    $('.j-upload-btn').removeClass('disabled');
                },
                xhr:function(){
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',function(e){
                            var loaded  = e.loaded;                                        //已经上传大小情况
                            var total   = e.total;                                         //附件总大小
                            var percent = Math.floor(100*loaded/total);                   //已经上传的百分比

                            $('.j-upload-loaded').html((loaded/1024/1024).toFixed(2)+'M');
                            $('.j-upload-progress').css('width',percent+"%");
                        }, false);
                    }
                    return myXhr;
                },
            })
        }).catch(err => {
            console.log('err ----> ', err);
            layer.msg('文件上传失败');
        });
    }

    $('.j-pay-btn').click(function(){
        layer.open({
            type     : 2,
            title    : '购买设备',
            area     : ['800px', '600px'],
            content  : "<?php echo cmf_url('portal/index/pay'); ?>"
        })
    });

    $('.j-upload-app__btn').click(function(){
        layer.open({
            type     : 1,
            title    : '新增应用',
            area     : ['600px', '500px'],
            content  : $('#j-upload-app__form'),
            end      : function(){
                $('#j-upload-app__form').hide();
            }
        });

        $('.j-to-form').click(function () {
            $('.j-form-agree').hide();
            $('.j-form-upload').show();
        })
    })

    $('.j-upload-btn').click(function(){
        if(!$(this).hasClass('disabled')){
            $('#j-upload-ipa').trigger('click')
        }
    });
</script>
</html>

