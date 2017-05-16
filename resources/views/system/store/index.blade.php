@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-list"></i> Danh sách cửa hàng </h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="{{ route('system.store.create') }}" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox" style="margin-bottom:0px;">
                    <div class="ibox-content">
                        @include('system/store/search-form')
                    </div>
                </div>

                <div class="ibox">

                    @include('includes/flash-message')

                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                <thead>
                                    <tr>
                                        <th width="60">#</th>
                                        <th width="">Tên</th>
                                        <th>Địa chỉ</th>
                                        <th width="150">Ngày tạo</th>
                                        <th width="30">Sửa</th>
                                        <th width="30">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stores as $k => $item)
                                        <tr>
                                            <td>{{ $k }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('system.store.update', $item->id) }}" class="btn btn-xs btn-white"><i class="fa fa-edit"></i> Sửa</a>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('system.store.delete', $item->id) }}" class="btn btn-xs btn-white"><i class="fa fa-trash"></i> Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-left paging-lst table">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {!! $stores->appends($_GET)->links() !!}
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
                Xoá dữ liệu
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

@stop

@section('script')
<script type="text/javascript">
    $(function() {
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
@stop