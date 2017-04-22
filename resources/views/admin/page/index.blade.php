@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Danh sách trang tĩnh </h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="{{ route('admin.page.getCreate') }}" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox" style="margin-bottom:0px;">
                    <div class="ibox-content">
                        <div class="table-responsive bg-block table-bordered" style="overflow-x: inherit;">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <form method="GET" action="" accept-charset="UTF-8">
                                        <tr>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input value="{!! Request::input('title') !!}" name="title" class="form-control filter-product-sku" style="width:100%;" type="text" placeholder="Tiêu đề">
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

                <div class="ibox">

                    @include('includes/flash-message')

                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="">Tiêu đề</th>
                                        <th width="150">Ngày tạo</th>
                                        <th class="text-right" width="120">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i= (Request::get('page', 1) - 1) * $rows->perPage();
                                ?>
                                @foreach($rows as $row)
                                    @php $i ++ @endphp
                                    <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                        <td>{{$i}}</td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td class="text-right footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <a href="{!! URL::route('admin.page.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                    <i class="fa fa-edit "></i> Sửa
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.page.getDelete',$row->id) !!}"  class="btn-white btn btn-xs">
                                                    <i class="fa fa-trash "></i> Xoá
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-left paging-lst table">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {!! $rows->appends($_GET)->links() !!}
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
                Xoá dữ liệu
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
