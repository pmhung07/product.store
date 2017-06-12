<form class="form" method="POST">
    <div class="form-group {{ hasValidator('name') }}">
        <label class="control-label">Tên chiến dịch</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}">
        {!! alertError('name') !!}
    </div>
    <div class="form-group">
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-md btn-primary">Cập nhật</button>
    </div>
</form>