@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Danh sách cộng tác viên </h2>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="col-lg-12">

        @if (Session::has('error_message'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('error_message') !!}
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

            <div class="col-md-12">
                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Danh sách cộng tác viên</span>
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
                                                        <input value="{!! Request::input('user-name') !!}" name="group-name" class="form-control filter-product-name" style="width:100%;" type="text" placeholder="Tên thành viên..">
                                                    </div>
                                                </td>
                                                <td style="width:25%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input value="{!! Request::input('filter-date-start') !!}" name="filter-date-start" class="form-control filter-date-start" style="width:100%;" type="text" placeholder="Từ ngày..">
                                                    </div>
                                                </td>
                                                <td style="width:25%;">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input value="{!! Request::input('filter-date-end') !!}" name="filter-date-end" class="form-control filter-date-end" style="width:100%;" type="text" placeholder="Đến ngày..">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="btn btn-sm btn-primary" type="submit" value="Thống kê">
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
                                    <th width="120">Cộng tác viên</th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="130">Số lượng bán được</sup></th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="150">Số tiền bán được</sup></th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="130">Lợi nhuận <sup> - vnđ </sup></th>
                                    <th width="100" class="text-center">Chức vụ nhóm</th>
                                    <th width="120">Người tạo</th>
                                    <th width="80">Ngày tạo</th>
                                    <th class="text-right" width="90">Chức năng</th>
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
                                        <td><a href="system/affiliate/manager/users-product/{{$row->id}}">{{$row->name}}</a></td>
                                        <td>{{number_format($row->total_quantity)}}</td>
                                        <td>{{number_format($row->total_price)}}</td>
                                        <td>{{number_format($row->total_profit)}}</td>
                                        <td class="text-center"><?=($row->leader == 1)?'<small class="label lb-sm-success">Trưởng nhóm</small>':'Thành viên';?></td>
                                        <td>{!! get_user_name_position(1) !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                        <td class="text-right">
                                            <a href="system/affiliate/manager/users-product/{{$row->id}}" class="btn-white btn btn-xs">
                                                <i class="fa fa-hand-o-right"></i> Chi tiết
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
                                        <div class="sp-14-400"><a href="system/statistic/product"><i class="fa fa-bar-chart-o"></i> Thống kê cộng tác viên</a></div>
                                        <table class="table table-stripped m-t-md">
                                            <tbody>
                                            <tr>
                                                <td class="" width="10">
                                                    <i class="fa fa-circle text-success"></i>
                                                </td>
                                                <td class="">
                                                    Tổng số thành viên: <span class="text-danger">{!! number_format($total_row) !!}</span> thành viên
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

<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

    $('.footable').footable();

    $('.filter-date-start').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('.filter-date-end').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    // Search Product
    var engineProduct = new Bloodhound({
        remote: {
            url: '/get-user-auto-complete?search-input-user=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-user'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engineProduct.initialize();

    $(".search-input-user").typeahead({
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
                return '<div class="user-search-result">'+data.name+' <br>  Phone: '+ data.phone +'</div>'+' <br>  Email: '+ data.email +'</div>'
            }
        },
        engineProduct: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $(".user_id").val(selection.id);    
    });


});
</script>
@stop
