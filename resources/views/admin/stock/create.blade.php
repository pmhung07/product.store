@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-database"></i> Tạo mới kho hàng</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop

@section('content')

<div class="row">

    <div class="col-lg-12">

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

                    <form action="" class="form-horizontal" method="POST">

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Tên kho hàng</label>
                            <div class="col-sm-9"><input name="name" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mã kho hàng</label>
                            <div class="col-sm-9"><input name="code" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tỉnh/Thành phố</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="province_id" name="province_id">
                                    <option value="">Tỉnh/Thành phố</option>
                                    @foreach($provinces as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('province_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Huyện</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="district" name="district_id">
                                    <option value="">Huyện</option>
                                    @foreach($districts as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == old('district_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Địa chỉ kho hàng</label>
                            <div class="col-sm-9"><input name="address" type="text" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
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

    $('#province_id').ajaxLoadDistrict({
        observers: '#district'
    });
});
</script>
@stop
