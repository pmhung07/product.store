@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2><i class="fa fa-user"></i> Danh sách khách hàng</h2>
    </div>
    <div class="col-lg-6 btn-add">
        <a href="system/customer/create" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp;Tạo khách hàng</a>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox" style="margin-bottom:0px;">
                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <form method="GET" action="{!! route('admin.customer.index') !!}" accept-charset="UTF-8">
                                        <tr>
                                            <td style="width:20%;">
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input value="{!! Request::input('cus_name') !!}" name="cus_name" class="form-control filter-product-sku" style="width:100%;" type="text" placeholder="Tên khách hàng">
                                                </div>
                                            </td>
                                            <td style="width:20%;">
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input value="{!! Request::input('cus_phone') !!}" name="cus_phone" class="form-control filter-product-name" style="width:100%;" type="text" placeholder="Số điện thoại">
                                                </div>
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
                        <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                                <th>Quận huyện</th>
                                <th>Tỉnh thành</th>
                                <th>Thống kê</th>
                                <th class="text-right" width="130">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>{!! $i !!}</td>
                                    <td> {!! $row->name !!}</td>
                                    <td> {!! $row->phone !!}</td>
                                    <td>
                                        <?php
                                        if($row->gender == 1){
                                            echo 'Nam';
                                        }else{
                                            echo 'Nữ';
                                        }
                                        ?>
                                    </td>
                                    <td> {!! $row->provinces_name !!}</td>
                                    <td> {!! $row->districts_name !!}</td>
                                    <td>
                                        <a href="{!! URL::route('admin.customer.getDetails',$row->id) !!}" class="btn btn-xs">
                                            <i class="fa fa-bar-chart "></i>
                                            Thống kê, báo cáo
                                        </a>
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.customer.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-edit "></i>
                                                Sửa
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.customer.delete',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-trash "></i>
                                                Xoá
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
                                        'name' =>Request::input('cus_name'),
                                        'phone' =>Request::input('cus_phone'),
                                        ))->links()
                                    }}
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
                Xoá dữ liệu Sản phẩm
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
