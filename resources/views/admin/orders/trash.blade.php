@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-th-list "></i> Danh sách đơn hàng ảo</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeInRight">    
        <div class="row">
            <div class="col-lg-12">
                <div class="block-content">
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
                            <div class="table-responsive" style="overflow-x: inherit;">
                                <table class="table table-striped table-bordered table-hover" id="editable" style="font-size:11px;">
                                    <thead>
                                    <tr>
                                        <th width="5">#</th>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Mã vận đơn</th>
                                        <th>Tổng tiền</th>
                                        <th width="130">Trạng thái đơn</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($rows as $row)
                                        <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                            <td>{!! $i !!}</td>
                                            <td>
                                                <?php if($row->order_status != 2 || $row->lading_status == 3){ ?>
                                                    <a style="text-decoration: line-through;" href="{!! URL::route('admin.orders.details',$row->id) !!}">
                                                        <i class="fa fa-hand-o-up "></i> {!! $row->code !!}
                                                    </a>
                                                <?php }else{ ?>
                                                    <a style="text-decoration: line-through;" href="{!! URL::route('admin.orders.delivery',$row->id) !!}">
                                                        <i class="fa fa-hand-o-up "></i> {!! $row->code !!}
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td >
                                                <span style="text-decoration: line-through;">{!! $row->customers->name !!}</span>
                                            </td>
                                            <td>
                                                <?php if($row->lading_code != ""){ ?>
                                               <a href="{!! URL::route('admin.orders.delivery',$row->id) !!}">
                                                    <i class="fa fa-external-link"></i> {!! $row->lading_code !!}
                                                </a>
                                                <?php } else{?>
                                                    _____
                                                <?php } ?>
                                            </td>
                                            <td class="hasinput">
                                                {!! number_format($row->total_price) !!}
                                            </td>
                                            <td class="hasinput">
                                               {!! getUrlOrderDetails($row->id, $row->status, $row->order_status, $row->lading_status, $row->call_status); !!}
                                            </td>
                                            <td>
                                                {!! $row->created_at !!}
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <div class="dataTables_paginate paging_bootstrap_full">
                                        {!! $rows->appends($_GET)->links() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-primary">Tổng số đơn hàng: <span class="badge">{!! $order_total !!}</span> đơn</button>
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
                Xoá dữ liệu Kho hàng
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
});
</script>
@stop
