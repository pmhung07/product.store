@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-sitemap"></i> Phân quyền theo chức vụ: {!! $user_position->name; !!}</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">
    @include('layout.admin.sidebar-settings')
    <div class="col-lg-9">
        <div class="ibox-content" style="font-size:11px;">

            <?php if($user_position->fixed == 1){ ?>
                <div class="alert alert-info fade in alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <strong>*</strong> <b>{!! $user_position->name !!}</b> là chức vụ mặc định phân quyền của hệ thống, bạn không có quyền chỉnh sửa!
                </div>
            <?php } ?>

            <form method="POST" action="" class="form-horizontal">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <?php
                $user_checked = json_decode($user_position->permissions);
                //var_dump($user_checked);
                ?>
                {!! list_permissions_checkbox($data,0,'',$user_checked) !!}
                <?php if($user_position->fixed != 1){ ?>
                <div style="margin:20px 0px;" class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-1 col-sm-offset-0">
                        <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                    </div>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/iCheck/custom.css" rel="stylesheet">
<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">



<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- iCheck -->
<script src="js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>

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
