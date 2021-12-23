<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"themes/admin_simpleboot3/admin/mailer/index.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="__TMPL__/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="__TMPL__/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link href="__STATIC__/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="__STATIC__/css/style.css" rel="stylesheet" type="text/css">
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "__ROOT__/",
            WEB_ROOT: "__WEB_ROOT__/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="__STATIC__/js/wind.js"></script>
    <script src="__TMPL__/public/assets/js/bootstrap.min.js"></script>
	<script src="__TMPL__/public/assets/simpleboot3/layer/layer.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip();
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo url('mailer/index'); ?>"><?php echo lang('ADMIN_MAILER_INDEX'); ?></a></li>
			<li><a href="<?php echo url('mailer/template'); ?>?template_key=verification_code">数字验证码邮件模板</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form margin-top-20" action="<?php echo url('Admin/mailer/indexPost'); ?>">
			<div class="form-group">
				<label for="input-from_name" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('SENDER_NAME'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-from_name" name="from_name" value="<?php echo (isset($from_name) && ($from_name !== '')?$from_name:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-from" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('SENDER_EMAIL_ADDRESS'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-from" name="from" value="<?php echo (isset($from) && ($from !== '')?$from:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-host" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('SENDER_SMTP_SERVER'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-host" name="host" value="<?php echo (isset($host) && ($host !== '')?$host:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="js-smtpsecure" class="col-sm-2 control-label"><span class="form-required">*</span>连接方式</label>
				<div class="col-md-6 col-sm-10">
					<select name="smtp_secure" id="js-smtpsecure"  class="form-control">
						<option value="">默认</option>
						<option value="ssl">ssl</option>
						<option value="tls">tls</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="input-port" class="col-sm-2 control-label"><span class="form-required">*</span>SMTP服务器端口</label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-port" name="port" value="<?php echo (isset($port) && ($port !== '')?$port:''); ?>" placeholder="默认为25">
				</div>
			</div>
			<div class="form-group">
				<label for="input-login_name" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('SMTP_MAIL_ADDRESS'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="text" class="form-control" id="input-login_name" name="username" value="<?php echo (isset($username) && ($username !== '')?$username:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="input-password" class="col-sm-2 control-label"><span class="form-required">*</span><?php echo lang('SMTP_MAIL_PASSWORD'); ?></label>
				<div class="col-md-6 col-sm-10">
					<input type="password" class="form-control" id="input-password" name="password" value="<?php echo (isset($password) && ($password !== '')?$password:''); ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
					<a class="btn btn-warning" href="javascript:parent.openIframeDialog('<?php echo url('mailer/test'); ?>','发送测试邮件',{width:'600px',height:'400px'});">测试邮件</a>
				</div>
			</div>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>
	<script>
		$(function(){
			$('#js-smtpsecure').val("<?php echo (isset($smtp_secure) && ($smtp_secure !== '')?$smtp_secure:''); ?>");
		});
	</script>
</body>
</html>