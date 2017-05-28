@extends('admin/layouts/master')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Sửa menu</h2>
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
        @include('menu::admin/form')
    </div>
</div>

@stop