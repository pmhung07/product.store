@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-indent"></i> Danh sách phiếu nhập kho</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/stock-receipt/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Tạo phiếu nhập kho</a>
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
                                    <form method="GET" action="{!! route('admin.stock-receipt.index') !!}" accept-charset="UTF-8">
                                        <tr>
                                            <td style="width:30%;">
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input class="form-control" name="wareph_code" type="text" placeholder="Mã phiếu nhập kho">
                                                </div>
                                            </td>
                                            <td style="width:30%;">
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input class="form-control" name="wareph_name" type="text" placeholder="Tên phiếu nhập kho">
                                                </div>
                                            </td>
                                            <td style="width:40%;">
                                                <select name="warehouse_name" class="form-control warehouse_name" style="width:100%;">
                                                    <option value="-1" selected="">-- Chọn kho --</option>   
                                                    <?php foreach($warehouse as $row){ ?>
                                                        <option <?=(Request::has('warehouse_name') && Request::input('warehouse_name') == ($row->id))?'selected':'';?> value="{!! $row->id !!}">-- {!! $row->name !!} --</option>   
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <!--<td>
                                                <input class="btn btn-sm btn-primary" type="submit" value="Tìm kiếm">
                                            </td>-->
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
                        <table class="table table-striped table-bordered table-hover " id="editable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="150">Mã phiếu</th>
                                <th width="150">Tên phiếu</th>
                                <th>Người nhập</th>
                                <th>Chức vụ</th>
                                <th>Kho hàng</th>
                                <th width="100">Ngày tạo</th>
                                <th width="100" class="text-right">Chức năng</th>
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
                                        <a>{!! $row->name !!}</a>
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
                                        @if($row->status == 1)
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.stock-receipt.details',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-hand-o-up "></i>
                                                Chi tiết
                                            </a>
                                        </div>
                                        @else
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.stock-receipt.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-hand-o-up "></i>
                                                Nhập kho
                                            </a>
                                        </div>
                                        @endif
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
