@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> Tạo trang tĩnh mới</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop

@section('content')

<div class="row">
    <div class="col-xs-12 animated">

        @include('includes/flash-message')

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
            	<div class="col-lg-12">

                    <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">

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

<script>
$(document).ready(function() {

    $('.footable').footable();

});
</script>
@stop
