@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-indent"></i> Chi tiết phiếu chuyển kho</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">
    <div class="col-lg-12">
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

                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>
                                <th class="footable-visible footable-first-column footable-sortable">Mã phiếu<span class="footable-sort-indicator"></span></th>
                                <th>Tên phiếu</th>
                                <th class="text-right">Ngày nhập kho</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="footable-even" style="display: table-row;">
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse_ph['code'] !!}">
                                    </td>
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse_ph['name'] !!}">
                                    </td>
                                    <td align="right">
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse_ph['created_at'] !!}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right"></span>
                        <h5>Sản phẩm trong phiếu nhập kho bao gồm: </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th width="220">Tên sản phẩm</th>
                                        <th width="90">Số lượng</th>
                                        <th width="120">Ngày nhập kho</th>
                                        <th width="120">Giá nhập</th>
                                        <th width="120">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;$total_price = 0; ?>
                                    @foreach($warehouse_ph_details as $row)
                                        <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                            <td>{!! $i !!}</td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! $row->product->name !!}">
                                            </td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! $row->quantity !!}">
                                            </td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! $row->created_at !!}">
                                            </td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! number_format($row->price) !!} đ">
                                            </td>
                                            <td>
                                                <input style="width:100%;" readonly type="text" value="{!! number_format(($row->quantity) * ($row->price)) !!} đ">         
                                            </td>
                                        </tr>
                                        <?php $i++;$total_price = $total_price + ($row->quantity) * ($row->price);?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <ul class="sortable-list connectList agile-list ui-sortable" id="todo">
                            <li class="danger-element" id="task4">
                                Tổng giá trị nhập kho : {!! number_format($total_price) !!} đ
                                <div class="agile-detail">
                                    <i class="fa fa-clock-o"></i> {!! $data_warehouse_ph['created_at'] !!}
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
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

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

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

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>

<style>
.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
@stop
