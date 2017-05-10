@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Chi tiết nhóm cộng tác viên: </h2>
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
                        <span>Thêm thành viên vào nhóm Affiliate: {{ $affiliate_group[0]['name'] }}</span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="table-responsive bg-block table-bordered" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="POST" accept-charset="UTF-8" action="">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                            <tr>
                                                <td style="width:50%;">
                                                    <div class="input-group date" style="width:100%;">
                                                        <input type="text" name="search-input-user" class="form-control search-input-user"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm nhân viên theo tên, email, số điện thoại..">
                                                    </div>
                                                </td>
                                                <input class="user_id" type="hidden" name="user_id" value="">
                                                <td style="width:30%;">
                                                    <div class="input-group date" style="width:100%;">
                                                        <select class="form-control" name="user_leader">
                                                            <option selected value="0">Thành viên trong nhóm</option>
                                                            <option value="1">Trưởng nhóm</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="width:20%;">
                                                    <input class="btn btn-sm btn-primary" type="submit" value="Thêm thành viên vào nhóm Affliate">
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

            <div class="col-md-12">
                <div class="block-content">
                    <div class="tab-wrap">
                        <span>Danh sách thành viên trong nhóm</span>
                    </div>
                    <div class="ibox" style="margin-bottom:0px;">
                        <div class="ibox-content" style="border-radius:0px;">
                            <div class="table-responsive bg-block table-bordered" style="overflow-x: inherit;">
                                <table class="table shoping-cart-table">
                                    <tbody>
                                        <form method="GET" action="{!! route('admin.affiliate.collaborators-group') !!}" accept-charset="UTF-8">
                                            <tr>
                                                <td>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input value="{!! Request::input('user-name') !!}" name="group-name" class="form-control filter-product-name" style="width:100%;" type="text" placeholder="Tên thành viên..">
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
                </div>
                <div class="ibox">

                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" style="font-size:11px;">
                                <thead>
                                <tr>
                                    <th width="10">#</th>
                                    <th width="120">Tên thành viên</th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="250">Số sản phẩm bán được - <sup>Sản phẩm</sup></th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="170">Số tiền bán được - <sup>vnđ</sup></th>
                                    <th style="color: #484848;border-color: #7bbf20;" width="80">Hoa hồng - <sup>vnđ</sup></th>
                                    <th width="120">Chức vụ nhóm</th>
                                    <th width="150">Người tạo</th>
                                    <th width="100">Ngày tạo</th>
                                    <th class="text-right" width="80">Hoạt động</th>
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
                                        <td><a href="system/affiliate/manager/users-product/{{$row->user_id}}">{{$row->user_name}}</a></td>
                                        <th style="color: #484848;border-color: #7bbf20;">{{$row->total_quantity}}</th>
                                        <th style="color: #484848;border-color: #7bbf20;">{{$row->total_price}}</th>
                                        <th style="color: #484848;border-color: #7bbf20;" width="150"></th>
                                        <th class="text-center"><?=($row->leader == 1)?'<small class="label lb-sm-success">Trưởng nhóm</small>':'Thành viên';?></th>
                                        <td>{!! get_user_name_position($row->admin_id) !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                            <td class="text-center">
                                                <?=($row->active == 1)?'<small class="label lb-sm-success">On</small>':'<small class="label lb-sm-cancel">Off</small>';?>
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
                                        <div class="sp-14-400"><a href="system/statistic/product"><i class="fa fa-bar-chart-o"></i> Thống kê nhóm cộng tác viên</a></div>
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
