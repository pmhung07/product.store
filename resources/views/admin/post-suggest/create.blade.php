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
    <div class="col-lg-12 animated">

        @include('includes/flash-message')

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
            	<div class="col-lg-12">

                    <form action="{!! route('admin.post-suggest.getCreate') !!}" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Ảnh minh họa</label>
                            <div class="col-sm-9"><input name="image" type="file" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Tiêu đề</label>
                            <div class="col-sm-9"><input name="title" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Teaser</label>
                            <div class="col-sm-9">
                                <textarea name="teaser" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nội dung</label>
                            <div class="col-sm-9">
                                <textarea name="content" class="form-control tiny-editor"></textarea>
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

                        <div class="form-group"><label class="col-sm-3 control-label">Tags</label>
                            <div class="col-sm-9">
                                <input name="tags" type="text" class="form-control tags">
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


<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

    $('.tags').tagsInput({
        height:'140px',
        width: '100%',
        defaultText: 'Thêm tag'
    });

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
