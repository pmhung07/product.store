<?php
echo $skeleton;
?>

<?php
$input_site_id = '<input type="hidden" name="site_id" value="'.$site_id.'">';
$input_product_id = '<input type="hidden" name="product_id" value="'.$product_id.'">';
?>

<script>
	$('.hd-appent').append('<?=$input_site_id?>');
	$('.hd-appent').append('<?=$input_product_id?>');
    $('head').append('<title><?=$page_title?></title>')
</script>

<!--<div class="landing_page_order">
	<form action="" method="POST" class="form-horizontal">
        <input type="hidden" name="_token" value="">

        <div class="landing_page_order_title col-sm-12">
            <span class="landing_page_title"><i class="fa fa-shopping-cart"></i>&nbsp; Đặt hàng trực tuyến</span>
            <span class="landing_page_order_avai"><i class="fa fa-angle-up"></i></span>
            <span class="landing_page_order_invi"><i class="fa fa-minus"></i></span>
        </div>
        <div class="landing_page_order_content">
            <div class="hr-line-dashed"></div>
            <div class="col-sm-12">
            	<input placeholder="Họ và tên" name="customer_name" type="text" class="form-control landing_page_input">
            </div>
            <div class="col-sm-12">
            	<input placeholder="Email" name="customer_email" type="email" class="form-control landing_page_input">
            </div>
            <div class="col-sm-12">
            	<input placeholder="Số điện thoại" name="customer_phone" type="text" class="form-control landing_page_input">
            </div>
            <div class="col-sm-12">
            	<input placeholder="Số lượng mua" name="product_quantity" type="text" class="form-control landing_page_input">
            </div>
            <div class="col-sm-12">
                <select class="form-control m-b landing_page_select" name="customer_payment_methods">
                    <option value="" selected>Chọn phương thức thanh toán</option>
                    <?//php foreach($payment_methods as $value){ ?>
                        <option value="<?//=$value['id']?>"><?//=$value['name']?></option>
                    <?//php } ?>
                </select>
            </div>
            <input type="hidden" value="{!! $channel_id !!}" name="channel_id">
            <input type="hidden" value="{!! $product_id !!}" name="product_id">
            <input type="hidden" value="{!! $product_price[0]['price'] !!}" name="product_price">
            <div class="hr-line-dashed"></div>
            <div class="col-sm-12">
                <button class="btn btn-primary landing_page_btn" type="submit">Đặt hàng</button>
            </div>
        </div>
    </form>
</div>-->

<script>
    $('.landing_page_order_title').click(function(){
        if($(this).hasClass('landing_page_order_title_active')){
            $('.landing_page_order_content').hide();
            $(this).removeClass('landing_page_order_title_active');
            $('.landing_page_order_avai').show();
            $('.landing_page_order_invi').hide();
        }else{
            $('.landing_page_order_content').show();
            $(this).addClass('landing_page_order_title_active');
            $('.landing_page_order_avai').hide();
            $('.landing_page_order_invi').show();
        }
    });

</script>

<style>
.landing_page_order_invi{
    display:none;
}
.landing_page_title{
    color: #fff;
    cursor: pointer;
    font-size: 16px;
}
.landing_page_order{
    padding: 5px 0px 5px 0px;
    width: 270px;
    position: fixed;
    bottom: 0px;
    left: 25px;
    background: #5586b9;
    border-radius: 0px 5px 0px 0px;
    z-index: 1;
}
.landing_page_input{
    border: none;
    margin: 5px 0px;
    height: 35px;
    border-radius: 3px;
}
.hr-line-dashed {
	border-top: 1px dashed #e7eaec;
	color: #ffffff;
	background-color: #ffffff;
	height: 1px;
	margin: 10px 0;
	float: left;
	width: 100%;
}
.landing_page_btn{
    color: #fff;
    background-color: #679dd6;
    padding:7px 35px;
    margin-bottom:5px;
}
.landing_page_btn:hover{
    color: #fff;
    background-color: #74afec;
}
.landing_page_order_content{
    display:none;
}
.landing_page_order_avai{
    color:#fff;
    float:right;
}
.landing_page_order_invi{
    color:#fff;
    float:right;
}
.landing_page_select{
    border: none;
    height: 35px;
    border-radius: 3px;
    margin-top:5px;
}
</style>