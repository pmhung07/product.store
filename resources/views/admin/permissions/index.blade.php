@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-unlock-alt"></i> Cấu hình phân quyền</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeInRight">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        {!! Form::open(array('route'=>'admin.permissions.index','method'=>'get')) !!}
                        <label class="control-label" for="product_group_name">Danh mục quản lý</label>
                        <input type="text" id="product_group_name" name="name" value="" placeholder="Tìm kiếm danh mục quản lý" class="form-control">
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-sm-3">
                	<div class="form-group">
                        <label class="control-label" for="status"> Tạo danh mục quản lý</label>
                       	<a href="system/permissions/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Tạo danh mục quản lý</a>
                    </div>
                </div>
            </div>
        </div>

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

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" width="10">ID</th>
                                <th class="footable-visible footable-first-column footable-sortable">Danh mục quản lý<span class="footable-sort-indicator"></span></th>
                                <th class="footable-visible footable-first-column footable-sortable">Alias<span class="footable-sort-indicator"></span></th>
                                <th width="150">Thứ tự</th>
                                <th width="150" class="text-right">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php list_permissions($data); ?>
                            </tbody>
                        </table>
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
                Xoá dữ liệu danh mục quản lý
            </div>
            <div class="modal-body">
                Nếu xoá dữ liệu danh mục quản lý, hệ thống sẽ không phân quyền được cho nhân viên tại phân vùng quản lý này trên hệ thống!
                <b>Bạn có chắc chắn muốn xoá dữ liệu danh mục quản lý này không ?</b>
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
