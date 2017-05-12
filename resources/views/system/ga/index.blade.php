@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Google analytics </h2>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox" style="margin-bottom:0px;">
                    <div class="ibox-content">
                        <form class="form form-inline">
                            <input type="text" class="form-control input-sm datepicker" name="date_from" value="{{ Request::get('date_from') }}" placeholder="Từ ngày">
                            <input type="text" class="form-control input-sm datepicker" name="date_to" value="{{ Request::get('date_to') }}" placeholder="...đến ngày">
                            <button type="submit" class="btn btn-sm btn-primary">Lọc</button>
                        </form>
                    </div>
                </div>

                <div class="ibox">

                    @include('includes/flash-message')

                    <div class="ibox-content">

                        <canvas id="chart-visit"></canvas>

                        <p style="margin-bottom: 50px;"></p>
                        <canvas id="chart"></canvas>

                        <p style="margin-bottom: 50px;"></p>
                        <canvas id="chart-bounce-rate"></canvas>

                        <p style="margin-bottom: 50px;"></p>
                        <canvas id="chart-session-duration"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="/js/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var scope = {
        chart_data : {!! json_encode($chart) !!}
    }
    new app.GaController(scope).init();
</script>
@stop