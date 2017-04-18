@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-sitemap"></i> Sửa thông tin nhân viên</h2>
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

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Họ và tên</label>
                            <div class="col-sm-9"><input value="{!! $userdata['name'] !!}" name="name" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9"><input value="{!! $userdata['email'] !!}" name="email" type="email" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mật khẩu</label>
                            <div class="col-sm-9"><input name="password" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Số CMND</label>
                            <div class="col-sm-9"><input value="{!! $userdata['identity_card_number'] !!}" name="identity_card_number" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Số điện thoại</label>
                            <div class="col-sm-9"><input value="{!! $userdata['phone'] !!}" name="phone" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Địa chỉ</label>
                            <div class="col-sm-9"><input value="{!! $userdata['address'] !!}" name="address" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Chức vụ</label>
                            <div class="col-sm-9">
                                <select class="form-control m-b" name="user_position_id">
                                    <option value="">-- Chọn chức vụ  --</option>
                                    @foreach($users_position as $item)
                                        <option <?=($item['id'] == $userdata['user_position_id'])?'selected':'';?> value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                    @endforeach          
                                </select>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
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

<!-- Input Mask -->
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>
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
