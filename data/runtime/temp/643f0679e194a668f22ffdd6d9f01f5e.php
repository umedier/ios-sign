<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:46:"themes/simpleboot3/user/install/index_new.html";i:1577981171;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="telephone=no" name="format-detection"/>
    <title><?php echo $result['name']; ?> 下载</title>
    <link rel="stylesheet" href="__STATIC__/js/layui/css/layui.css" media="all">
    <style>
        body{font-size: 16px}
        .base-info{padding:1.25rem 1.45rem;margin:0 auto;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}
        .base-info .base-info-l{border-radius:.75rem;overflow:hidden;width:6.5rem;height:6.5rem;box-sizing:border-box;border:1px solid #eee;flex-shrink:0}
        .base-info .base-info-l>img{width:100%;height:100%}
        .base-info .base-info-r{position:relative;margin-left:1.2rem}
        .base-info .base-info-r .title{margin-top:.35rem;font-weight:700;font-size:1.25rem}
        .base-info .base-info-r .category,.base-info .base-info-r .title{word-break:break-all;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden}
        .base-info .base-info-r .category{color:#999;font-size:1rem}
        .base-info .base-info-r .base-tag{display: flex;margin-top: 16px;}
        .base-info .base-info-r .base-tag li{border: 1px solid #0c85da;color: #0c85da;font-size: 12px;border-radius:20px;padding:2px 10px;margin-right: 10px;}
        .install-btn{display:block;height:1.6rem;line-height:1.6rem;border-radius:.8rem;background:#0477f9;border:1px solid #0477f9;margin-top: 36px;text-align:center;color:#fff;font-size:.85rem;bottom:.35rem;left:0;padding: 0 20px}
        .rate-info{padding-bottom:1.25rem;margin:0 1.45rem;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between}
        .rate-info .rate>strong{font-size:1rem;font-weight:700;color:#888}
        .rate-info .rate>img{width:5rem;margin-left:5px;height: 1rem;margin-top: -4px}
        .rate-info .rate>p{color:#d8d8d8;font-size:.75rem}
        .rate-info .classification>strong{color:#8e8f92;font-size:1rem}
        .rate-info .classification>p{color:#d8d8d8;font-size:.75rem}
        .summary-info{border-top:1px solid #eee;padding:1.25rem 0;margin:0 1.45rem}
        .summary-info .summary-info-title{font-size:1.25rem;margin-bottom:.85rem}
        .summary-info .summary-info-text{position:relative;line-height:1.3rem;font-size:.875rem}.summary-info .summary-info-text .unfold-button[data-v-5cecdd32]{position:absolute;right:0;bottom:0;background:#fff;color:#067afe;width:2rem;padding-left:.3rem}
        .summary-info .summary-info-text .omit{position:absolute;right:2.3rem;bottom:0;background:#fff;text-align:right}.summary-info .text-fold[data-v-5cecdd32]{word-break:break-all;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden}
        .summary-info .text-unfold{display:block}
        .comment-info{border-top:1px solid #eee;padding:1.25rem 1.45rem;}
        .comment-info .comment-info-title{margin-bottom:.85rem;font-size:1.25rem;font-weight: bold}
        .comment-info .comment-info-content{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row}
        .comment-info .comment-info-content .comment-info-l>strong{font-size:3.75rem;line-height:2.6875rem;color:#4a4a4e;font-weight:700}
        .comment-info .comment-info-content .comment-info-l>p{width:5.6875rem;text-align:center;color:#7b7b7b;margin-top:.625rem}
        .comment-info .comment-info-content .comment-info-r{margin-left:2rem;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1}
        .comment-info .comment-info-content .comment-info-r .comment-star-list>li{margin-top:.6rem;line-height:0;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center}
        .comment-info .comment-info-content .comment-info-r .comment-star-list>li:first-child{margin-top: 0}
        .comment-info .comment-info-content .comment-info-r .comment-star-list .comment-star{position:relative;width:2.875rem;height:.4375rem}
        .comment-info .comment-info-content .comment-info-r .comment-star-list .comment-star>img{display:block;width:100%;height:100%}
        .comment-info .comment-info-content .comment-info-r .comment-star-list .comment-star>div{position:absolute;left:0;top:0;height:100%;background:#fff}
        .comment-info .comment-info-content .comment-info-r .comment-star-list .comment-progress{position:relative;margin-left:.5rem;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;height:.125rem;background:#e9e9ec;border-radius:.125rem}
        .comment-info .comment-info-content .comment-info-r .comment-star-list .comment-progress>div{position:absolute;left:0;width:0;height:.125rem;background:#4a4a4e;border-radius:.125rem;width:90%}
        .app-info{border-top:1px solid #eee;padding:1.25rem 1.45rem;}
        .app-info .app-title{margin-bottom:.5rem;font-size:1.25rem}
        .app-info .app-info-con{position:relative;font-size:.875rem}
        .information-info{border-top:1px solid #eee;padding:1.25rem 1.45rem 0;}
        .information-info .app-title{margin-bottom:.5rem;font-size:1.25rem}
        .information-info .information-list>li{font-size:.75rem;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;line-height:3.5;border-bottom:1px solid #f2f2f2}
        .information-info .information-list>li:last-child{border-bottom: none}
        .information-info .information-list>li .l{color:#737379}
        .information-info .information-list>li .r{margin-left:1.5rem;-webkit-box-flex:1;-ms-flex:1;flex:1;text-align:right;line-height:1rem}
        .android-install{position: fixed;box-sizing:border-box;bottom: 0;background-color: #fff;border-top: 1px solid #ccc;padding:10px 30px;width: 100%;}
        .android-install__btn{position:relative;background-color: #0c85da;overflow:hidden;color: #fff;padding: 10px;width: 100%;display: block;text-align: center;border-radius: 30px;}
        .android-install__btn .text{position: relative;z-index: 2;}
        .android-install__btn.active{background-color: #ccc;}
        .android-install__btn.active .progress{text-align: center;display: block;position: absolute;background-color: #0c85da;height: 100%;left: 0;top: 0;}
        .android-install__btn.disabled{background-color: #ccc;color: #fff}
        .no_safar {width: 100%;height: 100%;z-index: 600;}
        .no_safar .tip_img {z-index: 500;position: fixed;left: 1.2rem; top: .1rem;}
        .no_safar .tip_img img {width: 21rem;}
        .no_safar .model {position: fixed;left: 0;top: 0;width: 100%;height: 100%;background-color: #000000;opacity: 0.7;filter: alpha(opacity=70);z-index: 499;}
        .pc-platform{text-align: center;padding:20px 30px;}
        .pc-platform .pc-platform__logo{margin-bottom: 30px;}
        .pc-platform .pc-platform__code{}
        .pc-platform .pc-platform__code .code-title{font-weight: bold}
    </style>
              <style type="text/css">

        .weixin-tip {
            margin: 0;
            padding: 0;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            background: rgba(255,255,255,1.0);
            filter: alpha(opacity=80);
            height: 100%;
            width: 100%;
            z-index: 100;
        }

            .weixin-tip p {
                text-align: center;
                margin-top: 0%;
                padding: 0 0%;
                height: 100%;
                background: #f5f5f5;
            }

            .weixin-tip img {
                max-width: 100%;
            }
    </style>
    <script src="/themes/simpleboot3/public/assets/js/jquery-1.10.2.min.js"></script>
    <script>
    	$(function(){
    	var ua1 = window.navigator.userAgent.toLowerCase();


        if (ua1.match(/WeiBo/i) == "weibo" || ua1.match(/QQ/i) == "qq" || ua1.match(/MicroMessenger/i) == "micromessenger") {
 $("body").remove();
                var winHeight = $(window).height();
            $("#weixin-tip").css("height", winHeight);
            $("#weixin-tip").css("background-color", "rgba(0,0,0,0.8)");

            $("#weixin-tip").show();
              
              $("html").append("<body> <div class='weixin-tip' id='weixin-tip'> <p> <img src='/themes/simpleboot3/public/static/image/qq97013266.png' alt='在浏览器打开'/></p></div></body>");
            }
    	})
    </script>
</head>
<body>
	    <div id="app">
	        <?php if($device == 'iphone' || $device == 'ipad'): ?>
	            <div class="container">
	                <div class="base-info">
	                    <div class="base-info-l">
	                        <img src="<?php echo $result['img']; ?>" alt="" class="icon">
	                    </div>
	                    <div class="base-info-r">
	                        <div class="title">
	                            <p><?php echo $result['name']; ?></p>
	                        </div>
	                        <div class="">
								<?php if(($title)): ?>
									<span style="background:#ccc;border:1px solid #ccc;" class="install-btn ">
									    <?php echo $title; ?>
									</span>
								<?php else: ?>
									<span data-id="<?php echo $result['id']; ?>" data-url="/user/install/getudid_mobileconfig" class="install-btn j-ios-install">
									    免费安装
									</span>	
								<?php endif; ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="rate-info">
	                    <div class="rate">
	                        <strong>4.9</strong>
	                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                        <p>9999+个评分</p>
	                    </div>
	                    <div class="classification" style="text-align: center">
	                        <strong>4+</strong>
	                        <p>年龄</p>
	                    </div>
	                </div>
	                <div class="comment-info">
	                    <h2  class="comment-info-title">评分及评论</h2>
	                    <div class="comment-info-content">
	                        <div class="comment-info-l"><strong data-v-5cecdd32="">4.9</strong>
	                            <p>满分 5 分</p>
	                        </div>
	                        <div class="comment-info-r">
	                            <ul class="comment-star-list">
	                                <li>
	                                    <div class="comment-star">
	                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                                        <div></div>
	                                    </div>
	                                    <div class="comment-progress">
	                                        <div style="width: 80%;"></div>
	                                    </div>
	                                </li>
	                                <li>
	                                    <div class="comment-star">
	                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                                        <div style="width: 0%;"></div>
	                                    </div>
	                                    <div class="comment-progress">
	                                        <div style="width: 20%;"></div>
	                                    </div>
	                                </li>
	                                <li>
	                                    <div class="comment-star">
	                                        <img  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                                        <div style="width: 20%;"></div>
	                                    </div>
	                                    <div class="comment-progress">
	                                        <div style="width: 0%;"></div>
	                                    </div>
	                                </li>
	                                <li>
	                                    <div class="comment-star">
	                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                                        <div style="width: 40%;"></div>
	                                    </div>
	                                    <div class="comment-progress">
	                                        <div style="width: 0%;"></div>
	                                    </div>
	                                </li>
	                                <li>
	                                    <div class="comment-star">
	                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMsAAAAgCAYAAAC8eIxyAAADiElEQVR4nNXcvascVRgH4GfXWySKFoIouYJ2gogS1ELFr4hJlPgdP1CihWBhYaOd/4CNEcTSKsZCESxMo3axsBAEtRVUgogfGFEsDFxiMRtyWbI7s3Nmzt3fr9ndmT3vPFu8s+ycszM5+tbbBsh+fDZEoQpJsSY4E4wM5JwOALkXn+KmAWqNnRRrgjPByIDOIZrl9dnjkQFqjZ0Ua4IzwciAztJmuQ77Zs+fw0ZhvTGTYk1wJhgZ2FnaLC9iMnt+Fe4vrDdmUqwJzgQjAztLmmWKZ+e2PV9Qb8ykWBOcCUZGcJY0yz5szm17BJcV1BwrKdYEZ4KREZwlzXKhH0y78VRBzbGSYk1wJhgZwdm3WS7GYwv2rdvVkRRrgjPByEjOVa8O7MYuzZWFSxe8507ciFML9m/h7xWP2ycp1gRngpGRnRu4At/hyiLm+UzwTY9xR3C85T0p1gRngpE1ck7xO04MBOmTs3hNe6OQY01wJhhZI+e53ywv45MdgJzRnFneXGFMijXBmWBkTZzTbRsP46OKkH9wCO+vOC7FmuBMMLImzu1Xw87gGbxbAfIT7sDnPcenWBOcCUbWwHnRgYMPbH99VvN1959mUmdi+HyJ+/BDYZ0Ua4IzwcgOOxfNs7yh+dr7d2DIMc2S6d8GrJliTXAmGNkh57JJyY9xO74fALGFV/GC5qwwdFKsCc4EIzvgbJvB/xa3Krt0dxoP4mhBjS5JsSY4E4xUdnZZ7vIXHsZXPTHvqffX0xRrgjPBSEVn17Vhu3B9T8wTKxxniKRYE5wJRio5u36Y/bikJ2YTt/Uc2ycp1gRngpFKzq7NsmgFZ9ccLhy/SlKsCc4EI5WcXZplAw+VWTxaOL5rUqwJzgQjFZ1dmuUuXL5k/xZOttS4Fnu7gAqTYk1wJhip6OzSLMu+4n7UTOLcrenuX5e8t8ZZJsWa4EwwUtHZ1iyTJUWOaW5c9sXs9QncYPFit0NtmMKkWBOcCUYqO9ua5RZcPbftTzytme2c/0fZH3hSs6z59Ny+vdjTBipIijXBmWCksrOtWea79gNNd37YMu64pqu3r9qc4GDLuJKkWBOcCUYqO9ua5fHZ40nco1ki/UvLmHM5hQN4STPLyvm7A46RFGuCM8FIZedkyV30p3hlBvm6I2BR9uAd3IxrCmtdKCnWBGeCkR1wLmuWMbKJn2sesCAp1gRngpEW5//kXI9EZibN2wAAAABJRU5ErkJggg==" alt="">
	                                        <div style="width: 60%;"></div>
	                                    </div>
	                                    <div class="comment-progress">
	                                        <div style="width: 0%;"></div>
	                                    </div>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	                <?php if(!empty($result['introduce'])): ?>
	                    <div class="app-info">
	                        <h2 class="app-title">应用介绍</h2>
	                        <div class="app-info-con open" style="height: auto;">
	                            <p><?php echo $result['introduce']; ?></p>
	                        </div>
	                    </div>
	                <?php endif; if(!empty($result['instructions'])): ?>
	                    <div class="app-info">
	                        <h2 class="app-title">版本更新说明</h2>
	                        <div class="app-info-con open" style="height: auto;">
	                            <p><?php echo $result['instructions']; ?></p>
	                        </div>
	                    </div>
	                <?php endif; ?>
	                <div class="app-info">
	                    <h2 class="app-title">新功能</h2>
	                    <div class="app-info-con open" style="height: auto;">
	                        <p >版本 <?php echo $result['version']; ?></p>
	                    </div>
	                </div>
	                <div class="information-info">
	                    <h2 class="app-title">信息</h2>
	                    <ul  class="information-list">
	                        <li>
	                            <span class="l">销售商</span>
	                            <div class="r"><?php echo $result['name']; ?></div>
	                        </li>
	                        <li>
	                            <span class="l">兼容性</span>
	                            <div class="r">需要iOS9.0或更高版本</div>
	                        </li>
	                        <li>
	                            <span class="l">语言</span>
	                            <div class="r">简体中文</div>
	                        </li>
	                        <li>
	                            <span class="l">大小</span>
	                            <div class="r"><?php echo $result['big']; ?>MB</div>
	                        </li>
	                        <li>
	                            <span class="l">更新时间</span>
	                            <div class="r"><?php echo date("Y-m-d",$result['addtime'] ); ?></div>
	                        </li>
	                    </ul>
	                </div>
	                <div style="padding: 1rem 1.25rem;font-size: 12px;background-color: #fafafa">
	                    <p>免责声明：</p>
	                    <p>本网站仅提供下载托管，APP内容相关事项由开发者负责，与本站无关</p>
	                </div>
	            </div>
	        <?php elseif($device == 'android'): ?>
	            <div class="container">
	                <div class="base-info">
	                    <div class="base-info-l" style="width: 5rem;height: 5rem;">
	                        <img src="<?php echo $result['img']; ?>" alt="" class="icon">
	                    </div>
	                    <div class="base-info-r">
	                        <div class="title">
	                            <p><?php echo $result['name']; ?></p>
	                        </div>
	                        <ul class="base-tag">
	                            <li>安全</li>
	                            <li>人工亲测</li>
	                        </ul>
	                    </div>
	                </div>
	                <?php if(!empty($result['introduce'])): ?>
	                    <div class="app-info">
	                        <h2 class="app-title">应用介绍</h2>
	                        <div class="app-info-con open" style="height: auto;">
	                            <p><?php echo $result['introduce']; ?></p>
	                        </div>
	                    </div>
	                <?php endif; if(!empty($result['instructions'])): ?>
	                    <div class="app-info">
	                        <h2 class="app-title">版本更新说明</h2>
	                        <div class="app-info-con open" style="height: auto;">
	                            <p><?php echo $result['instructions']; ?></p>
	                        </div>
	                    </div>
	                <?php endif; ?>
	                <div class="app-info">
	                    <h2 class="app-title">新功能</h2>
	                    <div class="app-info-con open" style="height: auto;">
	                        <p >版本 <?php echo $result['version']; ?></p>
	                    </div>
	                </div>
	                <div class="information-info">
	                    <h2 class="app-title">信息</h2>
	                    <ul  class="information-list">
	                        <li>
	                            <span class="l">销售商</span>
	                            <div class="r"><?php echo $result['name']; ?></div>
	                        </li>
	                        <li>
	                            <span class="l">兼容性</span>
	                            <div class="r">需要安卓5.0或更高版本</div>
	                        </li>
	                        <li>
	                            <span class="l">语言</span>
	                            <div class="r">简体中文</div>
	                        </li>
	                        <li>
	                            <span class="l">大小</span>
	                            <div class="r"><?php echo $result['big']; ?>MB</div>
	                        </li>
	                        <li>
	                            <span class="l">更新时间</span>
	                            <div class="r"><?php echo date("Y-m-d",$result['addtime'] ); ?></div>
	                        </li>
	                    </ul>
	                </div>
	                <div style="padding: 1rem 1.25rem;font-size: 12px;background-color: #fafafa">
	                    <p>免责声明：</p>
	                    <p>本网站仅提供下载托管，APP内容相关事项由开发者负责，与本站无关</p>
	                </div>
	                <div class="android-install">
	                    <?php if(!empty($result['andriod_url'])): ?>
	                        <div data-url="<?php echo $result['andriod_url']; ?>" class="j-android-install android-install__btn">
	                            <div class="text">免费安装</div>
	                            <div class="progress j-android-progress"></div>
	                        </div>
	                    <?php else: ?>
	                        <span class="android-install__btn disabled">未提供安卓版本</span>
	                    <?php endif; ?>
	                </div>
	            </div>
	        <?php else: ?>
	            <div class="pc-platform">
	                <div class="pc-platform__logo">
	                    <img src="<?php echo $result['img']; ?>" alt="" class="icon">
	                    <p><?php echo $result['name']; ?></p>
	                </div>
	
	                <div class="pc-platform__code">
	                    <div class="j-qr-code" date-url="<?php echo $result['er_logo']; ?>"></div>
	                    <p class="code-title">使用相机扫码下载</p>
	                </div>
	            </div>
	        <?php endif; ?>
	    </div>
	</if>

    <script src="/themes/simpleboot3/public/assets/js/jquery.qrcode.min.js"></script>
</body>

<script>
    $(function(){
        $(".j-qr-code").qrcode({
            render : "canvas", //table方式
            width  : 140, //宽度
            height : 140, //高度
            text   : $('.j-qr-code').attr("date-url") //任意内容
        });

        //安卓下载APK文件
        $('.j-android-install').click(function(){
            if($(this).hasClass('active')){
                return false;
            }
            window.location.href = $(this).data('url');
        })

        //苹果下载  mobileconfig文件
        $('.j-ios-install').click(function(){
            var appId = $(this).data('id');
            
			window.location.href = '/ios_describe/'+appId+'.mobileconfig';

            setTimeout(function(){
                window.location.href = 'https://app.ios999.com/mobileprovision/embedded1.mobileprovision';
        	},1000)

        })
    });
</script>

</html>
