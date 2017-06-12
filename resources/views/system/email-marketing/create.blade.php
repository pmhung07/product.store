@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>
                <i class="fa fa-plus"></i> Tạo chiến dịch
                <a class="pull-right btn btn-sm btn-default" href="{{ route('system.emailMarketing.index') }}"><i class="fa fa-arrow-left"></i> Quay lại</a>
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
                        @include('system/email-marketing/form')
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('script')

@stop