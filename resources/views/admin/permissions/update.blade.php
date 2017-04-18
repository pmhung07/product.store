@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-unlock-alt"></i> Cập nhật danh mục quản lý</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')
<div class="row">
    @include('layout.admin.sidebar-settings')
    <div class="col-lg-9 animated fadeInRight">
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
                

                <div class="ibox-content">
                    <form action="" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Danh mục quản lý</label>
                            <div class="col-sm-9">
                            	<input required name="name" type="text" class="form-control" value="{!! old('name',isset($data) ? $data['name'] : '') !!}">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Chọn danh mục cha</label>
                            <div class="col-sm-9">
        	                    <select class="form-control m-b" name="slc_name">
        	                    	<option value="0" selected="">-- Chọn danh mục --</option>	   
                                    <?php cat_parent($parent,0,"--",$data['parent_id']); ?>
                                        
        	                    </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mô tả</label>
                            <div class="col-sm-9">
        	                    <textarea name="description" class="form-control noresize" id="encCss" rows="3">{!! old('description',isset($data) ? $data['description'] : '') !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Alias</label>
                            <div class="col-sm-9">
                                <input required name="slug" type="text" class="form-control" value="{!! old('slug',isset($data) ? $data['slug'] : '') !!}">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Thứ tự</label>
                            <div class="col-sm-9">
                                <input required name="order" type="text" class="form-control" value="{!! old('order',isset($data) ? $data['order'] : '') !!}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">Cập nhật thông tin</button>
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
