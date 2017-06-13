<form class="form" method="POST">
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label">Tên chiến dịch</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}">
        {!! alertError('name') !!}
    </div>
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label">Đặt lịch gửi</label>
        <div class="row">
            <div class="col-xs-1">
                <input type="text" name="day" class="form-control input-sm" placeholder="Ngày" required>
            </div>
            <div class="col-xs-1">
                <input type="text" name="month" class="form-control input-sm" placeholder="Tháng" required>
            </div>
            <div class="col-xs-1">
                <input type="text" name="year" class="form-control input-sm" placeholder="Năm" required>
            </div>
            <div class="col-xs-1">
                <input type="text" name="hour" class="form-control input-sm" placeholder="Giờ" required>
            </div>
            <div class="col-xs-1">
                <input type="text" name="minute" class="form-control input-sm" placeholder="Phút" required>
            </div>
            <div class="col-xs-3">
                <div class="checkbox">
                    <label><input type="checkbox" value="now">Bây giờ</label>
                </div>
            </div>
        </div>
        <span class="help-inline text-info">Chú ý: Giờ: 00-23,Phút: 00-59,Ngày: 01-31,Tháng: 01-12</span>
        {!! alertError('name') !!}
    </div>
    <div class="form-group">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-md btn-primary">Cập nhật</button>
    </div>
</form>