@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-th-list "></i> Danh sách đơn hàng </h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="/system/orders/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tạo đơn</a>
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
    <div class="col-lg-12 animated fadeInRight">    
        <div class="row">
            <div class="col-lg-12">
                <div class="block-content">
                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content">

                            <div class="row m-b-lg m-t-lg">
                                <div class="col-md-6">

                                    <div class="profile-image">
                                        <img src="img/a4.png" class="img-circle circle-border m-b-md" alt="profile">
                                    </div>
                                    <div class="profile-info">
                                        <div class="">
                                            <div>
                                                <h2 class="no-margins" style="margin-bottom:8px!important;">
                                                    {!! $data_user['name'] !!}
                                                </h2>
                                                <p style="font-weight:normal;font-size:11px;"><i class="fa fa-phone"></i> {!! $data_user['phone'] !!}</p>
                                                <small>
                                                    <i class="fa fa-map-marker"></i> {!! $data_user['address'] !!}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="GET" action="{!! route('admin.customer.getDetails',$uid) !!}" accept-charset="UTF-8">
                                            <tr>
                                                <td colspan="5"> 
                                                    <p>
                                                        <a class="sbm-filter-fast" attr-type="order-status" attr-value="0">
                                                            <small class="label <?=(Request::has('filter-order-status') && $_GET['filter-order-status'] == 0)?'lb-sm-waiting':'lb-sm-refresh';?>"><i class="fa fa-clock-o"></i> Chờ duyệt</small>
                                                        </a> 
                                                        <a class="sbm-filter-fast" attr-type="order-status" attr-value="2">
                                                            <small class="label <?=(Request::has('filter-order-status') && $_GET['filter-order-status'] == 2)?'lb-sm-delivery':'lb-sm-refresh';?>"><i class="fa fa-truck"></i> Vận chuyển</small>
                                                        </a>   
                                                        <a class="sbm-filter-fast" attr-type="order-status" attr-value="3">
                                                            <small class="label <?=(Request::has('filter-order-status') && $_GET['filter-order-status'] == 3)?'lb-sm-success':'lb-sm-refresh';?>"><i class="fa fa-check"></i> Thành công</small>
                                                        </a>
                                                        <a class="sbm-filter-fast" attr-type="order-status" attr-value="4">
                                                            <small class="label <?=(Request::has('filter-order-status') && $_GET['filter-order-status'] == 4)?'lb-sm-cancel':'lb-sm-refresh';?>"><i class="fa fa-times"></i> Huỷ đơn</small>
                                                        </a>
                                                        <a class="sbm-filter-fast" attr-type="order-status" attr-value="6">
                                                            <small class="label <?=(Request::has('filter-order-status') && $_GET['filter-order-status'] == 6)?'lb-sm-return':'lb-sm-refresh';?>"><i class="fa fa-retweet"></i> Trả hàng</small>
                                                        </a>

                                                        &nbsp; <i class="fa fa-exchange"></i> &nbsp;


                                                        <a class="sbm-filter-fast" attr-type="order-time" attr-value="today">
                                                            <small class="label <?=(Request::has('filter-order-time') && $_GET['filter-order-time'] == 'today')?'lb-sm-success':'lb-sm-refresh';?>"><i class="fa fa-calendar"></i> Hôm nay</small>
                                                        </a class="sbm-order-status">
                                                        <a class="sbm-filter-fast" attr-type="order-time" attr-value="week">
                                                            <small class="label <?=(Request::has('filter-order-time') && $_GET['filter-order-time'] == 'week')?'lb-sm-success':'lb-sm-refresh';?>"><i class="fa fa-calendar"></i> Tuần này</small>
                                                        </a>
                                                        <a class="sbm-filter-fast" attr-type="order-time" attr-value="month">
                                                            <small class="label <?=(Request::has('filter-order-time') && $_GET['filter-order-time'] == 'month')?'lb-sm-success':'lb-sm-refresh';?>"><i class="fa fa-calendar"></i> Tháng này</small>
                                                        </a>

                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%;">
                                                    <select name="filter-order-status" class="form-control filter-order-status" style="width:100%;">
                                                        <option value="-1" selected>-- Trạng thái đơn hàng --</option>
                                                        <option <?=(Request::has('filter-order-status') && Request::input('filter-order-status') == 0)?'selected':''; ?> value="0">-- Chờ duyệt --</option>
                                                        <option <?=(Request::has('filter-order-status') && Request::input('filter-order-status') == 2)?'selected':''; ?> value="2">-- Vận chuyển --</option>
                                                        <option <?=(Request::has('filter-order-status') && Request::input('filter-order-status') == 3)?'selected':''; ?> value="3">-- Thành công --</option>
                                                        <option <?=(Request::has('filter-order-status') && Request::input('filter-order-status') == 4)?'selected':''; ?> value="4">-- Huỷ đơn --</option>
                                                        <option <?=(Request::has('filter-order-status') && Request::input('filter-order-status') == 6)?'selected':''; ?> value="6">-- Trả hàng --</option>
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
                                        <th>Mã vận đơn</th>
                                        <th>Tổng tiền <sup> -vnđ </sup></th>
                                        <th width="130">Trạng thái đơn</th>
                                        <th>Giao hàng</th>
                                        <th>Thanh toán</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($rows as $row)
                                        <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                            <td>{!! $i !!}</td>
                                            <td>
                                                <?php if($row->order_status != 2){ ?>
                                                    <a href="{!! URL::route('admin.orders.details',$row->id) !!}">
                                                        <i class="fa fa-hand-o-up "></i> {!! $row->code !!}
                                                    </a>
                                                <?php }else{ ?>
                                                    <a href="{!! URL::route('admin.orders.delivery',$row->id) !!}">
                                                        <i class="fa fa-hand-o-up "></i> {!! $row->code !!}
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td >
                                                {!! $row->customers->name !!}
                                            </td>
                                            <td>
                                                <?php if($row->lading_code != ""){ ?>
                                               <a href="{!! URL::route('admin.orders.delivery',$row->id) !!}">
                                                    <i class="fa fa-external-link"></i> {!! $row->lading_code !!}
                                                </a>
                                                <?php } else{?>
                                                    _____
                                                <?php } ?>
                                            </td>
                                            <td class="hasinput">
                                                {!! number_format($row->total_price) !!}
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
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-primary">Tổng số đơn hàng: <span class="badge">{!! $order_total !!}</span> đơn</button>
                                    <button type="button" class="btn btn-success">Doanh số:  <span class="badge">{!! number_format($total_order[0]->total_sales) !!}</span> vnđ</button> 
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
            window.location.href = "/system/customer/details/<?=$uid?>?filter-order-status="+attr_value+"&filter-order-time=<?=$filterFastOrderTime?>";
        }
        if(attr_type == 'order-time'){
            window.location.href = "/system/customer/details/<?=$uid?>?filter-order-status=<?=$filterFastOrderStatus?>&filter-order-time="+attr_value;
        }
    });

});


</script>
@stop
