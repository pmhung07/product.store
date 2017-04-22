@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-list"></i> Thuộc tính sản phẩm: <a>{!! $data['name'] !!}</a></h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">
    <div class="col-lg-12">

       @if (Session::has('flash_error'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_error') !!}
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
                <div class="col-md-12">
                    <div class="block-content">
                        <div class="tab-wrap">
                            <span></span>
                        </div>
                        <div class="ibox">
                            <div class="ibox-title" style="background-color:#fbfafa;color: #000;padding-top: 0px;border: none">
                                <span class="pull-right"></span>
                                <div class="input-group" style="width:100%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <input type="text" name="search-properties" class="form-control search-properties"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm thuộc tính theo tên..">
                                    </div>
                                </div>
                                <div><h4 style="font-weight: 400;color: #4b6574;padding-left: 10px;"><i class="fa fa-angle-double-down"></i> Hoặc tạo mới</h4></div>
                                <form action="{!! route('admin.properties.update',$data['id']) !!}" method="POST" class="form-horizontal">
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <div class="form-group">
                                        <div class="col-sm-12"><input placeholder="Tên thuộc tính" name="properties_name" type="text" class="form-control properties_name"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12"><input placeholder="Giá trị thuộc tính" name="properties_value" type="text" class="form-control"></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-0">
                                            <button class="btn btn-primary" type="submit">Lưu thuộc tính và giá trị vào sản phẩm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="ibox-content" style="padding:15px 15px 20px 15px;">
                                <div class="table-responsive" style="overflow-x: inherit;">
                                    <table class="table table-striped table-bordered table-hover " id="editable" style="width:100%";>
                                        <thead>
                                            <tr>
                                                <th width="5" class="text-center" style="background:#f1f1f1;">#</th>
                                                <th width="50">Ảnh</th>
                                                <th width="300" style="background:#f6fcff;">Thuộc tính</th>
                                                <th width="300" style="background:#fffafa;">Giá trị</th>
                                                <th width="60" class="text-right" style="background:#fffafa;">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody class="append_product">
                                            <?php $i =1;foreach($properties as $value){ ?>
                                                <tr>
                                                    <td style="vertical-align: middle;" class="text-center">{!!$i!!}</td>
                                                    <td>
                                                        <div class="wrap-img-product fa-empty-images cursor-pointer" data-bind=""></div>
                                                    </td>
                                                    <td style="vertical-align: middle;">{!! $value['properties_name'] !!}</td>
                                                    <td style="vertical-align: middle;">{!! $value['properties_value_name'] !!}</td>
                                                    <td style="vertical-align: middle;" class="text-right">
                                                        <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.product.getDeleteProperties',$value['product_properties_id']) !!}" class="btn-white btn btn-xs">
                                                            <i class="fa fa-trash "></i> Xoá
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php $i++;} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-minus-circle"></i> Xoá dữ liệu thuộc tính
            <div class="modal-body">
                <b>Bạn có chắc chắn muốn xoá dữ liệu thuộc tính này không ?</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                <a class="btn btn-danger btn-ok">Xoá dữ liệu</a>
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
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<script>
$(document).ready(function() {
        // Search Customer
    var engine = new Bloodhound({
        remote: {
            url: '/get-properties-auto-complete?search-properties=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-properties'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $(".search-properties").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),
        name: 'usersList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+'</div>'
            }
        },
        engine: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $('.properties_name').val(selection.name);
    });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    
});
</script>
@stop
