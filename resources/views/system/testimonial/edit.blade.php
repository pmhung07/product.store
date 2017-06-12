@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>
            Ý kiến khách hàng <small>#{{ $testimonial->getId() }}</small>
            <div class="pull-right">
                <a href="{{ route('system.testimonial.index') }}" class="btn btn-xs btn-default">Quay lại</a>
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
                @include('system/testimonial/form')
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
