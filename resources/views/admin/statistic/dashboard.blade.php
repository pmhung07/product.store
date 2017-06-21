@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-bar-chart-o"></i> Thống kê, báo cáo</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="tab-wrap">
            <span>Tổng quan</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="/system/statistic/synthetic">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bar-chart-o fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Tổng quan</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="tab-wrap">
            <span>Sản phẩm - theo ngày đặt hàng</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="/system/statistic/product">
                                    <div class="col-xs-4">
                                        <i class="fa fa-tag fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Tên sản phẩm</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/statistic/product-group">
                                    <div class="col-xs-4">
                                        <i class="fa fa-tags fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Nhóm sản phẩm</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="tab-wrap">
            <span>Đơn hàng - theo ngày đặt hàng</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/statistic/channel">
                                    <div class="col-xs-4">
                                        <i class="fa fa-rss fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Kênh bán hàng</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/statistic/staff">
                                    <div class="col-xs-4">
                                        <i class="fa fa-user fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Theo nhân viên</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/statistic/regions">
                                    <div class="col-xs-4">
                                        <i class="fa fa-area-chart fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Doanh số </span>
                                        <h5 class="font-bold"> Theo tỉnh thành</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> 

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

@stop
