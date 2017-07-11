@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Danh sách sản phẩm trong hệ thống Affiliate</h2>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="col-lg-12">

        @if (count($errors) > 0)
        <div class="ibox-content">
            <div class="alert alert-danger" style="margin-bottom:0px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        @if (Session::has('flash_message'))
            <div class="ibox-content">
                <div class="alert alert-success"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_message') !!}
                </div>
            </div>
        @endif

        <div class="row">
            <?php if(Auth::user()->id == 1){ ?>
            <div class="col-md-12">
                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Thêm sản phẩm vào hệ thống Affiliate</span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="table-responsive bg-block table-bordered" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="POST" accept-charset="UTF-8" action="{!! route('admin.affiliate.manager-product-add') !!}">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <tr>
                                                <td style="width:50%;">
                                                    <div class="input-group date" style="width:100%;">
                                                        <input type="text" name="search-input-product" class="form-control search-input-product"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm sản phẩm theo tên, mã sản phẩm, barcode..">
                                                    </div>
                                                </td>
                                                <input class="product_id" type="hidden" name="product_id" value="">
                                                <td>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-hand-o-right"></i>
                                                        </span>
                                                        <input name="profit" type="text" class="form-control"  style="width:100%;" placeholder="Lợi nhuận (%)">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="btn btn-sm btn-primary" type="submit" value="Thêm sản phẩm vào hệ thống Affliate">
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Danh sách sản phẩm hệ thống Affiliate</span>
                    </div>
                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content" style="border-radius:0px;">
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
                </div>
                <div class="ibox">

                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" style="font-size:11px;">
                                <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th width="120">Mã Sản phẩm</th>
                                    <th width="50">Ảnh</th>
                                    <th width="200">Tên Sản phẩm</th>
                                    <th width="120">Nhóm sản phẩm</th>
                                    <!--<th width="130">Link share sản phẩm</th>-->
                                    <th width="90">Giá bán <sup> - vnđ </sup></th>
                                    <th width="90">Hoa hồng <sup> - % </sup></th>
                                    <th width="100">Lợi nhuận <sup> - vnđ </sup></th>
                                    <th class="text-left" width="130">Chọn sản phẩm</th>
                                    <th class="text-right" width="80">Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    $total_quantity_inventory = 0;
                                ?>
                                @foreach($rows as $row)

                                    <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                        <td>{{$i}}</td>
                                        <td><a>{{$row->product_sku}}</a></td>
                                        <td>
                                            <img src="{{ parse_image_url('sm_'.$row->product_image) }}" height="35">
                                        </td>
                                        <td><a>{{$row->product_name}}</a><br>
                                        <span style="font-size:10px;">SKU:</span> 
                                        <span class="font-stl-ort">{!! $row->product_sku !!}</span></td>
                                        <td>{{$row->product_group_name}}</td>
                                        <!--<td><input style="width:100%;" type="text" value=""></td>-->
                                        <td>{{number_format($row->product_price)}}</td>
                                        <td>
                                            <?php if(Auth::user()->id == 1){ ?>
                                                <input class="product_profit_{{$row->product_id}}" style="width:50%;" type="text" value="{{$row->profit}}" />
                                                <small onclick="update_profit({{$row->product_id}})" class="label lb-sm-success" style="border:none!important;cursor:pointer;"><i class="fa fa-repeat"></i></small>
                                            <?php }else{ ?>
                                                {{$row->profit}}
                                            <?php } ?>
                                        </td>
                                        <td class="text-danger">{{number_format($row->product_price/100*$row->profit)}}</td>
                                        <td class="text-left footable-visible footable-last-column">
                                            <div class="btn-group">
                                                <?php if(Auth::user()->id != 1){?>
                                                <a  onclick="update_affiliate_user_product({{$row->id}})" class="btn-white btn btn-xs">
                                                    <i class="fa fa-hand-o-up "></i> Chọn sản phẩm
                                                </a>
                                                <?php }else{ ?>
                                                    <span class="font-stl-ort">Dành cho cộng tác viên</span>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.affiliate.manager-product-delete',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-trash "></i> Xoá
                                            </a>
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
                Bạn có muốn xoá sản phẩm này khỏi hệ thống Affiliate không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                <a class="btn btn-danger btn-ok">Xoá dữ liệu</a>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<!-- Page-Level Scripts -->
<script>

function update_profit(product_id){
    token = $('meta[name="csrf-token"]').attr('content');
    var profit = $('.product_profit_'+product_id).val();

    var conf = confirm("Bạn có muốn cập nhật hoa hồng sản phẩm này không?");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-profit',
            data:{
                _token: token,
                product_id: product_id,
                profit: profit
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
}

function update_affiliate_user_product(product_id){
    token = $('meta[name="csrf-token"]').attr('content');

    var conf = confirm("Bạn có muốn chọn sản phẩm này không?");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-affiliate-user-product',
            data:{
                _token: token,
                product_id: product_id,
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
}

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

    // Search Product
    var engineProduct = new Bloodhound({
        remote: {
            url: '/get-product-auto-complete?search-input-product=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-product'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engineProduct.initialize();

    $(".search-input-product").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engineProduct.ttAdapter(),
        name: 'productList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+' <br>  Sku: '+ data.sku +'</div>'
            }
        },
        engineProduct: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $(".product_id").val(selection.id);    
    });

});
</script>
@stop
