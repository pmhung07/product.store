@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> Tạo bài viết mới</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">
    @include('layout.admin.sidebar-shop')
    <div class="col-lg-9 animated">

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

                    <form action="{!! route('admin.post.getCreate') !!}" class="form-horizontal" method="POST">

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9"><input name="title" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Teaser</label>
                            <div class="col-sm-9"><input name="teaser" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nội dung</label>
                            <div class="col-sm-9">
                                <textarea name="content" class="form-control summernote"></textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nhóm sản phẩm</label>
                            <div class="col-sm-9">
        	                    <select class="form-control m-b" name="category_id">
        	                    	<option value="" selected="">-- Chọn nhóm tin --</option>	               
                                    <? cat_parent($post_categories);?>    
        	                    </select>
                            </div>
                        </div>
        	            <div class="form-group"><label class="col-sm-3 control-label">Meta Title</label>
                            <div class="col-sm-9"><input name="meta_title" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Meta Keyword</label>
                            <div class="col-sm-9"><input name="meta_keyword" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Meta Description</label>
                            <div class="col-sm-9"><input name="meta_description" type="text" class="form-control"></div>
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

<link href="css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">


<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- SUMMERNOTE -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/summernote/summernote.min.js"></script>

<script>
    $(document).ready(function(){

        $('.summernote').summernote();

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
