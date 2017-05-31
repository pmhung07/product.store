@extends('layout.admin.index')

@section('breadcrumbs')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Banner #{{ $banner->id }}, <small>{{ $banner->link }}</small></h2>
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

                        @include('system/banner/form');
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
