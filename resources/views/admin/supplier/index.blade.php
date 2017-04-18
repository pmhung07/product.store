@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-briefcase"></i> Danh sách nhà cung cấp</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/supplier/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Tạo nhà cung cấp</a>
    </div>
</div>
@stop            

@section('content')
<div class="row">
    @include('layout.admin.sidebar-settings')
    <div class="col-lg-9 animated fadeInRight">
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

                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover " id="editable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nhà cung cấp</th>
                                <th>Số điện thoại</th>
                                <th>Ngày tạo</th>
                                <th class="text-right" width="120">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $row->name !!}</td>
                                    <td>{!! $row->phone !!}</td>
                                    <td>{!! $row->created_at !!}</td>
                                   
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.supplier.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-edit "></i> Sửa
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.supplier.getDelete',$row->id) !!}"  class="btn-white btn btn-xs">
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
                <i class="fa fa-minus-circle"></i> Xoá dữ liệu nhà cung cấp
            </div>
            <div class="modal-body">
                Nếu xoá dữ liệu nhà cung cấp, các dữ liệu liên quan đến nhà cung cấp này sẽ không được hiển thị. 
                <b>Bạn có chắc chắn muốn xoá dữ liệu nhà cung cấp này không?</b>
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
