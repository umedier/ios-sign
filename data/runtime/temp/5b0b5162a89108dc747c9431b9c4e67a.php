<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:34:"themes/simpleboot3/portal/pay.html";i:1577956127;}*/ ?>
<style>
    .sq-pay{padding: 20px;}
    .sq-pay__item{display: flex;margin-bottom: 20px;align-items: center;}
    .sq-pay__item-title{color: #777;}
    .sq-pay__item-content{}
    .sq-pay__item-content .price{font-size: 30px;color: #49afff;font-weight: bold}
    .sq-pay__item-content .unit{position: relative;top: -3px;}
    .sq-pay__item-content .pay-type{border: 1px solid #49afff;height: 44px;box-sizing: border-box;padding: 10px;border-radius: 3px;}
    .sq-pay__item-content .pay-type img{height: 100%}
    .sq-pay__item-content label{display: inline-block;margin-right: 13px;}
    .sq-pay__item-content input[type="radio"],
    .sq-pay__item-content input[type="checkbox"]{display: none}
    .sq-pay__item-content input[type="radio"]:checked + span,
    .sq-pay__item-content input[type="checkbox"]:checked + span{background-color: #49afff;color: #fff;border-color: #49afff;}
    .sq-pay__item-content label span{border: 1px solid #dcdcdc;padding: 7px 30px;display: block;text-align: center;border-radius: 40px;}
    .sq-pay-code{text-align: center;margin-top: 20px;color: #0c85da}
    .sq-pay-code__img{width: 200px;height: 200px;border: 1px solid #ECECEC;padding: 10px;margin: 10px auto}
</style>
<div class="sq-pay">
    <div class="sq-pay__item">
        <div class="sq-pay__item-title">
            购买数量：
        </div>
        <div class="sq-pay__item-content">
            <?php if(is_array($public) || $public instanceof \think\Collection || $public instanceof \think\Paginator): if( count($public)==0 ) : echo "" ;else: foreach($public as $k=>$val): ?>
                <label>
                    <input class="public<?php echo $k; ?>" data-num="<?php echo $val['coin']; ?>" type="radio" name="num" value="<?php echo $val['id']; ?>">
                    <span><?php echo $val['num']; ?>台</span>
                </label>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="sq-pay__item">
        <div class="sq-pay__item-title">
            应付金额：
        </div>
        <div class="sq-pay__item-content">
            <span class="price j-price">0</span>
            <span class="unit">元</span>
        </div>
    </div>
    <div class="sq-pay__item">
        <div class="sq-pay__item-title">
            支付方式：
        </div>
        <div class="sq-pay__item-content">
            <div class="pay-type">
                <img src="__TMPL__/public/assets/images/zhifubao.png">
            </div>
        </div>
    </div>
    <div class="sq-pay-code">
        <div class="">
            请使用支付宝“扫一扫”完成支付
        </div>
        <div class="sq-pay-code__img j-pay-code"></div>

        <div class="" style="color: #000">
            完成支付后请刷新页面
        </div>
    </div>
</div>
<script src="__TMPL__/public/assets/js/jquery-1.10.2.min.js"></script>
<script src="__STATIC__/js/qcode/jquery.qrcode.min.js"></script>
<script>
    $('input[name="num"]').click(function(){
        $('.j-price').html($(this).data('num'));

        $('.j-pay-code').html('').qrcode({
            text:"<?php echo $url; ?><?php echo url('pay/pay/pay'); ?>?id="+$(this).val()+"&type=1&pay_type=1&order_id="+GetDateNow()+"&uid="+<?php echo $user['id']; ?>,
            width: 200,
            height: 200,
        })
    })

    function GetDateNow() {
        let vNow = new Date();

        return <?php echo $user['id']; ?>+'-'+String(vNow.getFullYear())+String(vNow.getMonth() + 1)+String(vNow.getDate())+String(vNow.getHours())+String(vNow.getMinutes())+String(vNow.getSeconds())+String(vNow.getMilliseconds());
    }

    $($('input[name="num"]')[0]).trigger('click');
</script>