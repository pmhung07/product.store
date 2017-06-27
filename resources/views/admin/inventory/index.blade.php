@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-cubes"></i> Danh sách hàng tồn kho</h2>
    </div>
    <div class="col-lg-2">

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

                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content border-radius-no">
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="GET" action="{!! route('admin.inventory.index') !!}" accept-charset="UTF-8">
                                            <tr>
                                                <td style="width:45%;">
                                                    <select name="product-group" class="form-control product-group" style="width:100%;">
                                                        <option value="-1" selected>-- Nhóm sản phẩm --</option>
                                                        <? cat_parent($product_group);?>    
                                                    </select>
                                                </td>
                                                <td style="width:45%;">
                                                    <input class="form-control" name="product" type="text" placeholder="Tìm kiếm theo tên sản phẩm">
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
                                <th width="10">#</th>
                                <th width="350">Tên Sản phẩm</th>
                                <th width="80">Đơn vị</th>
                                <th width="50">Số lượng</th>
                                <th width="100">Giá trị tồn kho <sup class="text-danger"> - vnđ</sup></th>
                                <th width="50" class="text-right"><i class="fa fa-wrench"></i> Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>
                                        {!! $i !!}
                                    </td>
                                    <td>
                                        {!! $row->product->name !!}<br>
                                        <span style="font-size:10px;">SKU:</span> 
                                        <span class="font-stl-ort">{!! $row->product->sku !!}</span>
                                    </td>
                                    <?php
                                    $quantity = DB::table('warehouse_inventory')->where('product_id','=',$row->product_id)->sum('quantity'); 
                                    $warehouse_in = DB::table('warehouse_inventory')->where('product_id','=',$row->product->id)->get();

                                    $pricestock_in = 0;
                                    foreach($warehouse_in as $key => $warehouse_val){ 
                                        $pricestock_in = $pricestock_in + (($warehouse_val->quantity) * ($warehouse_val->price));
                                    }

                                    ?>
                                    <td>
                                        {!! $row->product->units->name !!}
                                    </td>
                                    <td class="text-danger">
                                        {!! $quantity !!}
                                    </td>
                                    <td class="text-danger">
                                        {!! number_format($pricestock_in) !!} 
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                        <a onclick="(show_details({!! $row->product->id !!}))" class="btn-white btn btn-xs">
                                        <i class="fa fa-sitemap"></i> Chi tiết
                                        </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
               
                                <?php
                                    // Lấy danh sách kho 
                                    $warehouse = DB::table('warehouse')->select('id','name')->get();
                                    $w = 1;

                                    foreach($warehouse as $key => $valuewarehouse){ ?>
                                        <tr class="details_inven details_inven_{!! $row->product->id !!}">
                                            <td>
                                                <span class="label label-info"><i class="fa fa-cubes"></i> 
                                                    Chi tiết kho {!! $w !!}
                                                </span>
                                            </td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! $valuewarehouse->name !!}"> 
                                            </td>
                                            <?php
                                                // Lấy danh sách phiếu thuộc kho này
                                                $arr = array();
                                                $arrwarehouse = DB::table('warehouse_ph')->select('id')
                                                                    ->where('warehouse_id','=',$valuewarehouse->id)
                                                                    ->get();
                                                foreach($arrwarehouse as $key => $valuearr){ 
                                                    array_push($arr, $valuearr->id);
                                                }
                                            
                                                // Kiểm tra xem sản phẩm này có thuộc phiếu trên không
                                                $quantity_stock = DB::table('warehouse_inventory')->where('product_id','=',$row->product->id)->where('warehouse_id', $valuewarehouse->id)->sum('quantity');
                                                $arrpricestock  = DB::table('warehouse_inventory')->select('price','quantity')
                                                                    ->where('product_id','=',$row->product->id)
                                                                    ->where('warehouse_id', $valuewarehouse->id)
                                                                    ->get();

                                                $pricestock = 0;
                                                foreach($arrpricestock as $key => $valuestock){ 
                                                    $pricestock = $pricestock + (($valuestock->price) * ($valuestock->quantity));
                                                }
                                            ?>
                                            <td></td>
                                            <td>
                                                {!! $quantity_stock !!}
                                            </td>
                                            <td colspan="2">
                                                <span class="text-danger">{!! number_format($pricestock) !!}</span>
                                            </td>
                                        </tr>
                                    <?php $w++; ?>
                                <?php } ?>

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
                                                    Tổng số loại sản phẩm: <span class="text-danger">{!! count($rows) !!}</span> Sản phẩm
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td>
                                                    Tổng số sản phẩm tồn kho: <span class="text-danger">{!! number_format($sum_total_price['total_quantity']) !!}</span> Sản phẩm
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

    $('#confirm-details').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});

function show_details(id){
    $(".details_inven").hide();
    $(".details_inven_"+id).fadeIn(500);
}

</script>

<style>
.details_inven{display:none;background:#f3f3f4;}
.label-success{cursor:pointer;}
</style>
@stop
