@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Danh sách phiếu thu mua hàng</h2>
        <ol class="breadcrumb">
            <li>
                <a>Quản lý nhập hàng </a>
            </li>
            <li class="active">
                <strong>Danh sách phiếu thu mua hàng</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    @include('layout.admin.sidebar-stock')

    <div class="col-lg-9 animated fadeInRight">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="order_id">Mã phiếu thu hàng / Tên phiếu</label>
                        <input type="text" id="order_id" name="order_id" value="" placeholder="Mã phiếu / Tên Phiếu" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="status">Nhà cung cấp</label>
                        <select name="status" id="status" class="form-control">
                            <option value="-1" selected="">-- Chọn nhà cung cấp --</option>
                            <option value="1">Công Ty Trần Anh</option>
                            <option value="2">Công ty FPT Shop</option>
                            <option value="3">Công Ty Tiến Cường Mobile</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                	<div class="form-group">
                        <label class="control-label" for="status"> Tạo phiếu thu mua</label>
                       	<a href="system/purchases/create" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Tạo phiếu mua hàng</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>
                                <th class="footable-visible footable-first-column footable-sortable">Mã phiếu<span class="footable-sort-indicator"></span></th>
                                <th>Kho nhận</th>
                                <th>Tổng giá trị</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                                <th class="text-right">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">


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
});
</script>
@stop
