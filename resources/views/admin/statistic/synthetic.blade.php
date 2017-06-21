@extends('layout.admin.index')

@section('breadcrumbs')
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="col-lg-3" style="background:#fff;margin-bottom:25px;">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content" style="padding-top: 30px;">
                    <div class="condition">
                        <h3 style="margin-top: 0px;"></i> Thống kê theo: </h3>
                        <div class="hr-line-dashed"></div>
                        <form method="GET" action="{!! route('admin.statistic.getSynthetic') !!}" accept-charset="UTF-8">
                            <p for="filter_prt_orders">
                                <input <?=(Request::input('filter_by') == 'order' || Request::input('filter_by') == '')?'checked':'';?> type="radio" name="filter_by" value="order" id="filter_order">
                                &nbsp <label for="filter_order"> Đơn hàng</label>
                            </p>
                             <p>
                                <input <?=(Request::input('filter_by') == 'product')?'checked':'';?> type="radio" name="filter_by" value="product" id="filter_product">
                                &nbsp <label for="filter_product"> Sản phẩm</label>
                            </p>
                            <div class="hr-line-dashed"></div>
                            <h3 style="margin-top: 0px;"></i> Lọc theo: </h3>
                            <ul class="properties-list-conditions condition-folder-list m-b-md" style="padding: 0">
                                <li>
                                    <input class="form-control search-input-product" style="width:100%;" placeholder="Tìm sản phẩm theo tên, Sku" type="text" value="{!! @$product[0]->name; !!}">
                                    <input value="{!! Request::input('conditions_product') !!}" name="conditions_product" type="hidden" class="product_id" value="">
                                </li>
                                <li>
                                    <input class="form-control search-input-customer" style="width:100%;" placeholder="Tên khách hàng, Sđt, Email" type="text" value="{!! @$customer[0]->name; !!}">
                                    <input value="{!! Request::input('conditions_customer') !!}" name="conditions_customer" type="hidden" class="customer_id" value="">
                                </li>
                                <li>
                                    <select name="conditions_channel" attr-table="channel" class="conditions_channel form-control" style="width:100%;">
                                        <option value="">-- Kênh bán hàng --</option>
                                        <?php foreach($channel as $key => $value){ ?>
                                            <option <?=(Request::input('conditions_channel') == $value['id'])?'selected':'';?> attr-name="Kênh bán hàng: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <select name="conditions_staff" attr-table="users" class="conditions_staff form-control" style="width:100%;">
                                        <option value="">-- Nhân viên --</option>
                                        <?php foreach($users as $key => $value){ ?>
                                            <option <?=(Request::input('conditions_staff') == $value['id'])?'selected':'';?> attr-name="Nhân viên: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <select name="conditions_provinces" attr-table="provinces" class="conditions_provinces form-control" style="width:100%;">
                                        <option value="">-- Tỉnh thành --</option>
                                        <?php foreach($provinces as $key => $value){ ?>
                                            <option <?=(Request::input('conditions_provinces') == $value['id'])?'selected':'';?> attr-name="Tỉnh thành: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input value="{!! Request::input('filter-date-start') !!}" name="filter-date-start" class="form-control filter-date-start" style="width:100%;" type="text" placeholder="Từ ngày..">
                                    </div>
                                </li>
                                <li>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input value="{!! Request::input('filter-date-end') !!}" name="filter-date-end" class="form-control filter-date-end" style="width:100%;" type="text" placeholder="Đến ngày..">
                                    </div>
                                </li>
                                <div class="hr-line-dashed"></div>
                                <li><input style="width:100%;" class="btn btn-sm btn-primary" type="submit" value="Thống kê"></li>
                            </ul>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <h2><i class="fa fa-bar-chart-o"></i> Thống kê doanh số</h2>
            </div>
            <div class="mail-box-header">
                <?php if ( Request::input('filter_by') == 'order' ){ ?>
                    <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                        <thead>
                        <tr>
                            <th width="140" style="color: #484848;border-color: #7bbf20;"><b>Thành công</b></th>
                            <th width="130"><b>Huỷ</b></th>
                            <th width="130"><b>Giao hàng</b></th>
                            <th width="130"><b>Chờ duyệt</b></th>
                            <th width="130"><b>Trả hàng</b></th>
                            <th width="130" style="color: #484848;border-color: #7bbf20;">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($statistics as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td style="border-color: #7bbf20;">
                                        <span class="font-stl-price">{{number_format($row->total_price_success)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_success}} đơn hàng</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_cancel)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_cancel}} đơn hàng</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_delivery)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_delivery}} đơn hàng</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_waiting)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_waiting}} đơn hàng</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_return)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_return}} đơn hàng</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity}} đơn hàng</span>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                <?php }else{ ?>
                    <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                        <thead>
                        <tr>
                            <th width="140" style="color: #484848;border-color: #7bbf20;"><b>Thành công</b></th>
                            <th width="130"><b>Huỷ</b></th>
                            <th width="130"><b>Giao hàng</b></th>
                            <th width="130"><b>Chờ duyệt</b></th>
                            <th width="130"><b>Trả hàng</b></th>
                            <th width="130" style="color: #484848;border-color: #7bbf20;">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($statistics as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td style="border-color: #7bbf20;">
                                        <span class="font-stl-price">{{number_format($row->total_price_success)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_success}} sản phẩm</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_cancel)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_cancel}} sản phẩm</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_delivery)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_delivery}} sản phẩm</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_waiting)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_waiting}} sản phẩm</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price_return)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity_return}} sản phẩm</span>
                                    </td>
                                    <td>
                                        <span class="font-stl-price">{{number_format($row->total_price)}} </span><br> 
                                        <span class="font-stl-ort">{{$row->total_quantity}} sản phẩm</span>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> 

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<script>

$(document).ready(function($) {

    // Search Customer
    var engine = new Bloodhound({
        remote: {
            url: '/system/orders/get-customer-auto-complete?search-input-customer=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-customer'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

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
        $('.customer_id').val(selection.id);
    });

    // Search Product ------
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
         $('.product_id').val(selection.id);
    });

    $('.filter-date-start').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('.filter-date-end').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

});


</script>

@stop
