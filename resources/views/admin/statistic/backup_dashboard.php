@extends('layout.admin.index')

@section('breadcrumbs')
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="col-lg-3" style="background:#fff;margin-bottom:25px;">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content" style="padding-top: 30px;">
                    <div class="condition">
                        <h2 style="margin-top: 0px;"></i> Thống kê theo: </h2>
                        <div class="hr-line-dashed"></div>
                        <p>
                            <input <?=($getby == 'product')?'checked':'';?> id="filter_prt_product" attr-filter-properties="Sản phẩm" type="radio" name="filter_properties" class="filter_properties" value="product">
                            &nbsp <label for="filter_prt_product"> Sản phẩm</label>
                        </p>
                        <ul class="properties_list properties_product condition-folder-list m-b-md" style="padding: 0">
                            <li>
                                <input class="form-control search-input-product" style="width:100%;" placeholder="Tìm sản phẩm theo tên, Sku" type="text" value="<?php if($pr_tbl == 'product'){ echo $product_name['name']; } ?>">
                            </li>
                        </ul>
                        <div class="hr-line-dashed"></div>
                        <p>
                            <input <?=($getby == 'product-group')?'checked':'';?> id="filter_prt_product-group" attr-filter-properties="Nhóm sản phẩm" type="radio" name="filter_properties" class="filter_properties" value="product-group">
                            &nbsp <label for="filter_prt_product-group"> Nhóm sản phẩm </label>
                        </p>
                        <ul class="properties_list properties_product condition-folder-list m-b-md" style="padding: 0">
                            <li>
                                <select attr-table="product_group" class="form-control" style="width:100%;">
                                    <option value="-1">-- Nhóm sản phẩm --</option>
                                    <?php foreach($product_group as $key => $value){ ?>
                                        <option <?=($pr_tbl == 'product_group' && $pr_tags == $value['id'])?'selected':'';?> attr-name="Nhóm sản phẩm: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                    <?php } ?>  
                                </select>
                            </li>
                        </ul>
                        <div class="hr-line-dashed"></div>
                        <p for="filter_prt_orders">
                            <input <?=($getby == 'order')?'checked':'';?> id="filter_prt_orders" attr-filter-properties="Đơn hàng" type="radio" name="filter_properties" class="filter_properties" value="order">
                            &nbsp <label for="filter_prt_orders"> Đơn hàng</label>
                        </p>
                        <ul class="properties_list properties_order condition-folder-list m-b-md" style="padding: 0">
                            <li>
                                <select attr-table="orders" class="form-control" style="width:100%;">
                                    <option value="-1">-- Trạng thái đơn hàng --</option>
                                    <option <?=($pr_tbl == 'orders' && $pr_tags == 0)?'selected':'';?> attr-name="Trạng thái đơn hàng: Đơn hàng chờ duyệt" value="0">-- Đơn hàng chờ duyệt --</option>
                                    <option <?=($pr_tbl == 'orders' && $pr_tags == 2)?'selected':'';?> attr-name="Trạng thái đơn hàng: Đơn hàng vận chuyển" value="2">-- Đơn hàng vận chuyển --</option>
                                    <option <?=($pr_tbl == 'orders' && $pr_tags == 3)?'selected':'';?> attr-name="Trạng thái đơn hàng: Đơn hàng thành công" value="3">-- Đơn hàng thành công --</option>
                                    <option <?=($pr_tbl == 'orders' && $pr_tags == 4)?'selected':'';?> attr-name="Trạng thái đơn hàng: Đơn hàng huỷ" value="4">-- Đơn hàng huỷ --</option>
                                </select>
                            </li>
                        </ul>
                        <div class="hr-line-dashed"></div>
                        <p style="font-size:20px;text-align:center;font-weight:100;">
                            Lọc theo <i class="fa fa-angle-double-down"></i>
                        </p>
                        <ul class="properties-list-conditions condition-folder-list m-b-md" style="padding: 0">
                            <li>
                                <input class="form-control search-input-customer" style="width:100%;" placeholder="Tên khách hàng, Sđt, Email" type="text" value="<?php if($condtn_customers != ''){ echo $customer_name['name']; } ?>">
                            </li>
                            <li>
                                <select attr-table="channel" class="conditions_channel form-control" style="width:100%;">
                                    <option value="-1">-- Kênh bán hàng --</option>
                                    <?php foreach($channel as $key => $value){ ?>
                                        <option <?=($condtn_channel == $value['id'])?'selected':'';?> attr-name="Kênh bán hàng: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <select attr-table="users" class="conditions_staff form-control" style="width:100%;">
                                    <option value="-1">-- Nhân viên --</option>
                                    <?php foreach($users as $key => $value){ ?>
                                        <option <?=($condtn_users == $value['id'])?'selected':'';?> attr-name="Nhân viên: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                    <?php } ?>
                                </select>
                            </li>
                            <li>
                                <select attr-table="provinces" class="conditions_provinces form-control" style="width:100%;">
                                    <option value="-1">-- Tỉnh thành --</option>
                                    <?php foreach($provinces as $key => $value){ ?>
                                        <option <?=($condtn_provinces == $value['id'])?'selected':'';?> attr-name="Tỉnh thành: <?=$value['name']?>" value="<?=$value['id']?>">-- <?=$value['name']?> --</option>
                                    <?php } ?>
                                </select>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">
                <h2><i class="fa fa-bar-chart-o"></i> Thống kê doanh số</h2>
                <?php if($getby != ''){ ?>
                <div class="mail-tools tooltip-demo filter-date">
                    <table class="table shoping-cart-table">
                        <tbody>
                            <tr>
                                <td style="width:25%;">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input value="{!! Request::input('filter-date-start') !!}" name="filter-date-start" class="form-control filter-date-start" style="width:100%;" type="text" placeholder="Từ ngày..">
                                    </div>
                                </td>
                                <td style="width:25%;">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input value="{!! Request::input('filter-date-end') !!}" name="filter-date-end" class="form-control filter-date-end" style="width:100%;" type="text" placeholder="Đến ngày..">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                <div class="hr-line-dashed"></div>
                <p>Thống kê theo: 
                    <b class="append-name-properties">
                        <?php 
                        if($getby == 'product'){ 
                            echo 'Sản phẩm'; 
                        }elseif($getby == 'product-group'){ 
                            echo 'Nhóm sản phẩm'; 
                        }elseif($getby == 'order'){ 
                            echo 'Đơn hàng'; 
                        }?>
                    </b>
                </p>
                <?php if($pr_tbl != ''){ ?>
                <div class="bootstrap-tagsinput append-tags-properties">
                    <?php if($pr_tbl == 'product_group'){ ?>
                        <span class="attr-properties tag label label-success">{!! $product_group_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($pr_tbl == 'product'){ ?>
                        <span class="attr-properties tag label label-success">{!! $product_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($pr_tbl == 'orders' && $pr_tags == 0){ ?>
                        <span class="attr-properties tag label label-success">Đơn hàng đang chờ duyệt<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($pr_tbl == 'orders' && $pr_tags == 2){ ?>
                        <span class="attr-properties tag label label-success">Đơn hàng vận chuyển<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($pr_tbl == 'orders' && $pr_tags == 3){ ?>
                        <span class="attr-properties tag label label-success">Đơn hàng thành công<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($pr_tbl == 'orders' && $pr_tags == 4){ ?>
                        <span class="attr-properties tag label label-success">Đơn hàng huỷ<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                </div>
                <?php } ?>
                <div class="hr-line-dashed"></div>
                <p>Lọc theo: </p>
                <?php if($condtn_channel != '' || $condtn_users != '' || $condtn_provinces != '' || $condtn_customers != ''){ ?>
                <div class="bootstrap-tagsinput append-tags-conditions">
                    <?php if($condtn_customers != ''){ ?>
                        <span class="attr-conditions-customers tag label label-success">Khách hàng: {!! $customer_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($condtn_channel != ''){ ?>
                        <span class="attr-conditions-channel tag label label-success">Kênh bánh hàng: {!! $channel_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($condtn_users != ''){ ?>   
                        <span class="attr-conditions-users tag label label-success">Nhân viên: {!! $users_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                    <?php if($condtn_provinces != ''){ ?>
                        <span class="attr-conditions-provinces tag label label-success">Tỉnh thành: {!! $provinces_name['name'] !!}<span class="tag-remove" data-role="remove"></span></span>
                    <?php }?>
                </div>
                <?php } ?>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="mail-box-header">


                <?php if($getby == 'product-group' && $pr_tbl==''){ ?>

                <!-- Thống kê tổng quán nhóm sản phẩm ************************************** -->

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;"><b>Nhóm sản phẩm</b></th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_group_product as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Thống kê tổng quán sản phẩm ******************************************* -->


                <?php }elseif($getby == 'product' && $pr_tbl==''){ ?>

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;"><b>Sản phẩm</b></th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_product as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                <?php }elseif($getby=='product-group' && $pr_tbl=='product_group'){ ?>

                <!-- Thống kê chi tiết nhóm sản phẩm ************************************************* -->

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;">Thống kê theo: <b>Nhóm sản phẩm</b></th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_group_product as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>

                <?php }elseif($getby=='product' && $pr_tbl=='product'){ ?>

                <!-- Thống kê chi tiết sản phẩm ************************************************* -->

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;">Thống kê theo: <b>Sản phẩm</b></th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_product as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                
                <?php }elseif($getby=='order' && $pr_tbl==''){ ?>

                <!-- Thống kê đơn hàng tổng quan ************************************************* -->

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;">Tổng số đơn hàng</th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_orders as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$statistics_orders_count}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                
                <?php }elseif($getby=='order' && $pr_tbl=='orders'){ ?>

                <!-- Thống kê đơn hàng tổng quan ************************************************* -->

                <table class="table table-striped table-bordered table-hover " id="editable" >
                    <thead>
                    <tr>
                        <th width="15">#</th>
                        <th style="color: #484848;">Tổng số đơn hàng</th>
                        <th>Doanh số (vnđ)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($statistics_orders as $row)
                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                <td>{{$i}}</td>
                                <td>{{$statistics_orders_count}}</td>
                                <td>{{number_format($row->total_price_in)}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="append-variable-properties">
    <?php if($getby == 'product'){ ?>
        <input class="var-properties" type="hidden" value="product">
    <?php }elseif($getby == 'product-group'){ ?>
        <input class="var-properties" type="hidden" value="product-group">
    <?php }elseif($getby == 'order'){ ?>
        <input class="var-properties" type="hidden" value="order">
    <?php } ?>
</div>
<div class="append-variable-properties-tags">
    <?php if($pr_tbl != '' && $pr_tags != ''){ ?>
        <input attr-table="{!! $pr_tbl !!}" class="var-properties-tags" type="hidden" value="{!! $pr_tags !!}">
    <?php } ?>
</div>
<div class="append-variable-conditions-tags">
    <?php if($condtn_customers != ''){ ?>
        <input attr-table="customers" class="var-conditions-tags-customers" type="hidden" value="{!! $condtn_customers !!}">
    <?php } ?>
    <?php if($condtn_channel != ''){ ?>
        <input attr-table="channel" class="var-conditions-tags-channel" type="hidden" value="{!! $condtn_channel !!}">
    <?php } ?>
    <?php if($condtn_users != ''){ ?>
        <input attr-table="users" class="var-conditions-tags-users" type="hidden" value="{!! $condtn_users !!}">
    <?php } ?>
    <?php if($condtn_provinces != ''){ ?>
        <input attr-table="provinces" class="var-conditions-tags-provinces" type="hidden" value="{!! $condtn_provinces !!}">
    <?php } ?>
</div>
@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> 

<!-- FooTable -->
<script src="js/plugins/footable/footable.all.min.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<script>
function filter_statistic(){
    // get properties
    var var_properties = $('.var-properties').val();
    // get properties tags
    var var_properties_tags = $('.var-properties-tags').val();
    var var_properties_tags_table = $('.var-properties-tags').attr('attr-table');
    // get conditions tags
    var var_conditions_tags_channel = $('.var-conditions-tags-channel').val();
    var var_conditions_tags_provinces = $('.var-conditions-tags-provinces').val();
    var var_conditions_tags_customers = $('.var-conditions-tags-customers').val();
    var var_conditions_tags_users = $('.var-conditions-tags-users').val();

    var filter_date_start = '';
    var filter_date_end = '';

    <?php if(Request::input('filter-date-start') != ''){ ?>
        filter_date_start = '&filter-date-start=<?=Request::input('filter-date-start') ?>';
    <?php } ?>

    <?php if(Request::input('filter-date-end') != ''){ ?>
        filter_date_end = '&filter-date-end=<?=Request::input('filter-date-end') ?>';
    <?php } ?>
    

    var get_url = '';

    if(var_properties != ''){
        get_url = get_url + '?getby='+var_properties;
    }
    if(typeof var_properties_tags != 'undefined'){
        get_url = get_url + '&pr_tbl='+var_properties_tags_table+'&pr_tags='+var_properties_tags;
    }
    if(typeof var_conditions_tags_customers != 'undefined'){
        get_url = get_url + '&condtn_customers='+var_conditions_tags_customers;
    }
    if(typeof var_conditions_tags_channel != 'undefined'){
        get_url = get_url + '&condtn_channel='+var_conditions_tags_channel;
    }
    if(typeof var_conditions_tags_users != 'undefined'){
        get_url = get_url + '&condtn_users='+var_conditions_tags_users;
    }
    if(typeof var_conditions_tags_provinces != 'undefined'){
        get_url = get_url + '&condtn_provinces='+var_conditions_tags_provinces;
    }
    if(typeof var_properties != 'undefined'){
        window.location.replace("/system/statistic/sales/dashboard"+get_url+filter_date_start+filter_date_end);
    }
}

$(document).ready(function($) {

    // Choose Properties
    $('.filter_properties').click(function(){

        // Append Tags
        $('.append-tags-conditions').empty();
        $('.append-tags-conditions').hide();

        // Append Name & Var
        $('.append-name-properties').empty();
        $('.append-name-properties').append($(this).attr('attr-filter-properties'));

        // Append var properties
        $('.var-properties').remove();
        $('.append-variable-properties').append('<input class="var-properties" type="hidden" value="'+$(this).val()+'">');


        $('.append-tags-properties').empty();
        $('.append-tags-properties').hide();
        $('.properties_list input').attr('readonly', 'readonly');
        $('.properties_list select').attr('disabled', 'disabled');
        // Enable Properties
        $('.properties_'+($(this).val())+' input').attr("readonly", false);
        $('.properties_'+($(this).val())+' select').attr("disabled", false);

        filter_statistic();
    });

    $('.properties_list select').change(function(){
        if($(this).val() != -1){
            $('.append-tags-properties').show();
            $('.append-tags-properties').empty();
            $('.append-tags-properties').append('<span class="attr-properties tag label label-success">'+$("option:selected", this).attr("attr-name")+'<span class="tag-remove" data-role="remove"></span></span>');
        
            // Append var properties
            $('.var-properties-tags').remove();
            $('.append-variable-properties-tags').append('<input attr-table="'+$(this).attr('attr-table')+'" class="var-properties-tags" type="hidden" value="'+$(this).val()+'">');
            filter_statistic();
        }
    });

    $('.properties-list-conditions .conditions_channel').change(function(){
        if($(this).val() != -1){
            $('.attr-conditions-channel').remove();
            $('.append-tags-conditions').show();
            $('.append-tags-conditions').append('<span class="attr-conditions-channel tag label label-success">'+$("option:selected", this).attr("attr-name")+'<span class="tag-remove" data-role="remove"></span></span>');
        
            // Append var properties
            $('.var-conditions-tags-channel').remove();
            $('.append-variable-conditions-tags').append('<input attr-table="'+$(this).attr('attr-table')+'" class="var-conditions-tags-channel" type="hidden" value="'+$(this).val()+'">');
            filter_statistic();
        }
    });

    $('.properties-list-conditions .conditions_staff').change(function(){
        if($(this).val() != -1){
            $('.attr-conditions-staff').remove();
            $('.append-tags-conditions').show();
            $('.append-tags-conditions').append('<span class="attr-conditions-staff tag label label-success">'+$("option:selected", this).attr("attr-name")+'<span class="tag-remove" data-role="remove"></span></span>');
        
            // Append var properties
            $('.var-conditions-tags-users').remove();
            $('.append-variable-conditions-tags').append('<input attr-table="'+$(this).attr('attr-table')+'" class="var-conditions-tags-users" type="hidden" value="'+$(this).val()+'">');
            filter_statistic();
        }
    });

    $('.properties-list-conditions .conditions_provinces').change(function(){
        if($(this).val() != -1){
            $('.attr-conditions-provinces').remove();
            $('.append-tags-conditions').show();
            $('.append-tags-conditions').append('<span class="attr-conditions-provinces tag label label-success">'+$("option:selected", this).attr("attr-name")+'<span class="tag-remove" data-role="remove"></span></span>');
        
            // Append var properties
            $('.var-conditions-tags-provinces').remove();
            $('.append-variable-conditions-tags').append('<input attr-table="'+$(this).attr('attr-table')+'" class="var-conditions-tags-provinces" type="hidden" value="'+$(this).val()+'">');
            filter_statistic();
        }
    });

    //$('.tag').click(function(){ $(this).remove(); });
    $('.append-tags-properties').on('click', '.tag-remove', function() {
        $(this).parent('.attr-properties').remove();  
        $('.append-variable-properties-tags').empty();
        filter_statistic();
    });
    $('.append-tags-conditions').on('click', '.tag-remove', function() {
        if($(this).parent().hasClass('attr-conditions-customers')){
            $('.var-conditions-tags-customers').remove();
        }else if($(this).parent().hasClass('attr-conditions-channel')){
            $('.var-conditions-tags-channel').remove();
        }else if($(this).parent().hasClass('attr-conditions-users')){
            $('.var-conditions-tags-users').remove();
        }else if($(this).parent().hasClass('attr-conditions-provinces')){
            $('.var-conditions-tags-provinces').remove();
        }
        $(this).parent('.tag').remove();  
        filter_statistic();
    });
});

// Search Customer
    var engine = new Bloodhound({
        remote: {
            url: '/system/orders/get-customer-auto-complete?search-input-customer=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-customer'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $(".search-input-customer").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),
        name: 'usersList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+' <br>  '+ data.email +' <br>  '+ data.phone +'</div>'
            }
        },
        engine: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $('.attr-conditions-customer').remove();
        $('.append-tags-conditions').show();
        $('.append-tags-conditions').append('<span class="attr-conditions-customer tag label label-success">Khách hàng: '+selection.name+'<span class="tag-remove" data-role="remove"></span></span>');
    
        // Append var properties
        $('.var-conditions-tags-customers').remove();
        $('.append-variable-conditions-tags').append('<input attr-table="customers" class="var-conditions-tags-customers" type="hidden" value="'+selection.id+'">');
    
        filter_statistic();
    });

// Search Product
var engineProduct = new Bloodhound({
    remote: {
        url: '/system/orders/get-product-auto-complete?search-input-product=%QUERY%',
        wildcard: '%QUERY%'
    },
    datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-product'),
    queryTokenizer: Bloodhound.tokenizers.whitespace
});

engineProduct.initialize();

$(".search-input-product").typeahead({
    hint: true,
    highlight: true,
    minLength: 1
}, {
    source: engineProduct.ttAdapter(),
    name: 'productList',
    displayKey: 'name',
    templates: {
        empty: [
            '<div class="empty-message">Không tìm thấy kết quả</div>'
        ].join('\n'),   

        suggestion: function (data) {
            return '<div class="user-search-result">'+data.name+' <br>  Sku: '+ data.sku +' <br> Barcode:  '+ data.barcode +'</div>'
        }
    },
    engineProduct: Hogan
}).on('typeahead:selected', function(event, selection) {
    $('.append-tags-properties').show();
    $('.append-tags-properties').empty();
    $('.append-tags-properties').append('<span class="attr-properties tag label label-success">Sản phẩm: '+selection.name+'<span class="tag-remove" data-role="remove"></span></span>');
    // Append var properties
    $('.var-properties-tags').remove();
    $('.append-variable-properties-tags').append('<input attr-table="product" class="var-properties-tags" type="hidden" value="'+selection.id+'">');

    filter_statistic();
});

$('.filter-date-start').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function (e) {
    <?php if(Request::input('filter-date-start') == ''){ ?>
        window.open(window.location.href+'&filter-date-start='+($(this).val()), "_self");
    <?php }else{ ?>
        var strurl = window.location.href;
        var newurl = strurl.replace("&filter-date-start=<?=Request::input('filter-date-start')?>",'&filter-date-start='+($(this).val()));
        window.location.href = newurl;
    <?php } ?>
});

$('.filter-date-end').datepicker({
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true,
    format: 'yyyy-mm-dd',
}).on('changeDate', function (e) {
    <?php if(Request::input('filter-date-end') == ''){ ?>
        window.open(window.location.href+'&filter-date-end='+($(this).val()), "_self");
    <?php }else{ ?>
        var strurl = window.location.href;
        var newurl = strurl.replace("&filter-date-end=<?=Request::input('filter-date-end')?>",'&filter-date-end='+($(this).val()));
        window.location.href = newurl;
    <?php } ?>
});


</script>

@stop
