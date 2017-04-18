@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-th-list "></i> Danh sách trả hàng</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="/system/orders/create" class="btn btn-sm btn-trash"><i class="fa fa-plus"></i> Tạo đơn</a>
        <a href="/system/orders/return" class="btn btn-sm btn-trash" data-toggle="tooltip" data-placement="bottom" data-original-title="Trả hàng"><i class="fa fa-retweet"></i></a>
        <a href="/system/orders/trash" class="btn btn-sm btn-trash" data-toggle="tooltip" data-placement="bottom" data-original-title="Đơn ảo"><i class="fa fa-trash"></i></a>
    </div>
</div>
@stop            

<?php 
if(Request::has('filter-order-status')){
    $filterFastOrderStatus = $_GET['filter-order-status'];
}else{
    $filterFastOrderStatus = 'all';
}
if(Request::has('filter-order-time')){
    $filterFastOrderTime = $_GET['filter-order-time'];
}else{
    $filterFastOrderTime = 'all';
}
?>

@section('content')
<div class="row">
    <div class="col-lg-12">    
        <div class="row">
            <div class="col-lg-12">
                <div class="block-content">
                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="GET" action="{!! route('admin.orders.return') !!}" accept-charset="UTF-8">
                                            <tr>
                                                <td style="width:30%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input value="{!! Request::input('filter-cus-name') !!}" name="filter-cus-name" class="form-control filter-cus-name" style="width:100%;" type="text" placeholder="Tên khách hàng">
                                                    </div>
                                                </td>
                                                <td style="width:30%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input value="{!! Request::input('filter-date-start') !!}" name="filter-date-start" class="form-control filter-date-start" style="width:100%;" type="text" placeholder="Từ ngày..">
                                                    </div>
                                                </td>
                                                <td style="width:30%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input value="{!! Request::input('filter-date-end') !!}" name="filter-date-end" class="form-control filter-date-end" style="width:100%;" type="text" placeholder="Đến ngày..">
                                                    </div>
                                                </td>
                                                <td style="width:10%;">
                                                    <input class="btn btn-sm btn-primary" type="submit" value="Tìm kiếm">
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="ibox">

                        @if (Session::has('flash_message'))
                        <div class="ibox-content">
                            <div class="alert alert-success"  style="margin-bottom:0px;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!! Session::get('flash_message') !!}
                            </div>
                        </div>
                        @endif
                        <div class="ibox-content">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table table-striped table-bordered table-hover" id="editable" style="font-size:11px;">
                                    <thead>
                                    <tr>
                                        <th width="5">#</th>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Kho hàng</th>
                                        <th width="80">Số lượng hoàn</th>
                                        <th width="80">Số tiền hoàn <sup> -vnđ </sup></th>
                                        <th width="100">Trạng thái đơn</th>
                                        <th width="90">Giao hàng</th>
                                        <th width="90">Thanh toán</th>
                                        <th width="100">Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($rows as $row)
                                        <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                            <td>{!! $i !!}</td>
                                            <td>
                                                <?php if($row->order_status != 2){ ?>
                                                    <a href="{!! URL::route('admin.orders.details',$row->order_id) !!}">
                                                        {!! $row->order_code !!}
                                                    </a>
                                                <?php }else{ ?>
                                                    <a href="{!! URL::route('admin.orders.delivery',$row->order_id) !!}">
                                                        {!! $row->order_code !!}
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td >
                                                {!! $row->customer_name !!}
                                            </td>
                                            <td>
                                                {!! $row->warehouse_name !!}
                                            </td>
                                            <td class="hasinput">
                                                {!! $row->total_quantity_return !!}
                                            </td>
                                            <td class="hasinput">
                                                {!! number_format($row->total_price_return) !!}
                                            </td>
                                            <td class="hasinput">
                                               {!! getUrlOrderDetails($row->id, $row->status, $row->order_status, $row->lading_status, $row->call_status); !!}
                                            </td>
                                            <td>{!! getLadingStatus($row->order_status,$row->lading_status) !!}</td>
                                            <td>{!! getPaymentStatus($row->order_status,$row->payment_status) !!}</td>
                                            <td>
                                                {!! $row->created_at !!}
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <div class="dataTables_paginate paging_bootstrap_full">
                                        {!! $rows->appends($_GET)->links() !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content bg-block">
                                            <div class="sp-14-400"><i class="fa fa-bar-chart-o"></i> Thống kê đơn hàng</div>
                                            <table class="table table-stripped m-t-md">
                                                <tbody>
                                                <tr>
                                                    <td class="" width="10">
                                                        <i class="fa fa-circle text-success"></i>
                                                    </td>
                                                    <td class="">
                                                        Tổng số lượng đơn hoàn: <span class="text-danger">{!! count($rows) !!}</span> Đơn
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="10">
                                                        <i class="fa fa-circle text-success"></i>
                                                    </td>
                                                    <td>
                                                        Tổng số sản phẩm hoàn kho: <span class="text-danger">{!! number_format($sum_total_price['total_quantity']) !!}</span> Sản phẩm
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="10">
                                                        <i class="fa fa-circle text-success"></i>
                                                    </td>
                                                    <td>
                                                        Tổng giá trị sản phẩm hoàn kho: <span class="text-danger">{!! number_format($sum_total_price['total_price']) !!}</span> <sup class="text-danger">vnđ</sup>
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
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Xoá dữ liệu Kho hàng
            </div>
            <div class="modal-body">
                Bạn có muốn xoá dữ liệu này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                <a class="btn btn-danger btn-ok">Xoá dữ liệu</a>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

    $('.footable').footable();

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

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('[data-toggle="tooltip"]').tooltip();   

    // Filter Fast
    $('.sbm-filter-fast').click(function(){
        var attr_type = $(this).attr('attr-type');
        var attr_value = $(this).attr('attr-value');  
        if(attr_type == 'order-status'){
            window.location.href = "/system/orders/return?filter-order-status="+attr_value+"&filter-order-time=<?=$filterFastOrderTime?>";
        }
        if(attr_type == 'order-time'){
            window.location.href = "/system/orders/return?filter-order-status=6&filter-order-time="+attr_value;
        }
    });

});


</script>
@stop
