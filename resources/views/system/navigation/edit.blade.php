@extends('layout/admin/index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                Sửa menu
                <a href="{{ route('system.navigation.index') }}" class="pull-right btn btn-sm btn-default">Quay lại</a>
            </h2>
        </div>
    </div>
@stop

{{-- Page content --}}
@section('content')
<div class="panel">
    <div class="panel-heading">
        <h3>
          Edit menu <small>{{ $menu->getLabel() }}</small>
       </h3>
    </div>
    <div class="panel-body">
        @include('system/navigation/form')
    </div>
</div>

@stop