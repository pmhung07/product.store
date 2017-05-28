@extends('layout/admin/index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                Menu
                <a class="pull-right btn btn-xs btn-primary" href="{{ route('system.navigation.create') }}">Thêm mới</a>
            </h2>
        </div>
    </div>
@stop

{{-- Page content --}}
@section('content')

<div class="ibox">
    @include('includes/flash-message')
    <div class="ibox-content">
        <table class="table table-hover table-bordered">
            <thead>
                <th>STT</th>
                <th>ID</th>
                <th>Name</th>
                <th>Url</th>
                <th>Thứ tự</th>
                <th>Updated at</th>
                <th>Active</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php
                    $page = (int) Request::get('page', 1);
                    $no = 0
                ?>
                @foreach($menus as $item)
                    @php $no ++ @endphp
                    <tr id="{{ $item->getId() }}" data-has_child="{{ $item->has_child }}" data-deep="{{ $item->level }}">
                        <td>{{ $no }}</td>
                        <td>{{ $item->getId() }}</td>
                        <td><?php for($i = 0; $i < $item->level; $i ++) echo '--'; ?><a href="" class="editable" data-name="label" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getLabel() }}</a></td>
                        <td>
                            @if($item->getType() == App\Models\Navigation::TYPE_CUSTOM)
                                <a href="" class="editable" data-name="url" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getUrl() }}</a>
                            @else
                                {{ $item->getUrl() }}
                            @endif
                        </td>
                        <td><a href="" class="editable" data-name="sort" data-pk="{{ $item->getId() }}" data-type="text">{{ $item->getSort() }}</a></td>
                        <td>{{ $item->getUpdatedAt() }}</td>
                        <td width="30">{!! makeActiveButton(route('system.navigation.active', $item->getId()), $item->getActive()) !!}</td>
                        <td width="30">{!! makeEditButton(route('system.navigation.edit', [$item->getId(), 'type' => $item->getType()])) !!}</td>
                        <td width="30">{!! makeDeleteButton(route('system.navigation.delete', $item->getId())) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop


@section('script')
<script type="text/javascript">
    $(function() {
        $('.editable').editable({
            showbuttons : true,
            url : '{{ route('system.navigation.ajax.editable') }}',
            params : {
               _token : '{{ csrf_token() }}'
            }
        });
    });
</script>
@endsection