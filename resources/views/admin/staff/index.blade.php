@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-sitemap"></i> Danh sách nhân viên</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="/system/staff/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tạo nhân viên</a>
    </div>
</div>
@stop            

@section('content')
<div class="row">

    <div class="col-lg-12 animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="block-content">
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
                            <div class="ibox-content">
                                <div class="table-responsive" style="overflow-x: inherit;">
                                    <table class="table shoping-cart-table">
                                        <tbody>
                                            <form method="GET" action="{!! route('admin.staff.index') !!}" accept-charset="UTF-8">
                                                <tr>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                            <input value="{!! Request::input('staff_name') !!}" name="staff_name" class="form-control" style="width:100%;" type="text" placeholder="Tên nhân viên">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group date">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                            <input value="{!! Request::input('staff_phone') !!}" name="staff_phone" class="form-control" style="width:100%;" type="text" placeholder="Số điện thoại">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="user_position_id" style="width:100%;">
                                                            <option value="">Chọn chức vụ nhân viên</option>
                                                            <?php foreach($users_position as $key => $value){ ?>
                                                                <option value="{!! $value['id'] !!}">{!! $value['name'] !!}</option>
                                                            <?php } ?>
                                                        </select>    
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
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Họ và tên</th>
                                    <th width="150">Số điện thoại</th>
                                    <th width="150">Chức vụ</th>
                                    <th width="100">Ngày tạo</th>
                                    <th>Thống kê</th>
                                    <th>Phân quyền</th>
                                    <th class="text-right" width="100">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($rows as $row)
                                    <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                        <td>{!! $i !!}</td>
                                        <td>{!! $row->name !!}</td>
                                        <td>{!! $row->phone !!}</td>
                                        <td><a>{!! $row->users_position_name !!}</a></td>
                                        <td>{!! $row->created_at !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{!! URL::route('admin.staff.getOrders',$row->id) !!}" class="btn btn-xs">
                                                    <i class="fa fa-bar-chart "></i>    
                                                    Thống kê
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{!! URL::route('admin.staff.permissions',$row->id) !!}" class="btn btn-xs">
                                                    <i class="fa fa-unlock-alt"></i>    
                                                    Phân quyền
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-right footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <a href="{!! URL::route('admin.staff.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                    <i class="fa fa-edit "></i>    
                                                    Sửa thông tin
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
                                            'id' =>Request::input('id'),
                                            'sku' =>Request::input('sku'),
                                            'name' =>Request::input('name'),
                                            'price' =>Request::input('price'),
                                            'created_at' =>Request::input('created_at'),
                                            'sort' =>Request::input('sort'),
                                            'order' =>Request::input('order'),
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
