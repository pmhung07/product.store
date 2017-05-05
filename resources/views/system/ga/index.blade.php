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

                    </div>
                </div>

                <div class="ibox">

                    @include('includes/flash-message')

                    <div class="ibox-content">
                        <div class="table-responsive" style="overflow-x: inherit;">
                            <table class="table table-striped table-bordered table-hover table-zip" id="editable" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Visit</th>
                                        <th>Bounce rate</th>
                                        <th>Page view</th>
                                        <th>Unique page view</th>
                                        <th>Avg session duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $item)
                                        <tr>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ formatCurrency($item->visit) }}</td>
                                            <td>{{ number_format($item->bounce_rate, 2, '.', '.') }}%</td>
                                            <td>{{ $item->page_view }}</td>
                                            <td>{{ $item->unique_page_view }}</td>
                                            <td>{{ gmdate("H:i:s", round($item->avg_session_duration)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-left paging-lst table">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {!! $rows->appends($_GET)->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
