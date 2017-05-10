@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-indent"></i> Xử lý phiếu nhập kho</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">

    <div class="col-lg-12 animated fadeInRight">

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

        @if (Session::has('flash_error'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_error') !!}
                </div>
            </div>
        @endif

        <div class="order-detail">
            <div class="btn-flat panel panel-default">
                <div class="panel-heading">
                    <div class="progress-wrap">
                        <strong>Thông tin sản phẩm</strong>
                    </div>
                </div>
                <form action="{!! route('admin.stock-receipt.getEdit',$data['id']) !!}" class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="panel-body pd-0">
                    <div class="order-detail">
                        <table cellspacing="0" class="table order-totals-summary">
                            <thead>
                                <tr><th width="300" class="text-left text-font-size">Mặt hàng</th>
                                <th width="100" class="text-left text-font-size">SL nhập kho</th>
                                <th width="120" class="text-left text-font-size">Giá nhập</th>
                                <!--<th width="40" class="text-center text-font-size">Xóa</th>-->
                            </tr></thead>
                            <tbody>
                            
                                <tr ng-repeat="product in products" class="ng-scope">
                                    <?php
                                    $rows_product = DB::table('product')->where('id','=',$data['product_id'])->get();
                                    ?>
                                    <td class="table-td-style" width="300">
                                        {!! $rows_product[0]->name; !!}
                                    </td>
                                    <td class="table-td-style">
                                        <input value="{!! $data['quantity'] !!}" name="warehouse_ph_details_quantity" type="number" min="0" class="form-control input-sm pd-0 text-center ng-pristine ng-untouched ng-valid ng-valid-min" tabindex="0" aria-invalid="false">
                                    </td>
                                    <td class="table-td-style">
                                        <input value="{!! $data['price'] !!}" name="warehouse_ph_details_price" type="text" class="form-control input-sm pd-0 text-center ng-pristine ng-untouched ng-valid" ng-model="product.pro_price_in" tabindex="0" aria-invalid="false">
                                    </td>
                                    <!--<td class="text-center table-td-style">
                                        <button class="btn btn-xs btn-danger" tabindex="0">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button  class="btn btn-xs btn-primary ng-scope" type="submit"><i class="fa fa-edit"></i> Sửa sản phẩm</button><!-- end ngIf: !fParams.supplierId -->
                                    </td>
                                    <td colspan="1" class="text-right">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
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
