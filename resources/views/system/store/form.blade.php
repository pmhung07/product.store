<form class="form form-horizontal" method="POST" action="">
    <div class="form-group">
        <label class="col-sm-3 control-label"><b class="text-danger">*</b> Tên</label>
        <div class="col-sm-9">
            <input type="text" name="name" value="{{ old('name', $store->name) }}" class="form-control">
        </div>
    </div>
    <div class="form-group"><label class="col-sm-3 control-label">Tỉnh/Thành phố</label>
        <div class="col-sm-9">
            <select class="form-control" id="province_id" name="province_id">
                <option value="">Tỉnh/Thành phố</option>
                @foreach($provinces as $item)
                    <option value="{{ $item->id }}" {{ $item->id == old('province_id', $store->province_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group"><label class="col-sm-3 control-label">Huyện</label>
        <div class="col-sm-9">
            <select class="form-control" id="district" name="district_id">
                <option value="">Huyện</option>
                @foreach($districts as $item)
                    <option value="{{ $item->id }}" {{ $item->id == old('district_id', $store->district_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label"><b class="text-danger">*</b> Địa chỉ</label>
        <div class="col-sm-9">
            <input type="text" name="address" value="{{ old('address', $store->address) }}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">SĐT</label>
        <div class="col-sm-9">
            <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><b class="text-danger">*</b> Bài viết về cửa hàng</label>
        <div class="col-sm-9">
            <textarea type="text" name="content" class="form-control summernote">{!! old('content', $store->content) !!}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-9 col-sm-offset-3">
            {!! csrf_field() !!}
            <button class="btn btn-sm btn-primary" type="submit">Cập nhật</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#province_id').ajaxLoadDistrict({
        observers: '#district'
    });
</script>