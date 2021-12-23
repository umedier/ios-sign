<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"themes/admin_simpleboot3/user/admin_index/index.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
        <li class="tabs_li tabs_index active"><a><?php echo lang('USER_INDEXADMIN_INDEX'); ?></a></li>
        <li class="tabs_li tabs_add"><a href="javascript:void(0)" onclick="user_add()">添加用户</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('user/adminIndex/index'); ?>">
        用户ID：
        <input class="form-control" type="text" name="uid" style="width: 200px;" value="<?php echo input('request.uid'); ?>"
               placeholder="请输入用户ID">
        &nbsp;&nbsp;&nbsp;关键字：
        <input class="form-control" type="text" name="keyword" style="width: 200px;" value="<?php echo input('request.keyword'); ?>"
               placeholder="用户名/昵称/邮箱">

	
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('user/adminIndex/index'); ?>">清空</a>
    </form>
    <form method="post" class="js-ajax-form">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>手机</th>
                <th>超级签名公有池剩余签名数</th>
                <th>总安装数</th>
                <th>安卓下载数</th>
                <th>总充值金额</th>
                <th><?php echo lang('STATUS'); ?></th>
			
                <th><?php echo lang('ACTIONS'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php 
                $user_statuses=array("0"=>lang('USER_STATUS_BLOCKED'),"1"=>lang('USER_STATUS_ACTIVATED'),"2"=>lang('USER_STATUS_UNVERIFIED'));
             if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <tr>
                    <td><?php echo $vo['id']; ?></td>
                    <td><?php echo $vo['mobile']; ?></td>
                    <td><?php echo (isset($vo['sup_down_public']) && ($vo['sup_down_public'] !== '')?$vo['sup_down_public']:'0'); ?></td>
                    <td><?php echo $vo['udid_count']; ?></td>
                    <td><?php echo $vo['andriod']; ?></td>
                    <td><?php echo $vo['coin_count']; ?></td>
                    <td><?php echo $user_statuses[$vo['user_status']]; ?></td>
				
                    <td>
                        <?php if($vo['id'] != '1'): if(empty($vo['user_status']) || (($vo['user_status'] instanceof \think\Collection || $vo['user_status'] instanceof \think\Paginator ) && $vo['user_status']->isEmpty())): ?>
                                <a href="<?php echo url('adminIndex/cancelban',array('id'=>$vo['id'])); ?>"
                                   class="js-ajax-dialog-btn"
                                   data-msg="<?php echo lang('ACTIVATE_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('ACTIVATE_USER'); ?></a>
                                <?php else: ?>
                                <a href="<?php echo url('adminIndex/ban',array('id'=>$vo['id'])); ?>" class="js-ajax-dialog-btn"
                                   data-msg="<?php echo lang('BLOCK_USER_CONFIRM_MESSAGE'); ?>"><?php echo lang('BLOCK_USER'); ?></a>
                            <?php endif; else: ?>
                            <a style="color: #ccc;"><?php echo lang('BLOCK_USER'); ?></a>
                        <?php endif; ?>
						<a href="#" onclick="toLevel(<?php echo $vo['id']; ?>)" class=""><?php echo lang('LOWER_LEVEL'); ?></a>
						<a href="#" onclick="toPid(<?php echo $vo['id']; ?>)" class="">更改上级</a>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="pagination"><?php echo $page; ?></div>
		
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>
<script>
	function toLevel(pid){
		layer.open({
		  type: 2,
		  area: ['700px', '450px'],
		  fixed: false, //不固定
		  maxmin: true,
		  title:'下级管理',
		  content: "<?php echo url('admin/level/index'); ?>?pid="+pid+"&page=1"
		});
	}
	
	function user_add(){
		$('.tabs_li').removeClass('active');
		$('.tabs_add').addClass('active');
		layer.open({
		  type: 2,
		  area: ['340px', '360px'],
		  fixed: false, //不固定
		  maxmin: true,
		  title:'添加用户',
		  content: "<?php echo url('adminIndex/add'); ?>",
		  end:function(){
			  $('.tabs_li').removeClass('active');
			  $('.tabs_index').addClass('active');
		  }
		});
	}
	
	function toPid(pid){
		layer.open({
		  type: 2,
		  area: ['700px', '450px'],
		  fixed: false, //不固定
		  maxmin: true,
		  title:'更改上级',
		
		  content: "<?php echo url('admin/level/index'); ?>?pid="+pid+"&page=1"
		});
	}
	
	function editPid(obj,id){
		pid = obj.options[obj.options.selectedIndex].value;
		$.get("<?php echo url('user/adminIndex/editPid'); ?>?id="+id+'&pid='+pid,function(res){
			if(res.code==200){
				layer.msg('修改成功');
			}else{
				layer.msg('修改失败');
			}
		});
		
	}
	
	function downData(uid,nickname){
		layer.open({
		  type: 2,
		  area: ['700px', '450px'],
		  fixed: false, //不固定
		  maxmin: true,
		  title:'详细数据-'+nickname,
		  shade: 0,
		  content: "<?php echo url('admin/level/downData'); ?>?uid="+uid
		});
	}
	
	function toAdd(pid){
		layer.open({
		  type: 2,
		  area: ['700px', '450px'],
		  fixed: false, //不固定
		  maxmin: true,
		  title:'可设置下级人员',
		  content: "<?php echo url('admin/level/lists'); ?>?pid="+pid
		});
	}
</script>
</body>
</html>