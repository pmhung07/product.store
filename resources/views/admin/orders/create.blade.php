@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-plus "></i> Tạo đơn hàng </h2>
    </div>
    <div class="col-lg-2">

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

        <div class="row">
            <div class="col-md-8">
                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Sản phẩm trong đơn hàng</span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title" style="background-color:#fbfafa;color: #000;padding-top: 0px;border: none">
                            <span class="pull-right"></span>
                            <div class="input-group" style="width:100%;">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <input type="text" name="search-input-product" class="form-control search-input-product"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm sản phẩm theo tên, mã sản phẩm, barcode..">
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table table-zip">
                                    <thead>
                                        <tr>
                                            <th width="220">Tên sản phẩm</th>
                                            <th width="70">Số lượng</th>
                                            <th width="120">Giá bán</th>
                                            <th width="120">Thành tiền</th>
                                            <th width="120" class="text-right" width="">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody class="append_product">
                                        <tr class="gradeX" style="background: #fafafb;color: #131212;border-top: solid 1px #ffffff;">
                                            <td colspan="3" style="text-align:left;">
                                                <b style="margin: 5px 0px!important;display: -webkit-inline-box;color: #6d889c;">Tổng giá trị đơn hàng (vnđ)</b>
                                            </td>
                                            <td colspan="2">
                                                <input readonly class="order_total_price form-control" style="width: 100%;border: none;color: #ed5565;font-weight: 600;background: #fafafb;" type="text" value=" 0"> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Thông tin đơn hàng</span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12 form-horizontal table-zip">
                                    <div class="form-group"><label class="col-sm-3 control-label">Phương thức</label>
                                        <div class="col-sm-9">
                                            <select class="form-control fill-cus-payment-method" style="width:100%;">
                                                <option value="0">-- Phương thức thanh toán --</option>
                                                <?php foreach($payment_methods as $key => $value){ ?>
                                                    <option value="{!! $value['id'] !!}">-- {!! $value['name'] !!} --</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Thanh toán</label>
                                        <div class="col-sm-9">
                                            <select class="form-control fill-order-payment-status" style="width:100%;">
                                                <option value="1">-- Đã thanh toán --</option>
                                                <option selected value="2">-- Chưa thanh toán --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Kênh bán hàng</label>
                                        <div class="col-sm-9">
                                            <select class="form-control fill-cus-channel" style="width:100%;">
                                                <option value="0">-- Kênh bán hàng --</option>
                                                <?php foreach($channel as $key => $value){ ?>
                                                    <option value="{!! $value['id'] !!}">-- {!! $value['name'] !!} --</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-w-m btn-primary btn-order-submit">
                                                <i class="fa fa-plus"></i>
                                                Tạo đơn hàng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="block-content block-content-customer">
                    <div class="tab-wrap">
                        <span>Thông tin khách hàng</span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title" style="background-color:#fbfafa;color: #000;padding-top: 0px;border: none">
                            <span class="pull-right"></span>
                            <div class="input-group" style="width:100%;">
                                <div class="form-group" style="margin-bottom:0px;">
                                    <input type="text" name="search-input-customer" class="form-control search-input-customer"  style="width:100%;" autocomplete="off"  placeholder="Thông tin tìm kiếm">
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form class="form-horizontal m-t-md" action="#">
                                        <input type="hidden" class="fill-cus-id" value="0">
                                        <tr>
                                            <td style="width:100%;">
                                                <input class="form-control fill-cus-name" style="width:100%;" placeholder=" Nhập tên khách hàng" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100%;">
                                                <input class="form-control fill-cus-email" style="width:100%;" placeholder=" Nhập địa chỉ Email" type="text" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100%;">
                                                <input class="form-control fill-cus-phone" style="width:100%;" placeholder=" Nhập số điện thoại" type="text" value="">
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td style="width:100%;">
                                                <input type="text" class="form-control fill-cus-birthdate" data-mask="9999-99-99" placeholder="">
                                                <small style="text-align: center;display: block;margin-top: 10px;"> <b>Ngày sinh</b>: Năm / Tháng / Ngày </small>
                                            </td>
                                        </tr>-->            
                                        <tr>
                                            <td style="width:100%;">
                                                <select class="form-control fill-cus-gender" style="width:100%;">
                                                    <option value="-1">-- Giới tính --</option>
                                                    <option value="1">-- Nam --</option>
                                                    <option value="0">-- Nữ --</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100%;">
                                                <select class="form-control fill-cus-provinces" style="width:100%;">
                                                    <option value="0">-- Tỉnh thành --</option>
                                                    <?php foreach($provinces as $item){ ?>
                                                        <option value="<?=$item->id?>">-- <?=$item->name?> --</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100%;" class="cus-districts">
                                                <select class="form-control fill-cus-districts" style="width:100%;">
                                                    <option value="0">-- Quận huyện --</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:100%;">
                                                <input class="form-control fill-cus-address" style="width:100%;" placeholder=" Địa chỉ" type="text" value="">
                                            </td>
                                        </tr>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

jQuery(document).ready(function($) {
    // Search Customer
    var engine = new Bloodhound({
        remote: {
            url: '/get-customer-auto-complete?search-input-customer=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-customer'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $(".search-input-customer").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),
        name: 'usersList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+' <br>  '+ data.email +' <br>  '+ data.phone +'</div>'
            }
        },
        engine: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $('.fill-cus-id').val(selection.id);
        $('.fill-cus-name').val(selection.name);
        $('.fill-cus-email').val(selection.email);
        $('.fill-cus-phone').val(selection.phone);
        $('.fill-cus-address').val(selection.address);
        $('.fill-cus-gender').val(selection.gender);
        $('.fill-cus-provinces').val(selection.province_id);
        $('.fill-cus-birthdate').val(selection.birthdate);

        token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type:"POST",
            url:'load-districts',
            data:{
                _token: token,
                provinces_id : selection.province_id
            },
            success:function(data){
                $('.fill-cus-districts').empty();
                $('.fill-cus-districts').append(data.strappend);
                $('.fill-cus-districts').val(selection.district_id);
            }
        });
    });


    // Search Product
    var engineProduct = new Bloodhound({
        remote: {
            url: '/get-product-auto-complete?search-input-product=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-product'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engineProduct.initialize();

    $(".search-input-product").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engineProduct.ttAdapter(),
        name: 'productList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+' <br>  Sku: '+ data.sku +'</div>'
            }
        },
        engineProduct: Hogan
    }).on('typeahead:selected', function(event, selection) {
        var str_product='<tr class="gradeX get_parent_'+selection.id+'"><input class="get_product_id form-control" type="hidden" value="'+ selection.id +'"/><td style="text-align:left;"><input readonly class="form-control" value="'+ selection.name +'"></input></td><td><input id="quantity_suggest" class="product_quantity form-control" style="width:100%;" type="text" min="1" max="999" value="1"></td><td style="text-align:left;"><input readonly class="price_product form-control" value="'+ $.number(selection.price) +'" /><input type="hidden" class="get_price_product" value="'+ selection.price +'" /></td><td style="text-align:left;"><input readonly class="line_total_price form-control" value="'+ $.number(selection.price) +'"/><input class="get_line_total_price" type="hidden" value="'+ selection.price +'"/></td><td><div class="btn-group"><a href="#" data-toggle="modal" data-href="" class="btn-danger btn btn-delete btn-delete-product"><i class="fa fa-trash "></i> Xoá</a></div></td>';

        if(!$('.append_product tr').hasClass('get_parent_'+selection.id)){
            $('.append_product').prepend(str_product);
            // SET TOTAL PRICE
            total_price = 0;
            $( ".append_product tr .get_line_total_price" ).each(function( index ) {
                total_price  = parseInt(total_price)      + parseInt($(this).val());
            });
            $(".order_total_price").val($.number(total_price));    
        }
    });

    // Append sản phẩm vào đơn hàng sau khi select sản phẩm
    $('.append_product').on('keyup', '.product_quantity', function() {
        quantity = $(this).val();
        product_id = $(this).parent();
        price_product = $(this).parent().parent().children().children('.get_price_product').val();
        $(this).parent().parent().children().children('.line_total_price').val($.number(quantity * price_product));
        $(this).parent().parent().children().children('.get_line_total_price').val(quantity * price_product);

        total_price = 0;
        $( ".append_product tr .get_line_total_price" ).each(function( index ) {
            total_price  = parseInt(total_price) + parseInt($(this).val());
        });
        $(".order_total_price").val($.number(total_price));    
    });

    // Thay đổi giá trị đơn hàng khi thay đổi số lượng sản phẩm
    $('.append_product').on('click', '.btn-delete-product', function() {
        $(this).parent().parent().parent('tr').remove();
        total_price = 0;
        $( ".append_product tr .get_line_total_price" ).each(function( index ) {
            total_price  = parseInt(total_price) + parseInt($(this).val());
        });
        $(".order_total_price").val($.number(total_price));    
    });

    // Gọi Datepicker khi chọn ngày tháng năm sinh
    /*$('.fill-cus-birthdate').datepicker({
        todayBtn: "linked",
        format: "yyyy-mm-dd",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });*/


});

$('.btn-order-submit').on('click',function(e){            
    var customer_id = $('.fill-cus-id').val();
    var customer_name = $('.fill-cus-name').val();
    var customer_phone = $('.fill-cus-phone').val();
    var customer_email = $('.fill-cus-email').val();
    var customer_address = $('.fill-cus-address').val();
    var customer_birthdate = $('.fill-cus-birthdate').val();
    var customer_gender = $('.fill-cus-gender').val();
    var customer_provinces = $('.fill-cus-provinces').val();
    var customer_districts = $('.fill-cus-districts').val();
    var payment_methods = $('.fill-cus-payment-method').val();
    var channel = $('.fill-cus-channel').val();
    //var order_status = $('.fill-order-status').val();
    var order_status = 0;
    var payment_status = $('.fill-order-payment-status').val();

    var exitSubmit = false;

    if(customer_phone == ""){
        alert("Số điện thoại khách hàng không được để trống!");
        return false;
    }else{
        var arrayProductId = {};
        if($( ".append_product tr" ).length <= 1){
            alert("Đơn hàng chưa có sản phẩm. Hãy thêm sản phẩm vào đơn hàng!");
            return false;
        }else{
            $( ".append_product tr" ).each(function( index ) {
                if($(this).children().children(".product_quantity").val() == 0){
                    exitSubmit = true;
                    return false;
                }else{
                    arrayProductId[$(this).children(".get_product_id").val()] = $(this).children().children(".product_quantity").val();
                }
            });
        }    
    }

    if (exitSubmit) {
        alert("Số lượng sản phẩm không được để trống hoặc bằng 0!");
        return false;
    }

    token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type:"POST",
        url:'post-order',
        data:{
            _token: token,
            product_id : arrayProductId, 
            customer_id : customer_id,
            customer_name : customer_name,
            customer_phone : customer_phone,
            customer_email : customer_email,
            customer_address : customer_address,
            customer_birthdate : customer_birthdate,
            customer_gender : customer_gender,
            customer_provinces : customer_provinces,
            customer_districts : customer_districts,
            payment_methods : payment_methods,
            channel : channel,
            order_status:order_status,
            payment_status:payment_status
        },
        success:function(data){
            alert(data.msg);
            window.location.href = "system/orders/index?filter-order-status=0";
        }
    });
});

$('.fill-cus-provinces').change(function() {
    provinces_id = $('.fill-cus-provinces').val();
    token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:"POST",
        url:'load-districts',
        data:{
            _token: token,
            provinces_id : provinces_id
        },
        success:function(data){
            $('.fill-cus-districts').empty();
            $('.fill-cus-districts').append(data.strappend);
        }
    });
});

</script>
@stop
