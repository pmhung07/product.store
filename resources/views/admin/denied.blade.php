@extends('layout.admin.index')

@section('breadcrumbs')

@stop            

@section('content')
<?php
//var_dump(expression);
?>
<div class="wrapper wrapper-content">
    <div class="middle-box text-center animated fadeInRightBig">
        <h3 class="font-bold">Không có quyền truy cập</h3>
        <div class="error-desc">
            Bạn không có quyền truy cập vào nội dung này!
            <br/><a class="btn btn-primary m-t"><i class="fa fa-unlock-alt "></i> Nội dung bị khoá</a>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">


<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>


<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- ChartJS-->
<script src="js/plugins/chartJs/Chart.min.js"></script>

@stop
