@extends('layout/admin/index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>
            Ý kiến khách hàng
            <div class="pull-right">
                <a href="{{ route('system.testimonial.create') }}" class="btn btn-xs btn-primary">Thêm mới</a>
            </div>
        </h2>
    </div>
</div>
@stop

@section('content')
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover table-stripped">
                    <thead>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Nghề nghiệp</th>
                        <th>Bình luận</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $k => $item)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>
                                    <img src="{{ parse_image_url('sm_'.$item->avatar) }}" height="35">
                                </td>
                                <td>{{ $item->getProfession() }}</td>
                                <td>{{ $item->getComment() }}</td>
                                <td>{{ $item->getCreatedAt() }}</td>
                                <td>{{ $item->getUpdatedAt() }}</td>
                                <td width="30">{!! makeEditButton(route('system.testimonial.edit', $item->getId())) !!}</td>
                                <td width="30">{!! makeDeleteButton(route('system.testimonial.delete', $item->getId())) !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

