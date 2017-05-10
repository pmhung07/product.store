@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-bar-chart-o"></i> Affiliate Management</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="tab-wrap">
            <span>Quản lý và thống kê sản phẩm</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="/system/affiliate/manager/product">
                                    <div class="col-xs-4">
                                        <i class="fa fa-tag fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Quản lý </span>
                                        <h5 class="font-bold"> Sản phẩm</h5>
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
            <span>Quản lý và thống kê nhóm cộng tác viên</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/affiliate/manager/collaborators-group">
                                    <div class="col-xs-4">
                                        <i class="fa fa-users fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Quản lý </span>
                                        <h5 class="font-bold"> Nhóm CTV</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/affiliate/manager/users">
                                    <div class="col-xs-4">
                                        <i class="fa fa-user fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Quản lý </span>
                                        <h5 class="font-bold"> Cộng tác viên</h5>
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
            <span>Quản lý dành cho Cộng tác viên</span>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-content" style="background:#fbfbfb;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/affiliate/collaborators/product-listing">
                                    <div class="col-xs-4">
                                        <i class="fa fa-list fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Danh sách </span>
                                        <h5 class="font-bold"> Sản phẩm Affliate</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/affiliate/collaborators/product-manage">
                                    <div class="col-xs-4">
                                        <i class="fa fa-hand-o-right fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Danh sách </span>
                                        <h5 class="font-bold">Sản phẩm chọn</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 lb-sm-refresh">
                            <div class="row">
                                <a style="color:#6d889c;" href="system/affiliate/collaborators/product-manage">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bar-chart-o fa-4x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span> Quản lý </span>
                                        <h5 class="font-bold"> Thống kê, báo cáo</h5>
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
