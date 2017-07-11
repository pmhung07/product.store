@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2><i class="fa fa-plus "></i> Tạo phiếu trả hàng </h2>
    </div>
    <div class="col-lg-6">
        <form method="GET" action="/system/return-product/processing">
            <div class="input-group" style="width:100%;">
                <div class="form-group" style="margin-bottom:0px;">
                    <input value="{!! Request::input('order-code') !!}" type="text" name="order-code" class="form-control order-code"  style="width: 100%;margin-top: 10px;border: solid 1px #c75554;border-radius: 5px;color: #313131;" autocomplete="off"  placeholder="Nhập mã đơn hàng để tạo phiếu trả hàng">
                </div>
            </div>
        </form>
    </div>
</div>
@stop            

@section('content')

<div class="row">

    <div class="col-lg-12 animated fadeInRight">

        @if (count($errors) > 0)
        <div class="ibox-content">
            <div class="alert alert-danger" style="margin-bottom:0px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        @if (Session::has('flash_message'))
            <div class="ibox-content">
                <div class="alert alert-success"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_message') !!}
                </div>
            </div>
        @endif

        @if (Session::has('flash_error'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_error') !!}
                </div>
            </div>
        @endif

        <?php 
        $count_orders = count($orders);
        if($count_orders > 0){ ?>
            <?php if($orders[0]['status'] == 1 && ( $orders[0]['order_status'] == 3 || ($orders[0]['order_status'] == 2 && ($orders[0]['lading_status'] == 2 || $orders[0]['lading_status'] == 3 )))){ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="block-content">
                        <div class="tab-wrap"></div>
                        <div class="ibox">
                            <div class="ibox-content">
                                <a><h2>Chi tiết mã đơn hàng: <?=$orders[0]['code']?></h2></a>
                                <div class="hr-line-dashed"></div>
                                <div class="table-responsive" style="overflow-x: inherit;">
                                    <table class="table shoping-cart-table table-zip">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="10">#</th>
                                                <th width="220">Tên sản phẩm</th>
                                                <th width="130">Số lượng mua ban đầu</th>
                                                <th width="140">Số lượng trả lại</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_product">
                                            <?php $total_price = 0;$count = 1;foreach($order_details as $value){ ?>
                                                <tr class="dtl_product gradeX get_parent_<?=$value['product_id']?> element_<?=$count?>">
                                                    <td width="10">
                                                        <input class="form-control text-center" readonly style="width:100%;" value="<?=$count?>"> 
                                                    </td>
                                                    <input class="get_product_id form-control" type="hidden" value="<?=$value['product_id']?>">
                                                    <td style="text-align:left;">
                                                        {!! $value['name'] !!}<br>
                                                        <span style="font-size:10px;">SKU:</span> 
                                                        <span class="font-stl-ort">{!! $value['sku'] !!}</span>
                                                    </td>
                                                    <td>
                                                        <input id="quantity_suggest" class="product_quantity form-control" readonly style="width:100%;" type="text" min="1" max="999" value="<?=$value['quantity']?>">
                                                    </td>
                                                    <td>
                                                        <input readonly id="quantity_return" class="product_quantity_return form-control" style="border:solid 1px #c75554;width:100%;" type="text" min="1" max="999" value="<?=$value['quantity']?>">
                                                    </td>
                                                </tr>
                                            <?php $total_price = $total_price + ($value['price'] * $value['quantity']); $count++; } ?>

                                            <tr>
                                                <td colspan="6">
                                                    <div style="margin-bottom:10px;color:black;font-weight:600;"><i class="fa fa-angle-double-down"></i> Nhập lại vào kho: </div>
                                                    <select readonly class="form-control warehouse_return" style="width:100%;color:black;">
                                                        <option value="-1">-- Chọn kho nhập lại hàng --</option>
                                                        <?php foreach($warehouse as $key => $value){ ?>
                                                            <option <?=($orders[0]['export_warehouse'] == $value->id)?'selected':'';?> value="<?=$value->id?>">-- <?=$value->name?> --</option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="form-group">
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <button type="submit" class="btn btn-w-m btn-primary btn-order-submit">
                                                                    <i class="fa fa-plus"></i>
                                                                    Xác nhận hàng trả vào kho
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
                <div class="middle-box text-center animated fadeInRightBig">
                    <h3 class="font-bold"><i class="fa fa-warning"></i> Báo cáo tình trạng đơn hàng</h3>
                    <div class="error-desc">
                        Không thực hiện được thao tác trả hàng vì sản phẩm vẫn nằm trong kho, hoặc đơn hàng nãy đã được hoàn trả trước đó!
                    </div>
                </div>
            <?php } ?>
        <?php }else{ ?>
            <div class="middle-box text-center animated fadeInRightBig">
                <h3 class="font-bold"><i class="fa fa-warning"></i> Không tìm thấy đơn hàng</h3>
                <div class="error-desc">
                    Đơn hàng không tồn tại trên hệ thống
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />

@stop

@section('script')

<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>
<script src="js/jquery.number.js"></script>
<script src="js/bootstrap-confirmation.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<script type="text/javascript">

// Thay đổi giá trị đơn hàng khi thay đổi số lượng sản phẩm
$('.append_product').on('keyup', '.product_quantity_return', function() {
    product_id = $(this).parent();
    product_quantity = $(this).parent().parent().children().children('.product_quantity').val();
    price_product = $(this).parent().parent().children().children('.get_price_product').val();

    // Gán số lượng còn lại
    if( ($(this).val()) <= parseInt(product_quantity) ){
        $(this).parent().parent().children().children('.product_quantity_remain').val($.number(product_quantity - $(this).val()));
        product_remain = $(this).parent().parent().children().children('.product_quantity_remain').val();
    }else{
        $(this).parent().parent().children().children('.product_quantity_remain').val(product_quantity);
        $(this).parent().parent().children().children('.product_quantity_return').val(1);
        product_remain = product_quantity;
    }

    /*if( $(this).val() == 0 ){
        $(this).parent().parent().children().children('.product_quantity_return').val(1);
    }*/

    $(this).parent().parent().children().children('.line_total_price').val($.number(parseInt(product_remain) * price_product));
    $(this).parent().parent().children().children('.get_line_total_price').val(parseInt(product_remain) * price_product);

    total_price = 0;
    $( ".append_product tr .get_line_total_price" ).each(function( index ) {
        total_price  = parseInt(total_price) + parseInt($(this).val());
    });
    $(".order_total_price").val($.number(total_price));    
});

$('.btn-order-submit').on('click',function(e){            

    var exitSubmit = true;
    var arrayProductId = {};
    var warehouse_return = $('.warehouse_return').val();

    if( warehouse_return != -1 ){

        if($( ".append_product tr.dtl_product" ).length < 1){
            alert("Đơn hàng chưa có sản phẩm. Không thực hiện được thao tác hoàn lại sản phẩm vào kho!");
            return false;
        }else if($( ".append_product tr.dtl_product" ).length == 1){
            if( $('.product_quantity_return').val() == 0 ){
                alert("Số lượng trả hàng không được bằng 0 tại đơn hàng này!");
                return false;
            }else{
                exitSubmit = false;
            }
        }else if($( ".append_product tr.dtl_product" ).length > 1){
            var product_length = $( ".append_product tr.dtl_product" ).length;
            for(i = 1; i <= product_length; i++){
                if( $( ".element_"+i+" .product_quantity_return").val() == 0){
                    exitSubmit = true;
                }else{
                    exitSubmit = false; break;
                }
            }
        }     

        $( ".append_product tr.dtl_product" ).each(function( index ) {
            arrayProductId[$(this).children(".get_product_id").val()] = $(this).children().children(".product_quantity_return").val();
        });

        if (exitSubmit) {
            alert("Phải có ít nhất một sản phẩm được hoàn lại mới thực hiện được thao khác hoàn trả sản phẩm vào kho!");
            return false;
        }

        token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type:"POST",
            url:'post-return-product',
            data:{
                _token: token,
                product_id : arrayProductId, 
                warehouse_return : warehouse_return,
                order_id : <?=@$orders[0]['id']?>,
                order_code : "<?=@$orders[0]['code']?>"
            },
            success:function(data){
                alert(data.msg);
                window.location.href = "system/orders/index?filter-order-status=6";
            }
        });
    }else{
        alert("Bạn phải chọn kho hàng đế nhập hàng!");
    }
});

</script>
@stop
