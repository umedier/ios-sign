<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"themes/admin_simpleboot3/admin/mailer/template_verification_code.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
        <li><a href="<?php echo url('mailer/index'); ?>"><?php echo lang('ADMIN_MAILER_INDEX'); ?></a></li>
        <li class="active"><a href="#" data-toggle="tab">数字验证码邮件模板</a></li>
    </ul>
    <form method="post" class="form-horizontal js-ajax-form margin-top-20" role="form"
          action="<?php echo url('admin/mailer/templatePost'); ?>">
        <div class="form-group">
            <label for="input-title" class="col-sm-2 control-label"><?php echo lang('EMAIL_SUBJECT'); ?></label>
            <div class="col-md-6 col-sm-10">
                <input type="text" class="form-control" name="subject" id="input-title" value="<?php echo (isset($subject) && ($subject !== '')?$subject:''); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="input-title" class="col-sm-2 control-label"><?php echo lang('EMAIL_TEMPLATE'); ?></label>
            <div class="col-md-6 col-sm-12">
                <script type="text/plain" id="content" name="template"><?php echo htmlspecialchars_decode((isset($template) && ($template !== '')?$template:"")); ?></script>
                <span style="color: #ffb752;">请用{$code}代替数字验证码，{$username}代替用户名</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="template_key" value="verification_code">
                <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
            </div>
        </div>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>
<script type="text/javascript">
    //编辑器路径定义
    var editorURL = GV.WEB_ROOT;
</script>
<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__STATIC__/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    var editorcontent = new baidu.editor.ui.Editor();
    editorcontent.render('content');
</script>
</body>
</html>