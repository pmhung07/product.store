@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> Tạo mới sản phẩm</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop

@section('content')

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

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
            	<div class="col-lg-12">

                    <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group"><label class="col-sm-3 control-label">Ảnh sản phẩm</label>
                            <div class="col-sm-9">
                                @if($data['image'])
                                    <img src="{{ parse_image_url('sm_'.$data['image']) }}" height="90" style="margin-bottom: 10px;">
                                @endif
                                <input name="image" type="file" class="form-control">
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Ảnh mô tả sản phẩm</label>
                            <div class="col-sm-9"><input name="images[]" multiple="true" type="file" class="form-control"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Tên sản phẩm</label>
                            <div class="col-sm-9">
                            	<input name="product_name" type="text" class="form-control" value="{!! old('product_name',isset($data) ? $data['name'] : '') !!}">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mã sản phẩm (SKU)</label>
                            <div class="col-sm-9">
                            	<input name="product_sku" type="text" class="form-control" value="{!! old('product_sku',isset($data) ? $data['sku'] : '') !!}">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Barcode</label>
                            <div class="col-sm-9">
                            	<input name="product_barcode" type="text" class="form-control" value="{!! old('product_barcode',isset($data) ? $data['barcode'] : '') !!}">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nhóm sản phẩm</label>
                            <div class="col-sm-9">
        	                    <select class="form-control m-b" name="product_group">
        	                    	<option value="" selected="">-- Chọn nhóm sản phẩm --</option>
                                    <?php cat_parent($group_product,0,"--",$data['product_group_id']); ?>
        	                    </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Chọn đơn vị đo</label>
                            <div class="col-sm-9">
        	                    <select class="form-control m-b" name="product_unit">
        	                    	<option value="" selected="">-- Chọn đơn vị  --</option>
                                    @foreach($units as $item)
                                        <option <?=($item['id'] == $data['unit_id'])?"selected":"";?> value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                    @endforeach
        	                    </select>
                            </div>
                        </div>
        	            <div class="form-group"><label class="col-sm-3 control-label">Giá bán</label>
        	                <div class="col-sm-9">
        	                    <div class="input-group m-b"><span class="input-group-addon">vnđ</span>
                                <input name="product_price" type="text" class="form-control" value="{!! old('product_price',isset($data) ? $data['price'] : '') !!}"> </div>
        	                </div>
        	            </div>
                        <div class="form-group"><label class="control-label col-sm-3">Cảnh báo hết hàng</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_warning_low_in_stock" value="{!! old('product_warning_low_in_stock',isset($data) ? $data['warning_out_of_stock'] : '') !!}" class="form-control" placeholder="Nhập số lượng cảnh báo sắp hết hàng trong kho">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Cân nặng - Thể tích</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="product_weight" value="{!! old('product_weight',isset($data) ? $data['weight'] : '') !!}" class="form-control js_price ng-pristine ng-untouched ng-valid" placeholder="Nhập cân nặng sản phẩm">
                                    <span class="input-group-addon btn-flat ng-binding">0 <sup>g</sup></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="product_volume" value="{!! old('product_volume',isset($data) ? $data['volume'] : '') !!}" class="form-control js_price ng-pristine ng-valid ng-touched" placeholder="Nhập thể tích sản phẩm">
                                    <span class="input-group-addon btn-flat ng-binding">0 <sup>ml</sup></span>
                                </div>
                            </div>
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
