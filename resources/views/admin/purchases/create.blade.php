@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Tạo phiếu thu mua</h2>
        <ol class="breadcrumb">
            <li>
                <a>Quản lý nhập hàng </a>
            </li>
            <li class="active">
                <strong>Tạo phiếu thu mua</strong>
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
        <div class="row">
        	<div class="col-lg-12">
        		<div class="ibox-title">
                    <h5>Tạo phiếu thu mua <small> Nhập đầy đủ thông tin</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="get" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Tên phiếu</label>
                            <div class="col-sm-10"><input type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Mã tham chiếu</label>
                            <div class="col-sm-10"><input type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Chọn nhà cung cấp</label>
                            <div class="col-sm-10">
        	                    <select class="form-control m-b" name="account">
        	                    	<option value="-1" selected="">-- Chọn nhà cung cấp --</option>
        	                        <option>Công Ty Trần Anh</option>
        	                        <option>Công Ty FPT Shop</option>
        	                        <option>Công Ty Tiến Cường Mobile</option>
        	                    </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Chọn kho thu mua</label>
                            <div class="col-sm-10">
        	                    <select class="form-control m-b" name="account">
        	                    	<option value="-1" selected="">-- Chọn phiếu thu mua --</option>
        	                        <option>Kho 35A Nguyễn Tuân - Hà Nội</option>
        	                        <option>Kho 22 Triệu Việt Vương</option>
        	                        <option>Kho 221C Khâm Thiên</option>
        	                    </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Huỷ Phiếu</button>
                                <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                            </div>
                        </div>
                    </form>
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
