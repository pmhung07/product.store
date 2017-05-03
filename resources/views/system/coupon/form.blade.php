<form id="form-data" action="" class="form-horizontal" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

    <div class="form-group {{ hasValidator('code') }}">
        <label class="control-label col-sm-3">Mã</label>
        <div class="col-sm-8">
            <input type="text" value="{{ old('code', $coupon->code) }}" name="code" class="form-control">
            {!! alertError('code') !!}
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-3">Giá trị giảm giá</label>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" value="{{ old('value', $coupon->value) }}" name="value" class="form-control">
                    {!! alertError('value') !!}
                </div>
                <div class="col-sm-3">
                    <select class="form-control" name="type_value">
                        <option value="">Kiểu giá trị</option>
                        @foreach(App\Models\Coupon::typeValues() as $key => $value)
                            <option value="{{ $key }}" {{ $key == old('type_value', $coupon->type_value) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    {!! alertError('type_value') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ hasValidator('type') }}">
        <label class="control-label col-sm-3">Loại</label>
        <div class="col-sm-8">
            <select class="form-control" id="type" name="type">
                <option value="">Chọn loại coupon</option>
                @foreach(App\Models\Coupon::types() as $key => $value)
                    <option value="{{ $key }}" {{ $key == old('type', $coupon->type) ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            {!! alertError('type') !!}
        </div>
    </div>

    <div class="form-group choice-something hide" id="choice-single-product">
        <label class="control-label col-sm-3">Chọn một hoặc nhiều sản phẩm</label>
        <div class="col-sm-8">
            <input type="text" name="product_id" class="form-control">
        </div>
    </div>

    <div class="form-group choice-something hide" id="choice-product-group">
        <label class="control-label col-sm-3">Chọn một hoặc nhiều nhóm sản phẩm</label>
        <div class="col-sm-8">
            <input type="text" name="product_group_id" class="form-control">
        </div>
    </div>

    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-3">
            <button class="btn btn-primary" type="submit">Lưu thông tin</button>
        </div>
    </div>
</form>