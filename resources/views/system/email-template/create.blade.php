@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2><i class="fa fa-list"></i> Tạo mẫu email mới</h2>
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

                    @include('system/email-template/form')
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')

@stop
