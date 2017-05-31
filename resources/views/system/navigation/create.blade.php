@extends('layout/admin/index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Tạo menu</h2>
        </div>
    </div>
@stop

{{-- Page content --}}
@section('content')
    <div class="panel">
        <div class="panel-body">
            @include('system/navigation/form')
        </div>
    </div>
@stop