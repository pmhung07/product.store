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
    <div class="col-lg-12 animated fadeInRight">

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

                    <form id="form-data" action="{!! route('admin.product.getCreate') !!}" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ảnh sản phẩm</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input name="image" type="file" class="form-control">
                                        <span class="help-inline text-info">Ảnh mặt trước</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="back_image" type="file" class="form-control">
                                        <span class="help-inline text-info">Ảnh mặt sau</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Ảnh mô tả sản phẩm</label>
                            <div class="col-sm-9"><input name="images[]" type="file" multiple="true" class="form-control input-upload-file"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Tên sản phẩm</label>
                            <div class="col-sm-9"><input name="product_name" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mã sản phẩm (SKU)</label>
                            <div class="col-sm-9"><input name="product_sku" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Barcode</label>
                            <div class="col-sm-9"><input name="product_barcode" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Nhóm sản phẩm</label>
                            <div class="col-sm-9">
        	                    <input type="text" id="product-group" name="product_group" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Chọn đơn vị đo</label>
                            <div class="col-sm-9">
        	                    <select class="form-control m-b" name="product_unit">
        	                    	<option value="" selected="">-- Chọn đơn vị  --</option>
                                    @foreach($units as $item)
                                        <option value="{!! $item['id'] !!}">{!! $item['name'] !!}</option>
                                    @endforeach
        	                    </select>
                            </div>
                        </div>
        	            <div class="form-group">
                            <label class="col-sm-3 control-label">Giá bán</label>
        	                <div class="col-sm-9">
        	                    <div class="input-group m-b"><span class="input-group-addon">vnđ</span>
                                <input name="product_price" type="text" class="form-control">
                                </div>
        	                </div>
        	            </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Giá khuyến mãi</label>
                            <div class="col-sm-9">
                                <div class="input-group m-b"><span class="input-group-addon">vnđ</span>
                                <input name="promotion_price" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="control-label col-sm-3">Cảnh báo hết hàng</label>
                            <div class="col-sm-9">
                                <input type="text" name="product_warning_low_in_stock" class="form-control" placeholder="Nhập số lượng cảnh báo sắp hết hàng trong kho">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Cân nặng - Thể tích</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="product_weight" class="form-control js_price ng-pristine ng-untouched ng-valid" placeholder="Nhập cân nặng sản phẩm">
                                    <span class="input-group-addon btn-flat ng-binding">0 <sup>g</sup></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="product_volume" class="form-control js_price ng-pristine ng-valid ng-touched" placeholder="Nhập thể tích sản phẩm">
                                    <span class="input-group-addon btn-flat ng-binding">0 <sup>ml</sup></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Thông số kỹ thuật</label>
                            <div class="col-sm-9">
                                <textarea name="spec" class="form-control summernote">{{ old('spec') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Mô tả sản phẩm</label>
                            <div class="col-sm-9">
                                <textarea name="content" class="form-control summernote"></textarea>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Hướng dẫn sử dụng</label>
                            <div class="col-sm-9">
                                <textarea name="introduce" class="form-control summernote"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                Sản phẩm có nhiều phiên bản
                                <p class="help-block text-info" style="font-size: 10px;">Sản phẩm có nhiều phiên bản dựa theo các thuộc tính màu sắc, kích thước</p>
                            </label>
                            <div class="col-sm-9">
                                <button id="add-variant" class="form-control-static btn btn-xs btn-info">Thêm phiên bản</button>
                                <small id="cancel-variant" class="text text-info hide" style="cursor: pointer;">Bỏ qua</small>
                                <div id="variant-container" class="hide" style="margin-top: 10px; padding: 10px;  background-color: #f5f6f7">
                                    <header class="row">
                                        <div class="col-sm-4">
                                            <h5>Tên thuộc tính</h5>
                                        </div>
                                        <div class="col-sm-8">
                                            <h5>Giá trị thuộc tính</h5>
                                        </div>
                                    </header>
                                    <section class="row attribute-row first-attribute" style="margin-bottom: 10px;">
                                        <div class="col-sm-4">
                                            <input type="text" name="option[]" class="form-control" placeholder="Tên thuộc tính" style="margin-bottom: 10px;">
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control attribute-value-input" name="value[]" placeholder="Giá trị thuộc tính cách nhau bằng dấu phẩy. Ví dụ: Xanh,Đỏ,Vàng"></textarea>
                                        </div>
                                    </section>
                                    <div id="placement-new-attribute"></div>
                                    <button id="btn-add-new-attribute" class="btn btn-xs btn-danger">Tạo mới thuộc tính</button>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                                <button class="btn btn-info" type="button" id="btn-save-and-exit">Lưu & Thoát</button>
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
<script src="js/plugins/jasny/jasny-bootstrap.min.js"></script>

<script type="text/template" id="template-new-attribute">
    <section class="row attribute-row append" style="margin-bottom: 10px;">
        <div class="col-sm-4">
            <input type="text" name="option[]" class="form-control" placeholder="Tên thuộc tính" style="margin-bottom: 10px;">
        </div>
        <div class="col-sm-7">
            <textarea class="form-control attribute-value-input" name="value[]" placeholder="Giá trị thuộc tính cách nhau bằng dấu phẩy. Ví dụ: Xanh,Đỏ,Vàng"></textarea>
        </div>
        <div class="col-sm-1">
            <button class="btn btn-xs btn-danger btn-delete-attribute"><i class="fa fa-trash"></i></button>
        </div>
    </section>
</script>

<style type="text/css">
    div.tagsinput div {
        float: none;
    }
    div.tagsinput input {
        width: 100% !important;
    }
</style>

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

    new app.ProductAddController().init();
});
</script>
@stop
