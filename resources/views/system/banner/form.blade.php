<form class="form-horizontal" method="post" action enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-sm-6 col-sm-offset-3">
            <img src="{{ $banner->getImage('sm') }}" height="90" onerror="this.src='/img/default_picture.png'">
        </div>
    </div>

    <div class="form-group {{ hasValidator('image') }}">
        <label for="email" class="col-sm-3 control-label">Ảnh <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <div class="row">
                <div class="col-sm-6">
                    <input type="file" class="form-control" value="{{ Request::old('image') }}" name="image">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="image_alt" value="{{ old('image_alt', $banner->image_alt) }}" class="form-control" placeholder="Alt">
                </div>
            </div>
            {!! alertError('image') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('title') }}">
        <label for="email" class="col-sm-3 control-label">Tiêu đề</label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('title', $banner->getTitle()) }}" name="title">
            {!! alertError('title') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('link') }}">
        <label for="email" class="col-sm-3 control-label">Link <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <input type="text" class="form-control" value="{{ Request::old('link', $banner->getLink()) }}" name="link">
            {!! alertError('link') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('position') }}">
        <label for="email" class="col-sm-3 control-label">Vị trí <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <select name="position" class="form-control input-sm">
                <option value="">Chọn vị trí</option>
                @foreach(App\Models\Banner::getPositionList() as $key => $value)
                <option value="{{ $key }}" {{ old('position',$banner->getPosition()) == $key  ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            {!! alertError('position') !!}
        </div>
    </div>

    <div class="form-group {{ hasValidator('page') }}">
        <label for="email" class="col-sm-3 control-label">Trang đích <b class="text-danger">*</b></label>
        <div class="col-sm-6 text-center">
            <select name="page" class="form-control input-sm">
                <option value="">Chọn trang đích</option>
                @foreach(App\Models\Banner::getPageList() as $key => $value)
                <option value="{{ $key }}" {{ old('page', $key == $banner->getPage()) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            {!! alertError('page') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Cập nhật</button>
        <a href="{{ route('system.banner.index') }}" class="btn btn-link">Quay lại</a>
        </div>
    </div>
    {!! csrf_field() !!}
</form>