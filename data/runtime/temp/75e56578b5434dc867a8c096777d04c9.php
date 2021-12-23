<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:45:"themes/simpleboot3/user/tube/sup_details.html";i:1577986108;s:35:"themes/simpleboot3/public/head.html";i:1577937062;s:35:"themes/simpleboot3/public/tube.html";i:1588176406;s:37:"themes/simpleboot3/public/footer.html";i:1577937062;}*/ ?>
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
    .right{float:right}
    .layui-tab-content{border: 1px solid #ececec;margin-top: -1px;background-color: #fff;}
    .layui-tab-title .layui-this{background-color: #fff;}
    .sq-sup{border: 1px solid #ececec;box-shadow: 3px 3px 3px #ececec;margin-bottom: 40px;}
    .sq-sup__info{background-color: #f5f6f8;display: flex;padding: 30px;align-items: center;}
    .sq-sup__info .info-logo img{width: 90px;height: 90px;border-radius: 4px;}
    .sq-sup__info .info-base{margin-left: 20px;}
    .sq-sup__info .info-base .info-base__item1{font-size: 18px;font-weight: bold;color: #000;margin-bottom: 10px;}
    .sq-sup__info .info-base .info-base__item2{color: #666;line-height: 24px;}
    .sq-sup .sq-sup__items{display: flex;padding: 30px;background-color: #fff;}
    .sq-sup .sq-sup__items dl{flex: 1}
    .sq-sup .sq-sup__items dl dt{color: #777;margin-bottom: 5px;}
    .sq-sup .sq-sup__items dl dd{font-size: 18px;}
	.upload_btu{position: absolute;right:100px;background: linear-gradient(90deg,#348ef1,#49afff);border-radius: 4px;}
	.layui-form-onswitch{background-color:#1E9FFF;border-color:#1E9FFF}
	.layui-form-radio>i:hover, .layui-form-radioed>i{color:#1E9FFF}
</style>

<body class="body-white">
    <div class="templatemo-content">
        <!-- 我的应用左侧 -->
        <!--  我的应用左侧 -->
<div class="templatemo-sidebar">
    <div class="sq-logo">
        <a href="/"><img src="https://www.soku.cc/cp/logo5.png"></a>
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


        <!-- 我的应用左侧 -->

        <!-- begin app详情-->
        <div class="templatemo-body">
            <div class="sq-sup">
                <div class="sq-sup__info">
                    <div class="info-logo">
                        <img src="<?php echo $assets['img']; ?>">
                    </div>
                    <div class="info-base">
                        <p class="info-base__item1"><?php echo $assets['name']; ?></p>
                        <p class="info-base__item2">苹果版本:<?php echo $assets['version']; ?></p>
                        <p class="info-base__item2">安卓版本:<?php echo $assets['version']; ?></p>
                    </div>
					<button type="button" id="upload_btu" class="layui-btn upload_btu right">更新应用</button>
                </div>

                <div class="sq-sup__items">
                    <dl>
                        <dt>大小</dt>
                        <dd><?php echo $assets['big']; ?>MB</dd>
                    </dl>
                    <dl>
                        <dt>总装机数</dt>
                        <dd><?php echo $appCount; ?></dd>
                    </dl>
                    <dl>
                        <dt>Bundle ID</dt>
                        <dd><?php echo $assets['bundle']; ?></dd>
                    </dl>
                    <dl>
                        <dt>下载地址</dt>
                        <dd>
                            <a href="<?php echo getsite(); ?>/<?php echo $assets['er_logo']; ?>" target="_blank" style="color:#348ef1;text-decoration:none;">
                                <?php echo getsite(); ?>/<?php echo $assets['er_logo']; ?>
                            </a>
                        </dd>
                    </dl>
                   
                </div>
            </div>
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="<?=!isset($tab) || $tab=='edit'?'layui-this':''?>">应用信息</li>
                    <li id="table_sup_li" class="<?=isset($tab) && $tab=='sup'?'layui-this':''?>">装机记录</li>
                    <li id="table_old_li" class="<?=isset($tab) && $tab=='old'?'layui-this':''?>">历史版本</li>
                    <li id="table_down_li" class="<?=isset($tab) && $tab=='down'?'layui-this':''?>">下载记录</li>
                    <li id="table_hb_li" class="<?=isset($tab) && $tab=='hb'?'layui-this':''?>">合并应用</li>
					 <li id="table_hb_li" class="<?=isset($tab) && $tab=='fzb'?'layui-this':''?>">反作弊</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item <?=!isset($tab) || $tab=='edit'?'layui-show':''?> ">
                        <form class="layui-form" action="" style="margin-top: 10px">
							<input type="hidden" name="id" value="<?php echo $assets['id']; ?>" />
                            <div class="layui-form-item">
                                <label class="layui-form-label">应用状态</label>
                                <div class="layui-input-block">
                                    <input type="checkbox" <?=$assets['status']==1?'checked':''?> name="status" lay-skin="switch">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">安装方式</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="way" value="0" title="公开安装" <?=$assets['way']==0?'checked':''?>>
                                    <input type="radio" name="way" value="1"  title="密码安装" <?=$assets['way']==1?'checked':''?> disabled>
                                    <input type="radio" name="way" value="2" title="邀请安装" <?=$assets['way']==2?'checked':''?> disabled>
                                </div>
                            </div>
                            
                            <div class="layui-form-item">
                                <label class="layui-form-label">下载完后</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="openWay" value="0" title="直接打开" checked>
                                    <input type="radio" name="openWay" value="1"  title="桌面打开">
                                </div>
                            </div>
							
							<div class="layui-form-item">
                                <label class="layui-form-label">消息推送</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="message" value="0" title="直接推送" checked disabled>
                                </div>
                            </div>
							
                            <div class="layui-form-item">
                                <label class="layui-form-label">应用名字</label>
                                <div class="layui-input-block">
                                    <input type="text" name="name" required value="<?php echo $assets['name']; ?>" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">应用介绍</label>
                                <div class="layui-input-block">
                                    <textarea name="introduce" placeholder="请输入内容" class="layui-textarea"><?php echo $assets['introduce']; ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">更新说明</label>
                                <div class="layui-input-block">
                                    <textarea name="instructions" placeholder="请输入内容" class="layui-textarea"><?php echo $assets['instructions']; ?></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="form_date">立即提交</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="table_sup"  class="layui-tab-item  <?= isset($tab) && $tab=='sup'?'layui-show':''?>">

                    </div>
                    <div id="table_old" class="layui-tab-item <?=(isset($tab) && $tab=='old')?'layui-show':''?>">

                    </div>

                    <div id="table_down" class="layui-tab-item <?= isset($tab) && $tab=='down'?'layui-show':''?>">
                      
                    </div>

                    <div id="table_hb" class="layui-tab-item <?= isset($tab) && $tab=='hb'?'layui-show':''?>" style="padding: 30px">
						<form class="layui-form" action="">
							<div class="layui-form-item">
								<div class="layui-input-inline " style="width:155px;">
									<input type="radio" name="x" id="x1" value="Andriod下载地址" title="Andriod下载地址" checked="">
								</div>
								
								<div class="layui-input-inline " style="width:350px;">
								  <input type="text" id="andriod_url" name="andriod_url" lay-verify="title" autocomplete="off" placeholder="" class="layui-input">
								</div>
								<div class="layui-input-inline">
								  <button type="button" class="layui-btn"  id="btn_andriod_url" style="background: linear-gradient(90deg,#348ef1,#49afff);">保存</button>
								</div>
							</div>
							<div class="layui-form-item">
								<div class="layui-input-inline " style="width:155px;">
									<input name="x" id="x2" type="radio" value="Andriod应用上传" title="Andriod应用上传" >
								</div>
								<div class="layui-input-inline">
								  <button type="button" id="upload" class="layui-btn" style="background: linear-gradient(90deg,#348ef1,#49afff);">上传APK文件</button>
								</div>
							</div>
						</form>
						<!--<div class="layui-progress" hidden style="width:300px;margin-left:50px;" lay-showPercent="true">-->
						    <!--<div class="layui-progress-bar layui-bg-blue" style="width:0px;"></div>-->
						<!--</div>-->
                    </div>

					<div class="layui-tab-item <?= isset($tab) && $tab=='fzb'?'layui-show':''?>" style="padding: 30px 30px 80px">
					    <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <label class="layui-form-label" style="width: 150px;">每天限量下载:</label>
                                <div class="layui-input-inline">
                                   <input type="text" name="warning" id="warning_num" value="<?php echo $assets['warning']; ?>" lay-verify="number" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-input-inline">
                                  <button type="button" id="warning" class="layui-btn" style="background: linear-gradient(90deg,#348ef1,#49afff);">保存</button>
                                </div>
                            </div>

                            <label class="layui-form-label" style="color:#999;margin-left: 180px;padding: 9px 0;width: auto">
                                限制下载量达到您的预设值时，该应用将会限制下载。您可修改下载上限，或等待第二日自动重新上架。（0为不限制）
                            </label>
					    </form>
					</div>
				</div>
            </div>
        </div>
        <!-- begin app详情-->
    </div>
	<!--更新提示框-->

	<div id="update_ios_from" class="sq-upload-app" >
		<div class="j-form-upload app-form" style="font-size: 10px;" >
		    <dl style="margin-bottom: 20px;">
		        <dt>更新过程：</dt>
		        <dd>上传新包后，用户在使用app时连接服务器会发现有更新，此时由于系统机制，将会退出应用，并弹窗选择是否更新。选择更新后，会在桌面开始下载，根据您的网络情况直到下载完成，再次打开就是新版本的应用。</dd>
		        <!--<dd>若您选择的强制更新，则用户点击取消后，打开应用会被系统强制退出应用，用户需要再次选择是否更新。</dd>-->
		        <!--<dd>若您选择的非强制更新，则用户点击取消后，打开应用能继续使用旧版本应用，直到您再次上传一个版本。</dd>-->
				<dt>更新须知：</dt>
				<dd>请您确保新ipa包内的bundleid一致，否则在用户手机将会产生两个一样但独立的（bundleid不一样的）应用；</dd>
				<dd>请您确保新ipa包内的version是数字且递增，系统不能识别诸如1.a.1，或是仅build递增的更新包。</dd>
		    </dl>
		    <div>
		        <button class="j-update-btn  sq-upload-btn">
		            <i class="layui-icon">&#xe67c;</i>
		            <span>立即上传</span>
		        </button>
		        <input style="display: none" data-id="<?php echo $id; ?>" id="j-updata-ipa" data-action="update"  type="file"  name="upload" onchange="uploadIpa(this);">
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

<script src="__STATIC__/js/table_temp.js"></script>
<script>
	$(function(){
        if('<?php echo $tab; ?>' == 'hb'){
            hb();
        }

        function hb(){
            var url='<?php echo url("tube/get_sup_details_data"); ?>?id=<?php echo $id; ?>&type=hb&bundle=<?php echo $assets['bundle']; ?>';
            $.get(url,function(res){
                $('#andriod_url').val(res.andriod_url);
            });
        }

        $('#upload_btu').click(function(){
            layer.open({
                type     : 1,
                title    : '更新应用',
                area     : ['600px', '600px'],
                content  : $('#update_ios_from'),
                cancel   : function(index, layero){
                    $('#update_ios_from').css('display','none');
                    layer.close(index)
                    return false;
                }
            });
        });

        $('#table_sup_li').click(function(){
            var url='<?php echo url("tube/get_sup_details_data"); ?>?id=<?php echo $id; ?>&type=sup';
            var thead={'udid':'UDID','device_name':'设备型号','ios_version':'系统版本','version':'APP版本','ip':'IP','create_time':'装机时间'};
            set_table(thead,url,'#table_sup');
        });

        $('#table_old_li').click(function(){
            var url='<?php echo url("tube/get_sup_details_data"); ?>?id=<?php echo $id; ?>&type=old';
            var thead={'version':'版本','big':'大小(MB)','down_count':'下载次数','uuid_count':'装机次数','creattime':'更新时间'};
            set_table(thead,url,'#table_old');
        });

        $('#table_down_li').click(function(){
            var url='<?php echo url("tube/get_sup_details_data"); ?>?id=<?php echo $id; ?>&type=down';
            var thead={'device':'设备','ios_version':'系统版本','version':'APP版本','ip':'下载IP','addtime':'下载时间'};
            set_table(thead,url,'#table_down');
        });

        $('.j-update-btn').click(function(){
            if(!$(this).hasClass('disabled')){
                $('#j-updata-ipa').trigger('click')
            }
        });

        $('#table_hb_li').click(function(){
            hb();
        });

        $('#andriod_url').click(function(){
            $('#x1').prop("checked", true);
            layui.form.render();
        });

        $('#btn_andriod_url').click(function(){
            var andriod_url = $('#andriod_url').val();
            $('#x1').prop("checked", true);
            layui.form.render();
            $.get('<?php echo url("tube/sup_upload_apk"); ?>?id=<?php echo $id; ?>&andriod_url='+andriod_url,function(res){
                if(res.code==200){
                    layer.msg('修改成功',{icon:6});
                }else{
                    layer.msg('修改失败',{icon:5});
                }
            })
        });

        $('#warning').click(function(){
            var warning = $('#warning_num').val();
            var data    ={id:<?php echo $id; ?>,warning:warning};

            $.post("<?php echo url('tube/sup_details_update'); ?>",data,function(res){
                if(res.code==200){
                    layer.msg('修改成功',{icon:6});
                }else{
                    layer.msg('修改失败',{icon:5});
                }
            });
        });

        layui.use(['form','layer','table','upload','element'], function () {
            var form = layui.form,
                layer = layui.layer,
                table = layui.table,
                upload = layui.upload,
                element = layui.element;

            //修改提交
            form.on('submit(form_date)',function(data){
                data = data.field;
                $.post("<?php echo url('tube/sup_details_update'); ?>",data,function(res){
                    if(res.code==200){
                        layer.msg('修改成功',{icon:6});
                    }else{
                        layer.msg('修改失败',{icon:5});
                    }
                });
                return false;
            });
            //创建监听函数
            var xhrOnProgress=function(fun) {
                xhrOnProgress.onprogress = fun;
                return function() {
                    var xhr = $.ajaxSettings.xhr();
                    if (typeof xhrOnProgress.onprogress !== 'function'){
                        return xhr;
                    }
                    if (xhrOnProgress.onprogress && xhr.upload) {
                        xhr.upload.onprogress = xhrOnProgress.onprogress;
                    }
                    return xhr;
                }
            }
            //上传
            var upload_q = '';
            var upload_f = '';
            upload.render({
                elem    : '#upload',
                url     : '<?php echo url("tube/sup_upload_apk"); ?>',
                accept  : 'file',
                data    :{id:<?php echo $id; ?>},
                exts    :'apk',
                xhr:xhrOnProgress,
                progress:function(percent){
                    
                },
                before:function(obj){
                    $('#x2').prop("checked", true);
                    upload_f =layer.msg('文件上传至服务器', {
                        icon: 16,
                        shade: 0.3,
                        shadeClose:false,
                        time:0
                    });
                    layui.form.render();
                    $('.layui-progress-bar').css('width','0px');
                    $('.layui-progress').show();
                },
                done: function(res){
                    layer.close(upload_q);
                    $('.layui-progress').hide();
                    if(res.code==200){
                        $('#andriod_url').val(res.url);
                        layer.msg(res.msg,{icon:6});
                    }else{
                        layer.msg(res.msg,{icon:5});
                    }
                }
            });
            form.render()
        })
	});
</script>
