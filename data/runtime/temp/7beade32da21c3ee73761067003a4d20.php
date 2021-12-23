<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"themes/admin_simpleboot3/admin/members/consume.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="javascript:;">消费记录</a></li>
		</ul>
		<form class="well form-inline margin-top-20" method="post" action="<?php echo url('members/consume'); ?>?page=1">
			会员id:
			<input type="text" class="form-control" name="uid" style="width: 200px;" value="<?php echo (isset($params['uid']) && ($params['uid'] !== '')?$params['uid']:''); ?>"
			 placeholder="请输入会员id...">
			&nbsp;&nbsp;
			类型:
			<select class="form-control" name="is_add" style="width: 140px;">
				<option value='-1'>全部</option>
				<option value='1' <?php if(isset($params['is_add']) && $params['is_add'] == '1'): ?>selected="selected"<?php endif; ?>>充值</option>
				<option value='0' <?php if(isset($params['is_add']) && $params['is_add'] === '0'): ?>selected="selected"<?php endif; ?>>扣减</option>
			</select> &nbsp;&nbsp;
			分类:
			<select class="form-control" name="addtype" style="width: 140px;">
				<option value='-1'>全部</option>
				<option value='0' <?php if(isset($params['addtype']) && $params['addtype'] === '0'): ?>selected="selected"<?php endif; ?>>手动</option>
				<option value='1' <?php if(isset($params['addtype']) && $params['addtype'] == '1'): ?>selected="selected"<?php endif; ?>>自动</option>
				<option value='2' <?php if(isset($params['addtype']) && $params['addtype'] == '2'): ?>selected="selected"<?php endif; ?>>上线</option>
			</select> &nbsp;&nbsp;
			时间:
			<input type="text" class="form-control js-bootstrap-datetime" name="start_time" value="<?php echo (isset($params['start_time']) && ($params['start_time'] !== '')?$params['start_time']:''); ?>"
			 style="width: 140px;" autocomplete="off">-
			<input type="text" class="form-control js-bootstrap-datetime" name="end_time" value="<?php echo (isset($params['end_time']) && ($params['end_time'] !== '')?$params['end_time']:''); ?>"
			 style="width: 140px;" autocomplete="off"> &nbsp; &nbsp;
			<input type="submit" class="btn btn-primary" value="搜索" />
		</form>
		<form class="js-ajax-form" action="" method="post">
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="50">ID</th>
						<th>会员名称(id)</th>
						<th>上线名称(id)</th>
						<th>次数</th>
						<th>设备类型</th>
						<th>操作来源</th>
						<th>操作状态</th>
						<th>操作时间</th>
						<th>备注</th>
					</tr>
				</thead>
				<tbody>
					<?php if(is_array($charge_log) || $charge_log instanceof \think\Collection || $charge_log instanceof \think\Paginator): if( count($charge_log)==0 ) : echo "" ;else: foreach($charge_log as $key=>$vo): ?>
						<tr>
						<td><b><?php echo $vo['id']; ?></b></td>
						<td><?php echo $vo['u_name']; ?>(<?php echo $vo['uid']; ?>)</td>
						<td><?php echo $vo['p_name']; ?>(<?php echo $vo['puid']; ?>)</td>
						<td><?php echo $vo['num']; ?></td>
						<th><?php echo $vo['type']==1?'公有':'私有'; ?></th>
						<th>
							<?php switch($vo['addtype']): case "0": ?>手动<?php break; case "1": ?>自动<?php break; case "2": ?>上线<?php break; default: ?>''
							<?php endswitch; ?>
						</th>
						<td><?php echo !empty($vo['is_add'])?'充值':'扣减'; ?></td>
						<td><?php echo date('Y-m-d',$vo['addtime']); ?></td>
						<td><?php echo $vo['msg']; ?></td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
			</table>

			 <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
		</form>
	</div>
	<script src="__STATIC__/js/admin.js"></script>

</body>
</html>
