<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"themes/admin_simpleboot3/admin/systems/add_sys.html";i:1577937062;s:43:"themes/admin_simpleboot3/public/header.html";i:1577937062;}*/ ?>
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
<style>
.selectf{width: 50%;height: 35px;border:1px solid #dce4ec;}
.hiden{display:none;}
.gkred{color:#f53434;}
.gktop{height:35px;line-height:35px;}
.xzxz{margin-top:10px;}
</style>
</head>
<body>
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">

            <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): if( count($type)==0 ) : echo "" ;else: foreach($type as $key=>$vo): ?>

                <li>
                    <a href="<?php echo url('systems/index'); ?>" ><?php echo $vo['group_id']; ?></a>
                </li>
                
            <?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="active">
                    <a href="<?php echo url('systems/add_sys'); ?>" >添加配置</a>
                </li>
        </ul>
        <form class="form-horizontal margin-top-20" role="form" action="<?php echo url('systems/add_post'); ?>" method="post">
            <fieldset>
                <div class="tabbable">
                    <div class="tab-content">
                       
                            <div class="tab-pane active">
                              
                                  
                                        <div class="form-group">
                                            <label for="input-site-name" class="col-sm-2 control-label">
                                            <span class="form-required">*</span>系统配置标识</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control" id="input-site-name" name="code" placeholder="输入系统配置标识">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-site-name" class="col-sm-2 control-label">
                                            <span class="form-required">*</span>系统配置名称</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control"  name="title"  placeholder="输入系统配置名称">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span>系统配置分类</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control"  name="group_id" placeholder="输入系统配置分类">
                                            </div>
                                        </div>
                                      <div class="form-group">
                                            <label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span>系统配置注释</label>
                                            <div class="col-md-6 col-sm-10">
                                                <input type="text" class="form-control"  name="desc" placeholder="输入系统配置注释">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span>系统配置分类</label>
                                            <div class="col-md-6 col-sm-10">
                                                <select name="type" class="selectf">
                                                    <option value="0">文本框</option>
                                                    <option value="1">文本域</option>
                                                    <option value="2">图片</option>
                                                    <option value="3">多选框</option>
                                                    <option value="4">单选框框</option>
                                                    <option value="5">时间选择</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                                <div class="form-group" id="0">
                                                    <label for="input-site-name" class="col-sm-2 control-label"><span class="form-required">*</span>系统配置值</label>
                                                    <div class="col-md-6 col-sm-10">
                                                        <input type="text" class="form-control"  name="val[]" placeholder="输入系统配置值">
                                                    </div>
                                                </div>   
                                                <div class="form-group hiden"  id="1">
                                                    <label for="input-site-name" class="col-sm-2 control-label">
                                                    <span class="form-required">*</span>文本域的值</label>
                                                    <div class="col-md-6 col-sm-10">
                                                         <textarea name="val[]"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group hiden" id="2">
                                                        <label for="input-mobile_tpl_enabled" class="col-sm-2 control-label">缩略图</label>
                                                        <div class="col-md-6 col-sm-10">
                                                            <div style="text-align: center;">
                                                                    <input type="hidden" name="val[]" id="thumb" value="1">
                                                                    <a href="javascript:uploadOneImage('图片上传','#thumb');">     
                                                                        <img src="__TMPL__/public/assets/images/default-thumbnail.png"
                                                                            id="thumb-preview" width="135" style="cursor: hand"/>
                                                                    </a>
                                                                    <input type="button" class="btn btn-sm"
                                                                           onclick="$('#thumb-preview').attr('src','__TMPL__/public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;"
                                                                           value="取消图片">
                                                                </div>
                                                        </div>
                                                </div>
                                    
                                                <div class="form-group hiden"  id="3">
                                                    <label for="input-mobile_tpl_enabled" class="col-sm-2 control-label">多选框中的名称</label>
                                                    <div class="col-md-6 col-sm-10">
                                                        <input type="text" class="form-control"  name="title_scope[]"  placeholder="输入多选框中的名称"> 
                                                    </div>
                                                     <div class="col-md-4 gktop">
                                                         <span class="gkred">*多个值用,隔开</span>
                                                    </div>
                                                         
                                                     <label for="input-mobile_tpl_enabled" class="col-sm-2 control-label xzxz">选择第几个选中</label>
                                                    <div class="col-md-6 col-sm-10 xzxz">
                                                        <input type="number" class="form-control"  name="val[]" placeholder="输入要选中数字的值"> 
                                                    </div>
                                                     <div class="col-md-2 gktop xzxz">
                                                         <span class="gkred">*多个值用,隔开</span>
                                                    </div>
                                                
                                                </div>
                                           
                                                <div class="form-group hiden"  id="4">
                                                    <label for="input-mobile_tpl_enabled" class="col-sm-2 control-label">单选框中的名称</label>
                                                    <div class="col-md-6 col-sm-10">
                                                         <input type="text" class="form-control"  max="10" min="1" name="title_scope[]"  placeholder="输入单选框中的名称">
                                                    </div>
                                                     <div class="col-md-4 gktop">
                                                         <span  class="gkred">*多个值用,隔开</span>
                                                    </div>
                                                     <label for="input-mobile_tpl_enabled" class="col-sm-2 control-label xzxz">选择第几个选中</label>
                                                    <div class="col-md-6 col-sm-10 xzxz">
                                                        <input type="number" class="form-control"  max="10" min="1" name="val[]" placeholder="输入要选中数字的值"> 
                                                    </div>
                                                </div>

                                                <div class="form-group hiden"  id="5">
                                                    <label for="input-site-name" class="col-sm-2 control-label">
                                                    <span class="form-required">*</span>系统配置时间值</label>
                                                    <div class="col-md-6 col-sm-10">
                                                         <input type="text" class="form-control js-bootstrap-datetime" name="val[]"
                                                                 style="width: 140px;" autocomplete="off">
                                                    </div>
                                                </div>
                                         

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary js-ajax-submit" data-refresh="1"><?php echo lang('SAVE'); ?></button>
                                            </div>
                                        </div>
                            </div>  
                             
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
    <script type="text/javascript" src="__STATIC__/js/admin.js"></script>
    <script>
   $(document).ready(function(){
        $('select').change(function(){
            var val=$(this).val();
            $("#"+val).removeClass('hiden');
            $("#"+val).siblings().addClass('hiden');
            
        })
    })
    </script>
</body>
</html>