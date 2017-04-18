@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Chi tiết xử lý đơn hàng</h2>
        <ol class="breadcrumb">
            <li>
                <a>Quản lý nhân viên</a>
            </li>
            <li class="active">
                <strong>Chi tiết xử lý đơn hàng</strong>
            </li>
        </ol>
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
                <div class="ibox">

                    @if (Session::has('flash_message'))
                    <div class="ibox-content">
                        <div class="alert alert-success"  style="margin-bottom:0px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('flash_message') !!}
                        </div>
                    </div>
                    @endif
                    <div class="ibox-content" style="background-color:#e9e9ea;">
                        <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                            <?php $i=1;?>
                                @foreach($rows as $row)

                                <div class="vertical-timeline-block">
                                    <?php 
                                    if($row->status == 1 && $row->order_status == 0){
                                        echo '<div class="vertical-timeline-icon" style="background-color: #2f4050;color: #ffffff;">
                                                <i class="fa fa-hand-o-up"></i>
                                            </div>';
                                    }
                                    if($row->status == 1 && $row->order_status == 1){
                                        echo '<div class="vertical-timeline-icon" style="background-color: #23c6c8;color: #ffffff;">
                                                <i class="fa fa-file-text-o"></i>
                                            </div>';
                                    }

                                    if($row->status == 1 && $row->order_status == 2){
                                        echo '<div class="vertical-timeline-icon" style="background-color: #1c84c6;color: #ffffff;">
                                                <i class="fa fa-truck"></i>
                                            </div>';
                                    }

                                    if($row->order_status == 3){
                                        echo '<div class="vertical-timeline-icon" style="background-color: #1ab394;color: #ffffff;">
                                                <i class="fa fa-check"></i>
                                            </div>';
                                    }

                                    if($row->order_status == 4){
                                        echo '<div class="vertical-timeline-icon" style="background-color: #ed5565;color: #ffffff;">
                                                <i class="fa fa-times"></i>
                                            </div>';
                                    }
                                    ?>
                                    

                                    <div class="vertical-timeline-content">
                                        <h2>{!! $row->username !!}</h2>
                                        <p>
                                            <?php 
                                            if($row->status == 1 && $row->order_status == 0){
                                                echo '<span style="background-color: #fff;color: #2f4050;"><i class="fa fa-hand-o-up "></i> Tạo đơn hàng.</span>';
                                            }
                                            if($row->status == 1 && $row->order_status == 1){
                                                echo '<span style="background-color: #fff;color: #23c6c8;"><i class="fa fa-file-text-o "></i> Duyệt đơn hàng</span>';
                                            }

                                            if($row->status == 1 && $row->order_status == 2){
                                                echo '<span style="background-color: #fff;color: #1c84c6;"><i class="fa fa-truck "></i> Chuyển đơn hàng sang hệ thống vận đơn</span>';
                                            }

                                            if($row->order_status == 3){
                                                echo '<span style="background-color: #fff;color: #1ab394;"><i class="fa fa-check "></i> Cập nhật đơn hàng thành công</span>';
                                            }

                                            if($row->order_status == 4){
                                                echo '<span style="background-color: #fff;color: #ed5565;"><i class="fa fa-times "></i> Cập nhật huỷ đơn hàng</span>';
                                            }
                                            ?>
                                        </p>
                                            <span class="vertical-date">
                                                <?php 
                                                if($row->status == 1 && $row->order_status == 0){
                                                    echo '<span style="background-color: #fff;color: #2f4050;font-size:13px;"><i class="fa fa-clock-o"></i> '.$row->processing_created_at.'</span>';
                                                }
                                                if($row->status == 1 && $row->order_status == 1){
                                                    echo '<span style="background-color: #fff;color: #2f4050;font-size:13px;"><i class="fa fa-clock-o"></i> '.$row->processing_created_at.'</span>';
                                                }

                                                if($row->status == 1 && $row->order_status == 2){
                                                    echo '<span style="background-color: #fff;color: #2f4050;font-size:13px;"><i class="fa fa-clock-o"></i> '.$row->processing_created_at.'</span>';
                                                }

                                                if($row->order_status == 3){
                                                    echo '<span style="background-color: #fff;color: #2f4050;font-size:13px;"><i class="fa fa-clock-o"></i> '.$row->processing_created_at.'</span>';
                                                }

                                                if($row->order_status == 4){
                                                    echo '<span style="background-color: #fff;color: #2f4050;font-size:13px;"><i class="fa ffa-clock-o"></i> '.$row->processing_created_at.'</span>';
                                                }
                                                ?>
                                            </span>
                                    </div>
                                </div>
                            <?php $i++; ?>
                            @endforeach
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
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

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

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});
</script>
@stop
