@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2><i class="fa fa-magic"></i> Danh sách Landing Page</h2>
    </div>
    <div class="col-lg-3 btn-add">
        <a href="system/landing-page/create_info" class="btn btn-primary " ><i class="fa fa-plus"></i>&nbsp;Tạo Landing Page</a>
    </div>
</div>
@stop            

@section('content')
<div class="row">

    <div class="col-lg-12 animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    @if (Session::has('flash_message'))
                    <div class="ibox-content">
                        <div class="alert alert-success"  style="margin-bottom:0px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {!! Session::get('flash_message') !!}
                        </div>
                    </div>
                    @endif

                    <div class="ibox-content">
                        <table class="table table-striped table-bordered table-hover " id="editable" >
                            <thead>
                                <tr>
                                    <th class="footable-visible footable-first-column footable-sortable">#<span class="footable-sort-indicator"></span></th>
                                    <th>Tiêu đề</th>
                                    <th>Người tạo</th>
                                    <th>Bán sản phẩm</th>
                                    <th>Ngày tạo</th>
                                    <th width="200" class="text-right">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($rows as $row)
                                <tr>
                                    <td>{!! $i !!}</td>
                                    <td>{!! $row->site_name !!}</td>
                                    <td>{!! $row->user_name !!}</td>
                                    <td>{!! $row->product_name !!}</td>
                                    <td>{!! $row->time_setup !!}</td>
                                    
                                    <?php $slug = str_slug($row->site_name, '-'); ?>

                                    <td class="text-right footable-visible footable-last-column">
                                        <div class="btn-group">
                                            <a class="btn-white btn btn-xs" target="_blank" href="{!! URL::route('admin.landing-page.site',$row->site_id) !!}">
                                                <i class="fa fa-magic"></i> Build
                                            </a>
                                            <a class="btn-white btn btn-xs" target="_blank" href="{!! URL::route('viewLandingPage',['site_id' => $row->site_id, 'slug' => $slug ]) !!}" >
                                                <i class="fa fa-eye "></i>    
                                                Preview
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="" class="btn-white btn btn-xs">
                                                <i class="fa fa-trash "></i>    
                                                Xoá
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <div class="dataTables_paginate paging_bootstrap_full">
                                    {{ $rows->appends(array(
                                        'id' =>Request::input('id'),
                                        'name' =>Request::input('name'),
                                        ))->links()
                                    }}
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

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">


<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

    $('.footable').footable();

    $('#date_added').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#date_modified').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
});
</script>
@stop
