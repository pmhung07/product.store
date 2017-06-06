@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6">
        <h2><i class="fa fa-user"></i> Danh sách khách hàng</h2>
    </div>
    <div class="col-lg-6 btn-add">
        <a href="system/customer/create" class="btn btn-primary" ><i class="fa fa-plus"></i>&nbsp;Tạo khách hàng</a>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox" style="margin-bottom:0px;">
                    <div class="ibox-content">
                        <form class="form form-inline">
                            <input type="text" name="cus_name" placeholder="Tên khách hàng" value="{{ Request::get('cus_name') }}" class="form-control input-sm">
                            <input type="text" name="cus_phone" placeholder="Số điện thoại" value="{{ Request::get('cus_phone') }}" class="form-control input-sm">
                            <select id="province_id" name="province_id" class="form-control input-sm">
                                <option value="">Tỉnh/Thành phố</option>
                                @foreach($provinces as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == Request::get('province_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <select id="district_id" name="district_id" class="form-control input-sm">
                                <option value="">Quận/Huyện</option>
                                @foreach($districts as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == Request::get('district_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label class="checkbox checkbox-inline">
                                <input id="vip_customer" type="checkbox" name="vip_customer" value="1" {{ Request::get('vip_customer') == 1 ? 'checked' : '' }}> Mua nhiều nhất
                            </label>
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i> Lọc</button>
                        </form>

                        <div style="margin: 10px 0 0 0;">
                            <form id="form-bulk-action" class="form form-inline hide">
                                <select id="bulk_action" name="bulk_action" class="form-control input-sm">
                                    <option value="">Thao tác</option>
                                    @foreach($bulkActions as $key => $value)
                                        <option value="{{ $key }}" {{ $key == Request::get('bulk_action') ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    @if (Session::has('flash_message'))
                    <div class="ibox-content">
                        <div class="alert alert-success"  style="margin-bottom:0px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('flash_message') !!}
                        </div>
                    </div>
                    @endif

                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                            <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="ckb_all" name="check_all">
                                </th>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Giới tính</th>
                                <th>Quận huyện</th>
                                <th>Tỉnh thành</th>
                                <th>Thống kê</th>
                                <th class="text-right" width="130">Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                    <td>
                                        <input type="checkbox" class="ckb_item" name="customers[]" value="{{ $row->id }}">
                                    </td>
                                    <td>{!! $i !!}</td>
                                    <td> {!! $row->name !!}</td>
                                    <td> {!! $row->phone !!}</td>
                                    <td>
                                        <?php
                                        if($row->gender == 1){
                                            echo 'Nam';
                                        }else{
                                            echo 'Nữ';
                                        }
                                        ?>
                                    </td>
                                    <td> {!! $row->provinces_name !!}</td>
                                    <td> {!! $row->districts_name !!}</td>
                                    <td>
                                        <a href="{!! URL::route('admin.customer.getDetails',$row->id) !!}" class="btn btn-xs">
                                            <i class="fa fa-bar-chart "></i>
                                            Thống kê, báo cáo
                                        </a>
                                    </td>
                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a href="{!! URL::route('admin.customer.getUpdate',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-edit "></i>
                                                Sửa
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.customer.delete',$row->id) !!}" class="btn-white btn btn-xs">
                                                <i class="fa fa-trash "></i>
                                                Xoá
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {{ $rows->appends(array(
                                        'name' =>Request::input('cus_name'),
                                        'phone' =>Request::input('cus_phone'),
                                        ))->links()
                                    }}
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
                Xoá dữ liệu Sản phẩm
            </div>
            <div class="modal-body">
                Bạn có muốn xoá dữ liệu này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                <a class="btn btn-danger btn-ok">Xoá dữ liệu</a>
            </div>
        </div>
    </div>
</div>

<div id="modal-sms" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-send-sms" method="POST" action="POST" class="form">
                <div class="modal-header">
                    Gửi tin nhắn
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Nội dung tin nhắn</label>
                        <textarea name="msg" class="form-control" placeholder="Nhập nội dung tin nhắn"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-ok">Gửi tin nhắn</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal-email" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-send-email" method="POST" action="POST" class="form">
                <div class="modal-header">
                    Gửi mail
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nội dung</label>
                        <textarea name="mail" class="form-control tiny-editor" placeholder="Nhập nội dung"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-ok">Gửi mail</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

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

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#province_id').ajaxLoadDistrict({
        observers: '#district_id'
    });

    // Check all
    $('#ckb_all').on('click', function() {
        $('.ckb_item').prop('checked', this.checked);
        if(this.checked) {
            $('#form-bulk-action').removeClass('hide');
        } else {
            $('#form-bulk-action').addClass('hide');
        }
    });

    function get_customers_id() {
        var ids = [];
        $('.ckb_item:checked').each(function(ind, el) {
            ids.push($(el).val());
        });
        return ids;
    }

    // Bulk action
    $('#bulk_action').on('change', function() {
        var $this = $(this);

        var customer_ids = get_customers_id();
        if(customer_ids.length == 0) {
            alert("Vui lòng chọn ít nhất 1 khách hàng để thực hiện thao tác này");
            $('#form-bulk-action').find('select').val("");
            return;
        }

        switch ($this.val()) {
            case "SEND_SMS":
                $('#modal-sms').modal('show');
                break;

            case "SEND_EMAIL":
                $('#modal-email').modal('show');
                break;

            case "DELETE_MULTI":
                break;
        }
    });

    $('#form-send-sms').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        $('#modal-sms').modal('hide');
        $.ajax({
            url : "{{ route('system.ajax.send_sms') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                customers: get_customers_id().join(","),
                msg: $this.find('[name="msg"]').val()
            },
            success : function(response) {
                if(response.code == 1) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });


    $('#form-send-email').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        $('#modal-email').modal('hide');
        $.ajax({
            url : "{{ route('system.ajax.send_mail') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                customers: get_customers_id().join(","),
                content: $this.find('[name="mail"]').val(),
                title: $this.find('[name="title"]').val()
            },
            success : function(response) {
                if(response.code == 1) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
});
</script>
@stop
