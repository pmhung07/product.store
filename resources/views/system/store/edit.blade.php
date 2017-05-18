@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                Cửa hàng {{ $store->name }}
                <div class="pull-right">
                    <a href="{{ route('system.store.index') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Quay lại</a>
                </div>
            </h2>
        </div>
    </div>
@stop

@section('content')
<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        <div class="col-xs-12">
            @include('includes/flash-message')
            @include('system/store/form')
        </div>
    </div>
</div>
@stop

@section('script')

@stop