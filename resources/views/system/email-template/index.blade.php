@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                <i class="fa fa-list"></i> Mẫu email
                <a href="{{ route('system.emailTemplate.create') }}" class="pull-right btn btn-sm btn-primary">Tạo mới</a>
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
                            <th>Tiêu đề</th>
                            <th>Cập nhật lần cuối</th>
                            <th width="30">Sửa</th>
                            <th width="30">Xóa</th>
                        </thead>
                        <tbody>
                            @foreach($items as $k => $item)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>{!! makeEditButton(route('system.emailTemplate.update', $item->id)) !!}</td>
                                <td>{!! makeDeleteButton(route('system.emailTemplate.delete', $item->id)) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')

@stop
