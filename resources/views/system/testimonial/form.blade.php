<form class="form form-horizontal" method="POST" enctype="multipart/form-data">
    @if($testimonial->avatar)
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <img src="{{ parse_image_url('md_'.$testimonial->avatar) }}" height="50">
        </div>
    </div>
    @endif
    <div class="form-group">
        <label class="control-label col-sm-3">Ảnh nhân vật</label>
        <div class="col-sm-6">
            <input type="file" name="avatar" class="form-control">
        </div>
    </div>
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label col-sm-3">Họ và tên</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="name" value="{{ old('name', $testimonial->getName()) }}">
            {!! alertError('name') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('profession') }}">
        <label class="control-label col-sm-3">Nghề nghiệp</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" name="profession" value="{{ old('profession', $testimonial->getProfession()) }}">
            {!! alertError('profession') !!}
        </div>
    </div>
    <div class="form-group {{ hasValidator('comment') }}">
        <label class="control-label col-sm-3">Bình luận</label>
        <div class="col-sm-6">
            <textarea class="form-control" type="text" name="comment" rows="10">{{ old('comment', $testimonial->getComment()) }}</textarea>
            {!! alertError('comment') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
        </div>
    </div>
</form>