@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> <small>Cập nhật sản phẩm</small> {{ $data->name }}</h2>
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

        <form id="form-data" action="{{ route('admin.product.getUpdate', $data->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">

            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                	<div class="col-lg-12">
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

                        @if(!$data->hasChild())
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
                        @endif

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
                        <div class="form-group"><label class="col-sm-3 control-label">Mô tả sản phẩm</label>
                            <div class="col-sm-9">
                                <textarea name="content" class="form-control summernote">{{ $data['content'] }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group">
                    <label class="control-label col-sm-3">
                        Sản phẩm có nhiều phiên bản
                        <p class="help-block text-info" style="font-size: 10px;">Sản phẩm có nhiều phiên bản dựa theo các thuộc tính màu sắc, kích thước</p>
                    </label>
                    <div class="col-sm-9">
                        <button id="add-variant" class="form-control-static btn btn-xs btn-info">Thêm phiên bản</button>
                        <small id="cancel-variant" class="text text-info hide" style="cursor: pointer;">Bỏ qua</small>
                        <div id="variant-container" class="{{ !$hasVariant ? 'hide' : '' }}" style="margin-top: 10px; padding: 10px;  background-color: #f5f6f7">
                            <header class="row">
                                <div class="col-sm-4">
                                    <h5>Tên thuộc tính</h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5>Giá trị thuộc tính</h5>
                                </div>
                            </header>
                            @foreach($properties as $property)
                                <section class="row attribute-row" style="margin-bottom: 10px;">
                                    <div class="col-sm-4">
                                        <input type="text" name="option[]" value="{{ $property->name }}" class="form-control" placeholder="Tên thuộc tính" style="margin-bottom: 10px;">
                                    </div>
                                    <div class="col-sm-7">
                                        <textarea id="property-{{ $property->id }}" class="form-control attribute-value-input" name="value[]" placeholder="Giá trị thuộc tính cách nhau bằng dấu phẩy. Ví dụ: Xanh,Đỏ,Vàng"></textarea>
                                        <script type="text/javascript">
                                            $(function() {
                                                @foreach($property->values as $valueItem)
                                                    $('#property-{{ $property->id }}').addTag('{{ $valueItem->name }}');
                                                @endforeach
                                            });
                                        </script>
                                    </div>
                                    <div class="col-sm-1">
                                        <button class="btn btn-xs btn-danger btn-delete-attribute"><i class="fa fa-trash"></i></button>
                                    </div>
                                </section>
                            @endforeach
                            <div id="placement-new-attribute"></div>
                            <button id="btn-add-new-attribute" class="btn btn-xs btn-danger">Tạo mới thuộc tính</button>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <table class="table {{ !$hasVariant ? 'hide' : '' }}" style="margin-top: 20px;">
                            <thead>
                                <th>#</th>
                                <th>Ảnh</th>
                                @foreach($properties as $item)
                                <th>{{ $item->name }}</th>
                                @endforeach
                                <th>Sku</th>
                                <th>Barcode</th>
                                <th>Giá</th>
                            </thead>
                            <tbody>
                                @foreach($childProducts as $k => $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>
                                            #{{ $k+1 }}
                                            <input type="hidden" name="child_product[{{ $k }}][id]" value="{{ $item->id }}">
                                        </td>
                                        <td>
                                            <img src="{{ $item->image ? parse_image_url('sm_'.$item->image) : '/img/default_picture.png' }}" id="variant-upload-image-{{ $k }}" class="variant-upload-image" data-key="{{ $k }}" style="cursor: pointer; max-height: 35px;">
                                            <input type="hidden" id="variant-image-{{ $k }}" name="child_product[{{ $k }}][image]" value="{{ $item->image }}">
                                        </td>

                                        @foreach($properties as $propertyItem)
                                        <td>
                                            @if(isset($item->property[$propertyItem->id]))
                                                @foreach($item->property[$propertyItem->id] as $valueName)
                                                    <span>{{ $valueName }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        @endforeach
                                        <td>
                                            <input type="text" name="child_product[{{ $k }}][sku]" value="{{ $item->sku }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="child_product[{{ $k }}][barcode]" value="{{ $item->barcode }}" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="child_product[{{ $k }}][price]" value="{{ $item->price }}" class="form-control">
                                        </td>
                                    </tr>
                                @endforeach
                                <input type="file" id="input-file-hidden" class="hide" name="file">
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>

            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">Lưu thông tin</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-default">Hủy</a>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

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

    new app.ProductUpdateController({
        has_child : {{ $data->has_child }}
    }).init();
});
</script>
@stop
