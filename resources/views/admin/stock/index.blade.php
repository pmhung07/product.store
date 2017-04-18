@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-database"></i> Danh sách kho hàng</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/stock/create" class="btn btn-trash " ><i class="fa fa-plus"></i>&nbsp;Tạo kho hàng</a>
    </div>
</div>
@stop            

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">

                    @if (Session::has('flash_message'))
                    <div class="ibox-content">
                        <div class="alert alert-success"  style="margin-bottom:0px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('flash_message') !!}
                        </div>
                    </div>
                    @endif

                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content border-radius-no">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="GET" action="{!! route('admin.stock.index') !!}" accept-charset="UTF-8">
                                            <tr>
                                                <td style="width:45%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input value="{!! Request::input('name') !!}" name="name" class="form-control" style="width:100%;" type="text" placeholder="Tên kho..">
                                                    </div>
                                                </td>
                                                <td style="width:45%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input value="{!! Request::input('code') !!}" name="code" class="form-control" style="width:100%;" type="text" placeholder="Mã kho">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="btn btn-sm btn-primary" type="submit" value="Tìm kiếm">
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover " id="editable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="150">Tên kho hàng</th>
                                <th width="">Mã kho hàng</th>
                                <th>Địa chỉ kho hàng</th>
                                <th width="150">Người tạo</th>
                                <th width="100">Ngày tạo</th>
                                <th>Số lượng tồn kho</th>
                                <th>Giá trị tồn kho <sup class="text-danger"> - vnđ</sup></th>
                                <th width="50" class="text-right"><i class="fa fa-wrench"></i> Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>{!! $i !!}</td>
                                    <td>
                                        <a href="{!! URL::route('admin.stock.getUpdate',$row->id) !!}">{!! $row->name !!}</a>
                                    </td>
                                    <td>
                                        {!! $row->code !!}
                                    </td>
                                    <td>{!! $row->address !!}</td>
                                    <td>{!! get_user_name_position($row->admin_id) !!}</td>
                                    <td>{!! $row->created_at !!}</td>
                                    <td class="text-danger">
                                        {!! number_format($row->quantity_inventory) !!}
                                    </td>
                                    <td class="text-danger">
                                        {!! number_format($row->total_price_inventory) !!}
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.stock.getDelete',$row->id) !!}"  class="btn-white btn btn-xs">
                                                <i class="fa fa-trash "></i> Xoá
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {{ $rows->appends(array(
                                        'id' =>Request::input('id')
                                        ))->links()
                                    }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content bg-block">
                                        <div class="sp-14-400"><i class="fa fa-bar-chart-o"></i> Thống kê kho hàng</div>
                                        <table class="table table-stripped m-t-md">
                                            <tbody>
                                            <tr>
                                                <td class="" width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td class="">
                                                    Tổng số lượng kho hàng: <span class="text-danger">{!! count($rows) !!}</span> Kho
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td>
                                                    Tổng số sản phẩm tồn kho: <span class="text-danger">{!! number_format($sum_total_price['total_quantity']) !!}</span> sản phẩm
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td>
                                                    Tổng giá trị sản phẩm tồn kho: <span class="text-danger">{!! number_format($sum_total_price['total_price']) !!}</span> <sup class="text-danger">vnđ</sup>
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

    $('#date_added').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#date_modified').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>
@stop
