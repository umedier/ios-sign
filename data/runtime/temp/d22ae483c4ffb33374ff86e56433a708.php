<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"themes/admin_simpleboot3/admin/members/charge.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
        <li class="active"><a href="javascript:;">充值记录</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('members/charge'); ?>">
        会员id:
        <input type="text" class="form-control" name="id" style="width: 200px;"
               value="<?php echo (isset($charge['id']) && ($charge['id'] !== '')?$charge['id']:''); ?>" placeholder="请输入会员id...">
        分类:
        <select class="form-control" name="status" style="width: 140px;">
            <option value='0'>全部</option>
            <option value='1' <?php if($charge['status'] == '1'): ?>selected="selected"<?php endif; ?>>充值成功</option>
            <option value='2' <?php if($charge['status'] == '2'): ?>selected="selected"<?php endif; ?>>充值失败</option>
        </select> &nbsp;&nbsp;
        时间:
        <input type="text" class="form-control js-bootstrap-datetime" name="start_time"
               value="<?php echo (isset($charge['start_time']) && ($charge['start_time'] !== '')?$charge['start_time']:''); ?>"
               style="width: 140px;" autocomplete="off">-
        <input type="text" class="form-control js-bootstrap-datetime" name="end_time"
               value="<?php echo (isset($charge['end_time']) && ($charge['end_time'] !== '')?$charge['end_time']:''); ?>"
               style="width: 140px;" autocomplete="off"> &nbsp; &nbsp;
        <input type="submit" class="btn btn-primary" value="搜索"/>
    </form>
    <form class="js-ajax-form" action="" method="post">
        <table class="table table-hover table-bordered table-list">
            <thead>
            <tr>
                <th width="50">ID</th>
                <th>会员名称(id)</th>
                <th>本站订单号</th>
                <th>商家订单ID</th>
                <th>支付成功时间</th>
                <th>充值金额</th>
                <th>下载次数</th>
                <th>充值时间</th>
                <th>充值来源</th>
                <th>充值商品</th>
                <th width="90">状态</th>
            </tr>
            </thead>
            <?php if(is_array($user) || $user instanceof \think\Collection || $user instanceof \think\Paginator): if( count($user)==0 ) : echo "" ;else: foreach($user as $key=>$vo): ?>
                <tr>
                    <td><b><?php echo $vo['id']; ?></b></td>
                    <td><?php echo $vo['name']; ?>(<?php echo $vo['uid']; ?>)</td>
                    <td><?php echo $vo['order_id']; ?></td>
                    <td><?php echo $vo['trade_id']; ?></td>
                    <td><?php echo $vo['trade_time']; ?></td>
                    <td><?php echo $vo['download_coin']; ?>元</td>
                    <td><?php echo $vo['download_download']; ?></td>
                    <td><?php echo date("Y-m-d H:i:s",$vo['addtime'] ); ?></td>
                    <td><?php echo $vo['type']; ?></td>
                    <td>
                        <?php switch($vo['goods_type']): case "1": ?>普通下载<?php break; case "2": ?>超级签名下载<?php break; default: ?>普通下载
                        <?php endswitch; ?>
                    </td>
                    <!-- 1充值成功 2充值失败 3订单未支付 4订单支付失败 5订单支付成功 -->
                    <td>
                        <?php switch($vo['status']): case "1": ?>充值成功<?php break; case "2": ?>充值失败<?php break; case "3": ?>订单未支付<?php break; case "4": ?>订单支付失败<?php break; case "5": ?>订单支付成功<?php break; default: ?>订单未支付
                        <?php endswitch; ?>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </table>

        <ul class="pagination"><?php echo (isset($page) && ($page !== '')?$page:''); ?></ul>
    </form>
</div>
<script src="__STATIC__/js/admin.js"></script>

</body>
</html>
