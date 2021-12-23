<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"themes/admin_simpleboot3/admin/main/index.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
<link href="__TMPL__/public/assets/simpleboot3/css/main.css" rel="stylesheet">

<?php 
    \think\Hook::listen('admin_before_head_end',$temp5ea9ab0d63a7e,null,false);
 ?>
<style>
	body{
		background: #f3f3f4;
		font-family: "open sans","Helvetica Neue",Helvetica,Arial,sans-serif;
		    font-size: 13px;
	}
	h1{
		font-weight: 400 !important;
	}
	.main-box-right{
		border-radius: 0 !important;
		width: 97% !important;
	}
</style>
</head>
<body>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>今日上传</h5>
		        </div>
		        <div class="ibox-content">
		            <h1 class="no-margins"><?php echo $super_day; ?></h1>
		            <small>今日上传</small>
		        </div>
		     </div>
		 </div>
		<div class="col-sm-3 ui-sortable">
		     <div class="ibox float-e-margins">
		         <div class="ibox-title">
		             <span class="label label-danger pull-right"></span>
		             <h5>今日安裝</h5>
		         </div>
		         <div class="ibox-content">
		             <h1 class="no-margins"><?php echo $superdow_day; ?></h1>
		             <small>今日安裝</small>
		         </div>
		      </div>
		  </div>
		<div class="col-sm-3 ui-sortable">
		      <div class="ibox float-e-margins">
		          <div class="ibox-title">
		              <span class="label label-danger pull-right"></span>
		              <h5>今日充值</h5>
		          </div>
		          <div class="ibox-content">
		              <h1 class="no-margins"><?php echo $new['day_coin']; ?></h1>
		              <small>今日充值</small>
		          </div>
		       </div>
		   </div>
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>今日注册</h5>
		        </div>
		        <div class="ibox-content">
		            <h1 class="no-margins"><?php echo $new['day_user']; ?></h1>
		            <small>今日注册</small>
		        </div>
		    </div>
		</div>
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>全部上传</h5>
		        </div>
		        <div class="ibox-content">
		            <h1 class="no-margins"><?php echo $new['posted']; ?></h1>
		            <small>全部上传</small>
		        </div>
		    </div>
		</div>
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>全部安装</h5>
		        </div>
		        <div class="ibox-content" style="height:87px;">
		            <div style="width:33%;float:left;">
						<h1 class="no-margins"><?php echo $superdow; ?></h1>
						<small>全部安装</small>
					</div>
					<div style="width:33%;float:left;">
						<h1 class="no-margins"><?php echo $cert_num; ?></h1>
						<small>剩余安装</small>
					</div>
					<div style="width:33%;float:left;">
						<h1 class="no-margins"><?php echo $user_down; ?></h1>
						<small>用户剩余</small>
					</div>
		        </div>
		    </div>
		</div>
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>全部充值</h5>
		        </div>
		        <div class="ibox-content">
		            <h1 class="no-margins"><?php echo $new['coin']; ?></h1>
		            <small>全部充值</small>
		        </div>
		    </div>
		</div>
		<div class="col-sm-3 ui-sortable">
		    <div class="ibox float-e-margins">
		        <div class="ibox-title">
		            <span class="label label-danger pull-right"></span>
		            <h5>全部注册</h5>
		        </div>
		        <div class="ibox-content">
		            <h1 class="no-margins"><?php echo $new['user']; ?></h1>
		            <small>全部注册</small>
		        </div>
		    </div>
		</div>
	</div>
</div>

    <div class="main-box-right">
        <div id="chart-composite-2">

        </div>
    </div>


    <div class="main-box-right">
        <div id="chart-composite-3">

        </div>
    </div>


    <div class="main-box-right">
        <div id="chart-composite-4">

        </div>
    </div>



<script src="__STATIC__/js/admin.js"></script>
<script src="https://unpkg.com/frappe-charts@1.0.0/dist/frappe-charts.min.iife.js"></script>
<?php 
    \think\Hook::listen('admin_before_body_end',$temp5ea9ab0d63afa,null,false);
 ?>
</body>
</html>

<script type="text/javascript">
    var reportCountList2 = <?php echo $superdow_week; ?>;
    var reportCountList3 = <?php echo $coin_week; ?>;
    var reportCountList4 = <?php echo $user_week; ?>;

  
    var lineCompositeData2 = {
		 labels: <?php echo $week; ?>,
        datasets: [{
            "name": "Events",
            "values": reportCountList2
        }]
    };

    var lineCompositeData3 = {
        labels: <?php echo $week; ?>,
        datasets: [{
            "name": "Events",
            "values": reportCountList3
        }]
    };

    var lineCompositeData4 = {
        labels: <?php echo $week; ?>,
        datasets: [{
            "name": "Events",
            "values": reportCountList4
        }]
    };



    var c2 = document.querySelector("#chart-composite-2");
    var c3 = document.querySelector("#chart-composite-3");
    var c4 = document.querySelector("#chart-composite-4");



    var lineCompositeChart = new Chart (c2, {
        title: "超级签名一周安装",
        data: lineCompositeData2,
        type: 'line',
        height: 130,
        colors: ['#ffa3ef'],
      
    });

    var lineCompositeChart = new Chart (c3, {
        title: "一周充值",
        data: lineCompositeData3,
        type: 'line',
        height: 130,
        colors: ['#3886D4'],
      
    });

    var lineCompositeChart = new Chart (c4, {
        title: "一周注册",
        data: lineCompositeData4,
        type: 'line',
        height: 130,
        colors: ['#64D57C'],
    });
</script>