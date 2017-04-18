@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-sitemap"></i> Danh sách nhóm sản phẩm</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/product-group/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Thêm nhóm sản phẩm</a>
    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::open(array('route'=>'admin.product-group.index','method'=>'get')) !!}
                        <label class="control-label" for="product_group_name">Nhóm sản phẩm</label>
                        <input type="text" id="product_group_name" name="product_group_name" value="" placeholder="Tìm kiếm nhóm sản phẩm theo tên" class="form-control">
                        {!! Form::close() !!}
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

                        <table class="table table-striped table-bordered table-hover table-zip">
                            <thead>
                            <tr>
                                <th width="10">#</th>
                                <th class="footable-visible footable-first-column footable-sortable">Tên nhóm<span class="footable-sort-indicator"></span></th>
                                <th width="150" class="text-right">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php list_cate($data); ?>
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
                Xoá dữ liệu Nhóm sản phẩm
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
