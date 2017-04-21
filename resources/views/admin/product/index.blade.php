@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Danh sách sản phẩm</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/product/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Thêm sản phẩm</a>
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
                        <div class="table-responsive bg-block table-bordered" style="overflow-x: inherit;">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <form method="GET" action="{!! route('admin.product.index') !!}" accept-charset="UTF-8">
                                        <tr>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input value="{!! Request::input('filter-product-sku') !!}" name="filter-product-sku" class="form-control filter-product-sku" style="width:100%;" type="text" placeholder="Mã sản phẩm">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-search"></i>
                                                    </span>
                                                    <input value="{!! Request::input('filter-product-name') !!}" name="filter-product-name" class="form-control filter-product-name" style="width:100%;" type="text" placeholder="Tên sản phẩm">
                                                </div>
                                            </td>
                                            <td>
                                                <select name="filter-product-groupt-id" class="form-control filter-product-groupt-id" style="width:100%;">
                                                    <option value="-1" selected>-- Nhóm sản phẩm --</option>
                                                    <? cat_parent($product_group,0,'--',Request::input('filter-product-groupt-id'));?>
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
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã Sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Tên Sản phẩm</th>
                                    <th>Nhóm sản phẩm</th>
                                    <th width="100">Giá bán <sup> - vnđ </sup></th>
                                    <th width="70">Tồn kho</th>
                                    <th class="text-right" width="120">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    $total_quantity_inventory = 0;
                                ?>
                                @foreach($rows as $row)

                                    <?php
                                    $quantity = DB::table('warehouse_inventory')->where('product_id','=',$row->id)->sum('quantity');
                                    ?>

                                    <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                        <td>{{$i}}</td>
                                        <td>{{$row->sku}}</td>
                                        <td>
                                            <img src="{{ parse_image_url('sm_'.$row['image']) }}" height="35">
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->product_group_name}}</td>
                                        <td>{{number_format($row->price)}}</td>
                                        <td class="<?=($row->quantity_inventory <= $row->warning_out_of_stock)?'text-danger':'';?>">
                                            {!! number_format($row->quantity_inventory) !!}
                                        </td>
                                        <td class="text-right footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <a href="{!! URL::route('admin.product.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                    <i class="fa fa-edit "></i> Sửa
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.product.getDelete',$row->id) !!}"  class="btn-white btn btn-xs">
                                                    <i class="fa fa-trash "></i> Xoá
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++;$total_quantity_inventory = $total_quantity_inventory + $row->quantity_inventory; ?>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content bg-block">
                                        <div class="sp-14-400"><a href="system/statistic/product"><i class="fa fa-bar-chart-o"></i> Thống kê sản phẩm</a></div>
                                        <table class="table table-stripped m-t-md">
                                            <tbody>
                                            <tr>
                                                <td class="" width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td class="">
                                                    Tổng số lượng sản phẩm: <span class="text-danger">{!! number_format($total_row) !!}</span> sản phẩm
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td>
                                                    Tổng số lượng sản phẩm  tồn kho: <span class="text-danger">{!! number_format($total_quantity_inventory) !!}</span> sản phẩm
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
