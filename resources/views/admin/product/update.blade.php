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

<style type="text/css">
    .input-file-hidden {
        position: absolute;
        width: 100%;
        height: 50px;
        top: 0;
        left: 0;
        opacity: 0;
    }
</style>
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

                        @if(!$product->hasChild())
                        <div class="form-group"><label class="col-sm-3 control-label">Ảnh sản phẩm</label>
                            <div class="col-sm-9">
                                @if($data['image'])
                                    <span style="position: relative; display: inline-block; margin: 0 5px 0 0">
                                        <img class="img-thumbnail" src="{{ parse_image_url('sm_'.$data['image']) }}" height="90" style="margin-bottom: 10px; height: 50px; display: block;">
                                        <input name="image" type="file" class="form-control input-file-hidden">
                                        <span class="help-inline text-info" style="font-size: 10px;">Mặt trước</span>
                                    </span>
                                @endif

                                @if($data['back_image'])
                                    <span style="position: relative; display: inline-block; margin: 0 5px 0 0">
                                        <img class="img-thumbnail" src="{{ parse_image_url('sm_'.$data['back_image']) }}" height="90" style="margin-bottom: 10px; height: 50px; display: block;">
                                        <input name="back_image" type="file" class="form-control input-file-hidden">
                                        <span class="help-inline text-info" style="font-size: 10px;">Mặt sau</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif

                        @if(!$product->hasChild())
                            <div class="form-group"><label class="col-sm-3 control-label">Ảnh mô tả sản phẩm</label>
                                <div class="col-sm-9"><input name="images[]" multiple="true" type="file" class="form-control"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    @foreach($product->images()->get() as $item)
                                        <a href="javascript:;" style="display: inline-block; margin: 0 2px 2px 0;">
                                            <img src="{{ parse_image_url('sm_'.$item->image) }}" height="50">
                                            <span data-id="{{ $item->id }}" class="js-action-delete-product-image" style="color: red; display: block; font-size: 10px;">Xóa</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

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
                                <input type="text" id="product-group" name="product_group" class="form-control" />
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
                        <div class="form-group"><label class="col-sm-3 control-label">Thông số kỹ thuật</label>
                            <div class="col-sm-9">
                                <textarea name="spec" class="form-control tiny-editor">{{ $data['spec'] }}</textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Mô tả sản phẩm</label>
                            <div class="col-sm-9">
                                <textarea name="content" class="form-control tiny-editor">{{ $data['content'] }}</textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Hướng dẫn sử dụng</label>
                            <div class="col-sm-9">
                                <textarea name="introduce" class="form-control tiny-editor">{{ $data['introduce'] }}</textarea>
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
                        <a href="javascript:;" id="show-change-option" data-toggle="modal" data-target="#modal-show-change-option" class="btn btn-xs btn-default">Tùy chỉnh</a>
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
                                <th></th>
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
                                        <td>
                                            <a href="javascript:;" data-variant_id="{{ $item->id }}" class="action-delete-variant"><i class="fa fa-trash fa-2x text-danger"></i></a>
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
                    <button class="btn btn-info" type="button" id="btn-save-and-exit">Lưu & Thoát</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-default">Hủy</a>
                </div>
            </div>
        </form>
    </div>
</div>


 <div id="modal-show-change-option" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-create-option" method="POST" action="">
                <div class="modal-header">
                    <h3>Tùy chỉnh</h3>
                </div>
                <div class="modal-body">
                    <div id="variant-container">
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
                                    <?php
                                        $valueJson = [];
                                    ?>
                                    @foreach($property->values as $valueItem)
                                        <?php
                                            $valueJson[] = [
                                                'id' => $valueItem->id,
                                                'label' => $valueItem->name
                                            ];
                                        ?>
                                    @endforeach
                                    <script type="text/javascript">
                                        $(function() {
                                            $('#property-{{ $property->id }}').inficaTagsInput({
                                                items: {!! json_encode($valueJson) !!},
                                                placeHolder: "VD: Xanh,Đỏ,Vàng",
                                                onRemoveTag: function(el) {
                                                    $.ajax({
                                                        url: '/system/product/ajax/delete-option-value',
                                                        type : "POST",
                                                        data: {
                                                            id: $(el).data('id'),
                                                            _token: "{{ csrf_token() }}"
                                                        },
                                                        success: function(response) {
                                                            toastr.message(response.message, response.type, {
                                                                timeOut: 800
                                                            });
                                                        }
                                                    });
                                                }
                                             });
                                        });
                                    </script>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn btn-xs btn-danger btn-delete-attribute" data-id="{{ $property->id }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </section>
                        @endforeach
                        <div id="placement-new-attribute"></div>
                        <input type="hidden" name="product_id" value="{{ $data['id'] }}">
                        {!! csrf_field() !!}
                        <button id="btn-add-new-attribute" class="btn btn-xs btn-danger">Tạo mới thuộc tính</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" data-dismiss="modal" class="btn btn-sm btn-default">Đóng</a>
                    <button class="btn btn-sm btn-primary">Cập nhật</button>
                </div>
            </form>
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
        has_child : {{ $data->has_child }},
        group_data_input_token: {!! json_encode($groupDataInputToken) !!}
    }).init();
});
</script>
@stop
