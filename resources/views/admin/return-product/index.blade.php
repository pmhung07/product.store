@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2><i class="fa fa-indent"></i> Danh sách phiếu trả hàng</h2>
    </div>
    <div class="col-lg-6">
        <form method="GET" action="/system/return-product/processing">
            <div class="input-group" style="width:100%;">
                <div class="form-group" style="margin-bottom:0px;">
                    <input value="{!! Request::input('order-code') !!}" type="text" name="order-code" class="form-control order-code"  style="width: 100%;margin-top: 10px;border: solid 1px #c75554;border-radius: 5px;color: #313131;" autocomplete="off"  placeholder="Nhập mã đơn hàng để tạo phiếu trả hàng">
                </div>
            </div>
        </form>
    </div>
</div>
@stop            

@section('content')
<div class="row">

    <div class="col-lg-12 animated fadeInRight">
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
                        <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã phiếu</th>
                                <th>Mã đơn hàng</th>
                                <th>Người nhập</th>
                                <th>Chức vụ</th>
                                <th>Kho hàng nhập</th>
                                <th>Ngày tạo</th>
                                <th class="text-right">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>{!! $i !!}</td>
                                    <td>
                                        {!! $row->code !!}
                                    </td>
                                    <td>
                                        {!! $row->order_code !!}
                                    </td>
                                    <td>
                                        {!! $row->user_name !!}
                                    </td>
                                    <td>
                                        {!! $row->users_position_name !!}
                                        <?php 
                                            if($row->user_id == 1){
                                                echo '<a>Admin</a>';
                                            }else{
                                                if($row->users_position_name != ''){
                                                    echo '<a>'.$row->users_position_name.'</a>';
                                                }
                                            }
                                        ?>  
                                    </td>
                                    <td>
                                        {!! $row->warehouse->name !!}
                                    </td>
                                    <td>{!! $row->created_at !!}</td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.return-product.details',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-hand-o-up "></i>
                                                Chi tiết
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
                                        'name' =>Request::input('name'),
                                        'code' =>Request::input('price'),
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
