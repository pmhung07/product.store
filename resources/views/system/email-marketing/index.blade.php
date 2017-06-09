@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                <i class="fa fa-list"></i> Email marketing
                <a class="pull-right btn btn-sm btn-primary" href="{{ route('system.emailMarketing.create') }}"><i class="fa fa-plus"></i> Tạo chiến dịch</a>
                <div class="clearfix"></div>
            </h2>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 animated">

            @include('includes/flash-message')

            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-stripped">
                            <thead>
                                <th>#</th>
                                <th>Tên chiến dịch</th>
                                <th>Ngày tạo</th>
                                <th width="30">Xóa</th>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('system.emailMarketing.delete', $item->id) }}" class="btn btn-xs btn-white"><i class="fa fa-trash"></i> Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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