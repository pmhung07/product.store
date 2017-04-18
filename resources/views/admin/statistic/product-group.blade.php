@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-bar-chart-o"></i> Thống kê, báo cáo theo nhóm sản phẩm</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">

                    <div class="table-responsive" style="overflow-x: inherit;">
                        <table class="table shoping-cart-table">
                            <tbody>
                                <tr>
                                    <td style="width:25%;">
                                        <select class="conditions_product_group form-control" style="width:100%;">
                                            <option value="-1">-- Nhóm sản phẩm --</option>
                                            <?php foreach($product_group as $key => $value){ ?>
                                                <option value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:25%;">
                                        <input class="form-control search-input-customer" style="width:100%;" placeholder="Tên khách hàng, Sđt, Email" type="text" value="">
                                        <input type="hidden" class="customer_id" value="">
                                    </td>
                                    <td style="width:25%;">
                                        <select attr-table="channel" class="conditions_channel form-control" style="width:100%;">
                                            <option value="-1">-- Kênh bán hàng --</option>
                                            <?php foreach($channel as $key => $value){ ?>
                                                <option value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:25%;">
                                        <select attr-table="users" class="conditions_staff form-control" style="width:100%;">
                                            <option value="-1">-- Nhân viên --</option>
                                            <?php foreach($users as $key => $value){ ?>
                                                <option value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:25%;">
                                        <select attr-table="provinces" class="conditions_provinces form-control" style="width:100%;">
                                            <option value="-1">-- Tỉnh thành --</option>
                                            <?php foreach($provinces as $key => $value){ ?>
                                                <option attr-name="Tỉnh thành: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:25%;">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input value="{!! Request::input('filter-date-start') !!}" name="filter-date-start" class="form-control filter-date-start" style="width:100%;" type="text" placeholder="Từ ngày..">
                                        </div>
                                    </td>
                                    <td style="width:25%;">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input value="{!! Request::input('filter-date-end') !!}" name="filter-date-end" class="form-control filter-date-end" style="width:100%;" type="text" placeholder="Đến ngày..">
                                        </div>
                                    </td>
                                    <td style="width:25%;">
                                        <a style="width:100%;height:33px;line-height:32px;padding:0px;margin:0px;" class="btn btn-sm btn-primary submit-filter"><i class="fa fa-search"></i> Thống kê</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 animated">
                        <div class="row">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content mailbox-content">
                                    <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                        <thead>
                                        <tr>
                                            <th width="15">#</th>
                                            <th style="color: #484848;"><b>Nhóm sản phẩm</b></th>
                                            <th width="140" style="color: #484848;border-color: #7bbf20;"><b>Tổng tiền thành công</b></th>
                                            <th width="130"><b>Tổng tiền huỷ</b></th>
                                            <th width="130"><b>Đang giao hàng</b></th>
                                            <th width="130"><b>Đang chờ duyệt</b></th>
                                            <th width="130">Tổng tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; ?>
                                            @foreach($statistics_product as $row)
                                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                                    <td>{{$i}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td style="border-color: #7bbf20;">
                                                        <span class="font-stl-price">{{number_format($row->total_price_success)}} </span><br> 
                                                        <span class="font-stl-ort">{{$row->total_quantity_success}} sp</span>
                                                    </td>
                                                    <td>
                                                        <span class="font-stl-price">{{number_format($row->total_price_cancel)}} </span><br> 
                                                        <span class="font-stl-ort">{{$row->total_quantity_cancel}} sp</span>
                                                    </td>
                                                    <td>
                                                        <span class="font-stl-price">{{number_format($row->total_price_delivery)}} </span><br> 
                                                        <span class="font-stl-ort">{{$row->total_quantity_delivery}} sp</span>
                                                    </td>
                                                    <td>
                                                        <span class="font-stl-price">{{number_format($row->total_price_waiting)}} </span><br> 
                                                        <span class="font-stl-ort">{{$row->total_quantity_waiting}} sp</span>
                                                    </td>
                                                    <td>
                                                        <span class="font-stl-price">{{number_format($row->total_price)}} </span><br> 
                                                        <span class="font-stl-ort">{{$row->total_quantity}} sp</span>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
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

$('.submit-filter').click(function(){
    var get_url                     = '?getby=product';
    var customer_id                 = $('.customer_id').val();
    var conditions_channel          = $('.conditions_channel').val();
    var conditions_staff            = $('.conditions_staff').val();
    var conditions_provinces        = $('.conditions_provinces').val();
    var conditions_product_group    = $('.conditions_product_group').val();
    var filter_date_start           = $('.filter-date-start').val();
    var filter_date_end             = $('.filter-date-end').val();

    if( customer_id != '' ){
        get_url = get_url + '&conditions_customers='+customer_id;
    }

    if( conditions_product_group != -1 ){
        get_url = get_url + '&conditions_product_group='+conditions_product_group;
    }

    if( conditions_channel != -1 ){
        get_url = get_url + '&conditions_channel='+conditions_channel;
    }

    if( conditions_staff != -1 ){
        get_url = get_url + '&conditions_staff='+conditions_staff;
    }

    if( conditions_provinces != -1 ){
        get_url = get_url + '&conditions_provinces='+conditions_provinces;
    }

    if( filter_date_start != '' ){
        get_url = get_url + '&filter-date-start='+filter_date_start;
    }

    if( filter_date_end != '' ){
        get_url = get_url + '&filter-date-end='+filter_date_end;
    }
    

    window.location.replace("/system/statistic/product-group"+get_url);

});

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
     $('.product_id').val(selection.id);
});


$('.filter-date-start').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function (e) {

});

$('.filter-date-end').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function (e) {

});
</script>

@stop
