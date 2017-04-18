@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="col-md-12">
            <h2><i class="fa fa-th-list "></i> Chi tiêt đơn hàng: {!! $order['code'] !!} </h2>
            <div style="margin-top: 10px;margin-bottom: 0px;">
                Trạng thái đơn hàng: {!! getUrlOrderDetails($order['id'],$order['status'],$order['order_status']) !!}
                <?php if($order['order_status'] == 0 || $order['order_status'] == 2){ ?>
                    &nbsp  
                    <i class="fa fa-angle-right"></i> Trạng thái thanh toán: {!! getPaymentStatus($order['order_status'],$order['payment_status']) !!}
                    <?php if($order['order_status'] != 3 && $order['order_status'] != 4){ ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
@stop            

@section('content')
<div class="row">
    <div class="col-lg-12 animated fadeInRight"> 
        @if (count($errors) > 0)
        <div class="ibox-content">
            <div class="alert alert-danger" style="margin-bottom:0px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        @if (Session::has('flash_message'))
            <div class="ibox-content">
                <div class="alert alert-success"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_message') !!}
                </div>
            </div>
        @endif

        @if (Session::has('flash_error'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_error') !!}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="block-content">
                    <div class="tab-wrap" style="border-bottom: 1px solid #e7eaec;">
                        <span>
                            <?php if($order['order_status'] == 0){ ?>
                            <form action="{!! route('admin.orders.getDetailsVirtual',$id) !!}" class="form-horizontal" method="POST" style="float: right;margin-left: 10px;">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
                                <button type="submit" class="btn lb-sm-refresh formvirtual"  data-toggle="tooltip" data-placement="bottom" data-original-title="Xác nhận xử lý với các đơn hàng ảo trên hệ thống, spam, đơn hàng này sẽ bị xoá khỏi hệ thống cũng như thông tin khách hàng của đơn hàng này!">
                                    <i class="fa fa-trash"></i> Đơn hàng ảo
                                </button>
                            </form>
                            <?php } ?>

                            <?php if($order['order_status'] == 0 || $order['order_status'] == 2){ ?>
                            <form action="{!! route('admin.orders.getDetailsCancel',$id) !!}" class="form-horizontal" method="POST" style="float: right;margin-left: 10px;">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
                                <button type="submit" class="btn lb-sm-refresh formcancel"  data-toggle="tooltip" data-placement="bottom" data-original-title="Xác nhận xử lý huỷ đơn hàng với các đơn hàng không liên hệ được với khách hàng, khách hàng không mua..!">
                                    <i class="fa fa-times"></i> Huỷ đơn hàng
                                </button>
                            </form>
                            <?php } ?>


                            <?php if($order['order_status'] == 0){ ?>
                                <form action="{!! route('admin.orders.getDetailsDelivered',$id) !!}" class="form-horizontal" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="text-right"> 
                                    <div class="text-right">
                                        <button type="submit" class="btn lb-sm-refresh formdelivery"><i class="fa fa-truck"></i> Giao hàng</button>
                                    </div>
                                </div>
                                </form>
                            <?php } ?>

                            <?php if($order['lading_status'] == 2 && $order['order_status'] !=6 ){ ?>
                                <div class="text-right"> 
                                    <div class="text-right">
                                        <a href="system/return-product/processing?order-code={!! $order['code'] !!}" class="btn lb-sm-cancel"><i class="fa fa-retweet"></i> Trả hàng</a>
                                    </div>
                                </div>
                            <?php } ?>

                        </span>
                    </div>

                    <div class="tab-wrap" style="border-bottom: 1px solid #e7eaec;">
                        <!--<div class="tab-tag">
                            <a class="lb-sm-delivery">Cập nhật trạng thái xử lý vận đơn</a>
                        </div>-->
                        <?php if($order['order_status'] == 2 && ( $order['lading_status'] == 0 || $order['lading_status'] == 1 )){ ?>
                        <div style="text-align:center;">
                            <a style="margin:10px 0px;font-size:15px;" type="submit" data-toggle="modal" data-target="#delivery_info" class="btn btn-xs lb-text-link">
                                <i class="fa fa-pencil"></i> Cập nhật thông tin giao hàng
                            </a>
                        </div>
                        <?php } ?>
                        <?php if( $order['order_status'] == 2 && $order['lading_code'] != NULL ){ ?>
                        <span style="text-align:center;border-top: solid 1px #e7eaec;">

                            <?php if($order['lading_status'] == 0){ ?>
                                <button type="submit" attr-value="0" class="lb-sm-refresh <?=($order['lading_status'] == 0)?'lb-sm-waiting':'';?> btn">
                                    <i class="fa fa-clock-o"></i> Chờ xử lý
                                </button>
                            <?php }else{ ?>
                                <button type="submit" attr-value="0" class="lb-sm-refresh btn" style="color: #cccccc;">
                                    <i class="fa fa-clock-o"></i> Chờ xử lý
                                </button>
                            <?php } ?>

                            &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;

                            <?php if($order['lading_status'] == 1){ ?>
                                <button type="submit" attr-value="1" class="lb-sm-waiting btn">
                                    <i class="fa fa-cubes"></i> Lấy hàng
                                </button>
                            <?php }elseif($order['lading_status'] == 0){ ?>
                                <button type="submit" data-toggle="modal" data-target="#delivery_print" class="lb-sm-refresh btn">
                                    <i class="fa fa-cubes"></i> Lấy hàng
                                </button>
                            <?php }else{?>
                                <button type="submit" class="lb-sm-refresh btn" style="color: #cccccc;">
                                    <i class="fa fa-cubes"></i> Lấy hàng
                                </button>
                            <?php } ?>

                            &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;

                            <?php if($order['lading_status'] == 2){ ?>
                                <button type="submit" attr-value="2" class="lb-sm-delivery btn ">
                                    <i class="fa fa-truck"></i> Đang giao hàng
                                </button>
                            <?php }else{ ?>
                                <button type="submit" attr-value="2" class="lb-sm-refresh btn" style="color: #cccccc;">
                                    <i class="fa fa-truck"></i> Đang giao hàng
                                </button>
                            <?php } ?>

                            &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;

                            <?php if($order['lading_status'] == 3){ ?>
                                <button type="submit" attr-value="3" class="lb-sm-success btn">
                                    Đã giao hàng
                                </button>
                            <?php }elseif($order['lading_status'] == 2){ ?>
                                <button type="submit" attr-value="3" class="lb-sm-refresh btn btn-lading-update">
                                    Đã giao hàng
                                </button>
                            <?php }else{ ?>
                                <button type="submit" attr-value="3" class="lb-sm-refresh btn" style="color: #cccccc;">
                                    Đã giao hàng
                                </button>
                            <?php } ?>

                            <?php if($order['lading_status'] == 3 && $order['payment_status'] == 1){ ?>
                                &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;
                                <button type="submit" class="lb-sm-success btn">
                                    Đã thanh toán
                                </button>
                            <?php }elseif($order['lading_status'] == 3 && $order['payment_status'] == 2){ ?>
                                &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;
                                <button type="submit" attr-value="1" class="lb-sm-refresh btn btn-payment-update">
                                    Đã thanh toán
                                </button>
                            <?php } ?>

                            <?php if($order['lading_status'] == 3 && $order['payment_status'] == 1){ ?>
                            &nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;&nbsp;
                            <form action="{!! route('admin.orders.getDetailsSuccess',$id) !!}" class="form-horizontal" method="POST" style="display: -webkit-inline-box;">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
                                <input type="hidden" name="lading_status" value="{!! $order['lading_status'] !!}">   
                                <input type="hidden" name="payment_status" value="{!! $order['payment_status'] !!}">   
                                <button type="submit" class="btn lb-sm-refresh formsuccess" data-toggle="tooltip" data-placement="bottom" data-original-title="Xác nhận xử lý đơn hàng thành công với các đơn hàng đã thu tiền của khách hàng và khách hàng đã nhận được hàng!">
                                    <i class="fa fa-check"></i> Thành công
                                </button>
                            </form>   
                            <?php } ?>

                        </span>
                        <?php } ?>
                    </div>

                    <div class="tab-wrap">
                        <span> 
                            Thông tin đơn hàng
                            <button type="submit" data-toggle="modal" data-target="#history_order" class="btn btn-xs lb-text-link" style="float:right;">
                                Xem lịch sử đơn hàng
                            </button>
                            <button type="submit" data-toggle="modal" data-target="#note_order" class="btn btn-xs lb-text-link" style="float:right;">
                                <i class="fa fa-pencil"></i> Thông tin ghi chú &nbsp&nbsp/&nbsp&nbsp  
                            </button>
                        </span>
                    </div>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12 m-b-lg m-t-lg">
                                    <div class="col-md-4">
                                        <div class="profile-image-order" style="text-align:center;">
                                            <i style="font-size:50px;" class="fa fa-user"></i>
                                        </div>
                                        <div class="profile-info-order">
                                            <div class="">
                                                <div>
                                                    <h2 class="no-margins">
                                                        {!! $customer['name'] !!}
                                                    </h2>

                                                    <?php if($order['order_status'] == 0 || $order['order_status'] == 2){ ?>
                                                    <p style="margin-top:5px;">
                                                        <i class="fa fa-phone"></i> Trạng thái liên lạc: 
                                                        <button class="btn btn-default btn-circle btn-circle-fix btn-called-customer btn-call-customer" attr-value="1" data-toggle="tooltip" data-placement="bottom" type="button" data-original-title="Lần gần nhất đã liên lạc được với khách hàng" <?=($order['call_status'] == 1)?'style="background-color: #e5f2ce!important;color:black;"':'';?>>
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                        <button class="btn btn-default btn-circle btn-circle-fix btn-not-called-customer btn-call-customer" attr-value="2" data-toggle="tooltip" data-placement="bottom" type="button" data-original-title="Lần gần nhất đã gọi điện / liên lạc với khách hàng nhưng khách hàng không nghe máy / chưa gặp được khách hàng" <?=($order['call_status'] == 2)?'style="background-color: #ffced3!important;color:black;"':'';?>>
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </p>
                                                    <?php } ?>

                                                    <?php if($order['order_status'] == 0 || $order['order_status'] == 2){ ?>
                                                    <p style="margin-top:5px;">
                                                        <button type="submit" data-toggle="modal" data-target="#customer_info" class="btn btn-xs lb-text-link"  >
                                                            <i class="fa fa-pencil"></i> Cập nhật thông tin khách hàng
                                                        </button>
                                                    </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table m-b-xs">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <strong>Email:</strong> {!! $customer['email'] !!}
                                                </td>
                                                <td>
                                                    <strong>Tỉnh thành:</strong> {!! $provinces_name_customer['name'] !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Phone:</strong> {!! $customer['phone'] !!}
                                                </td>
                                                <td>
                                                    <strong>Quận huyện:</strong> {!! $districts_name_customer['name'] !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <strong>Phương thức thanh toán:</strong> {!! $payment_method_name_order['name'] !!}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <?//php if($order['order_status'] == 0){ ?>
                            <div class="row">
                                <div class="col-lg-12 m-b-lg m-t-lg">
                                    <div class="col-md-4">
                                        <div class="profile-image-order" style="text-align:center;">
                                            <i style="font-size:50px;" class="fa fa-truck"></i>
                                        </div>
                                        <div class="profile-info-order">
                                            <div class="">
                                                <div>
                                                    <h2 class="no-margins">
                                                        Thông tin giao hàng
                                                    </h2>
                                                    <p style="margin-top:5px;">
                                                        <span type="submit" data-toggle="modal" data-target="#customer_receiver-address" class="btn btn-xs lb-text-link">
                                                            <i class="fa fa-pencil"></i> Cập nhật địa chỉ giao hàng
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table m-b-xs">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>Tỉnh thành:</strong> {!! $provinces_name_receiver['name'] !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>Quận huyện:</strong> {!! $districts_name_receiver['name'] !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>Địa chỉ giao hàng:</strong> 
                                                        <?php 
                                                        if($order['receiver_address'] != ''){
                                                            echo $order['receiver_address'];
                                                        }elseif($customer['address'] != ''){
                                                            echo $customer['address'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <?//php } ?>

                            <div class="row">
                                <div class="col-lg-12 m-b-lg m-t-lg">
                                    <div class="col-md-4">
                                        <div class="profile-image-order" style="text-align:center;">
                                            <i style="font-size:40px;" class="fa fa-th-list"></i>
                                        </div>
                                        <div class="profile-info-order">
                                            <div class="">
                                                <div>
                                                    <h2 class="no-margins">
                                                        Chi tiết đơn hàng
                                                    </h2>
                                                    <?php if($order['order_status'] == 0 || ( $order['order_status'] == 2 && ( $order['lading_status'] == 0 || $order['lading_status'] == 1 ))){ ?>
                                                    <p style="margin-top:5px;">
                                                        <span type="submit" data-toggle="modal" data-target="#update_orders_details" class="btn btn-xs lb-text-link">
                                                            <i class="fa fa-pencil"></i> Cập nhật chi tiết đơn hàng
                                                        </span>
                                                    </p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table invoice-table">
                                            <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá bán</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $total_price = 0;foreach($order_details as $key => $value){ ?>
                                                <tr>
                                                    <td>
                                                        <div><strong>{!! $value['name'] !!}</strong></div>
                                                    <td>{!! $value['quantity'] !!}</td>
                                                    <td>{!! number_format($value['price']) !!}</td>
                                                    <td>{!! number_format($value['price'] * $value['quantity']) !!}</td>
                                                </tr>
                                                <?php $total_price = $total_price + ($value['price'] * $value['quantity']); } ?>
                                            </tbody>
                                        </table>
                                        <table class="table invoice-total" style="padding:0px 30px;">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Tổng giá trị đơn hàng :</strong></td>
                                                    <td>{!! number_format($total_price) !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="customer_receiver-address" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-truck modal-icon"></i>
                    <h4 class="modal-title"></i> Cập nhật địa chỉ giao hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" class="form-horizontal">
                                <?php
                                    $cur_provinces = 0;
                                    if($order['receiver_provinces'] != 0){
                                        $cur_provinces = $order['receiver_provinces'];
                                    }else{
                                        $cur_provinces = $customer['province_id'];
                                    }

                                    $cur_districts = 0;
                                    if($order['receiver_districts'] != 0){
                                        $cur_districts = $order['receiver_districts'];
                                    }else{
                                        $cur_districts = $customer['district_id'];
                                    }

                                    $cur_address = '';
                                    if($order['receiver_address'] != ''){
                                        $cur_address = $order['receiver_address'];
                                    }else{
                                        $cur_address = $customer['address'];
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Tỉnh thành</label>
                                    <div class="col-lg-9">
                                        <select class="form-control receiver-order-provinces" style="width:100%;">
                                            <option value="">-- Tỉnh thành --</option>
                                            <?php foreach($provinces as $item){ ?>
                                                <option <?=($cur_provinces == $item->id)?'selected':'';?> value="<?=$item->id?>">-- <?=$item->name?> --</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Quận huyện</label>
                                    <div class="col-lg-9">
                                        <select class="form-control receiver-order-districts" style="width:100%;">
                                            <option value="0">-- Quận huyện --</option>
                                            <?php foreach($districts_receiver_order as $item){ ?>
                                                <option <?=($cur_districts == $item->id)?'selected':'';?> value="<?=$item->id?>">-- <?=$item->name?> --</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Địa chỉ nhận hàng</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control receiver-order-address" style="width:100%;resize: none;" placeholder=" Địa chỉ" type="text">{!! $cur_address !!}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary update-receiver-address">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="customer_info" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-user modal-icon"></i>
                    <h4 class="modal-title">Cập nhật thông tin khách hàng</h4>
                </div>
                <div class="modal-body">
                    <table class="table shoping-cart-table">
                        <tbody>
                            <input type="hidden" class="fill-cus-id" value="0">
                            <tr>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <input class="form-control fill-cus-name" style="width:100%;" placeholder=" Nhập tên khách hàng" type="text" value="{!! $customer['name'] !!}">
                                    </div>                  
                                </td>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <input class="form-control fill-cus-email" style="width:100%;" placeholder=" Nhập địa chỉ Email" type="text" value="{!! $customer['email'] !!}">
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <input readonly class="form-control fill-cus-phone" style="width:100%;" placeholder=" Nhập số điện thoại" type="text" value="{!! $customer['phone'] !!}">
                                    </div> 
                                </td>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                         <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input class="form-control fill-cus-birthdate" style="width:100%;" type="text" placeholder=" Ngày tháng năm sinh" value="<?php if(!is_null($customer['birthdate']) && $customer['birthdate'] != '0000-00-00 00:00:00'){ echo date('Y/m/d', strtotime($customer['birthdate'])); } ?>">
                                        </div>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <select class="form-control fill-cus-gender" style="width:100%;">
                                            <option value="-1">-- Giới tính --</option>
                                            <option <?=($customer['gender'] == 1)?'selected':'';?> value="1">-- Nam --</option>
                                            <option <?=($customer['gender'] == 0)?'selected':'';?> value="0">-- Nữ --</option>
                                        </select>
                                    </div> 
                                </td>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <select class="form-control fill-cus-provinces" style="width:100%;">
                                            <option value="">-- Tỉnh thành --</option>
                                            <?php foreach($provinces as $item){ ?>
                                                <option <?=($customer['province_id'] == $item->id)?'selected':'';?> value="<?=$item->id?>">-- <?=$item->name?> --</option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <textarea class="form-control fill-cus-address" style="width:100%;resize: none;" placeholder=" Địa chỉ" type="text">{!! $customer['address'] !!}</textarea>
                                    </div> 
                                </td>
                                <td style="width:50%;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <select class="form-control fill-cus-districts" style="width:100%;">
                                            <option value="0">-- Quận huyện --</option>
                                            <?php foreach($districts_customer as $item){ ?>
                                                <option <?=($customer['district_id'] == $item->id)?'selected':'';?> value="<?=$item->id?>">-- <?=$item->name?> --</option>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary btn-customer-update">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="history_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-history modal-icon"></i>
                    <h4 class="modal-title">Lịch sử đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="ibox">
                        <div class="ibox-content inspinia-timeline">
                            <?php $i=1;?>
                            @foreach($data_order_processing as $row)
                                <div class="timeline-item">
                                    <div class="row">
                                        <div class="col-xs-3 date">
                                            <?php 
                                            if($row->status == 1 && $row->order_status == 0 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background:#ffe3c6;" class="fa fa-hand-o-up"></i>';
                                            }
                                            if($row->status == 1 && $row->order_status == 1 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i class="fa fa-file-text-o"></i>';
                                            }

                                            if($row->status == 1 && $row->order_status == 2 && $row->lading_status == 0 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #ccebff;" class="fa fa-truck"></i>';
                                            }

                                            if($row->status == 1 && $row->order_status == 2 && $row->lading_status == 1 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #ffe3c6;" class="fa fa-truck"></i>';
                                            }

                                            if($row->status == 1 && $row->order_status == 2 && $row->lading_status == 2 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #ccebff;" class="fa fa-truck"></i>';
                                            }

                                            if($row->status == 1 && $row->order_status == 2 && $row->lading_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #e5f2ce;" class="fa fa-truck"></i>';
                                            }

                                            if($row->status == 1 && $row->order_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #e5f2ce;" class="fa fa-check"></i>';
                                            }

                                            if($row->status != 1 && $row->order_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #e5f2ce;" class="fa fa-check"></i>';
                                            }

                                            if($row->status != 1 && $row->order_status == 4 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="background: #ffced3;" class="fa fa-times"></i>';
                                            }

                                            if($row->status != 1 && $row->order_status == 5 && $row->call_status == 0 && $row->note == NULL){
                                                echo '<i style="" class="fa fa-times"></i>';
                                            }

                                            if($row->status == 1 && $row->call_status == 1 && $row->note == NULL){
                                                echo '<i style="background: #e5f2ce;" class="fa fa-phone"></i>';
                                            }

                                            if($row->status == 1 && $row->call_status == 2 && $row->note == NULL){
                                                echo '<i style="background: #ffced3;" class="fa fa-phone"></i>';
                                            }
                                            if($row->note != NULL){
                                                echo '<i style="" class="fa fa-refresh"></i>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xs-11 content">
                                            <p class="m-b-xs"><strong>{!! $row->username !!}</strong></p>
                                            <small>{!! $row->processing_created_at !!}</small>
                                            <p>
                                            <?php 
                                            if($row->status == 1 && $row->order_status == 0 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Tạo đơn hàng, cập nhật trạng thái đơn hàng chờ duyệt';
                                            }
                                            if($row->status == 1 && $row->order_status == 1 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Duyệt đơn hàng';
                                            }

                                            if($row->status == 1 && $row->order_status == 2  && $row->lading_status == 0 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng sang hệ thống vận đơn';
                                            }

                                            if($row->status == 1 && $row->order_status == 2  && $row->lading_status == 1 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng trạng thái Đợi lấy hàng';
                                            }

                                            if($row->status == 1 && $row->order_status == 2  && $row->lading_status == 2 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng trạng thái Đang giao hàng';
                                            }

                                            if($row->status == 1 && $row->order_status == 2   && $row->lading_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng trạng thái Đã giao hàng';
                                            }

                                            if($row->status == 1 && $row->order_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Tạo đơn hàng, cập nhật xử lý trạng thái đơn hàng thành công';
                                            }

                                            if($row->status != 1 && $row->order_status == 3 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng thành công';
                                            }

                                            if($row->status != 1 && $row->order_status == 4 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật huỷ đơn hàng';
                                            }

                                            if($row->status != 1 && $row->order_status == 5 && $row->call_status == 0 && $row->note == NULL){
                                                echo 'Cập nhật đơn hàng ảo';
                                            }

                                            if($row->status == 1 && $row->call_status == 1 && $row->note == NULL){
                                                echo 'Liên lạc được với khách hàng';
                                            }
                                            if($row->status == 1 && $row->call_status == 2 && $row->note == NULL){
                                                echo 'Liên lạc với khách hàng nhưng khách hàng không nghe máy';
                                            }
                                            if($row->note != NULL){
                                                echo $row->note;
                                            }
                                            ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                             <?php $i++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="delivery_info" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated">
                <form action="{!! route('admin.orders.createInfoDelivery',$order['id']) !!}" method="POST" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title"><i class="fa fa-truck"></i> Thông tin giao hàng</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <input type="hidden" name="order_id" value="{!! $order['id'] !!}">
                        <div class="form-group">
                            <label>Mã vận đơn</label>
                            <input name="lading_code" type="text" class="form-control" value="{!! $order['lading_code'] !!}">
                        </div>
                        <?php
                        if($order['cod_price'] > 0){
                            $cod_price = $order['cod_price'];
                        }else{
                            $cod_price = $order['total_price'];
                        }
                        ?>
                        <div class="form-group">
                            <label>Số tiền thu hộ (COD)</label>
                            <input name="cod_price" type="text" class="form-control cod_price" value="{!! $cod_price !!}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="note_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-pencil modal-icon"></i>
                    <h4 class="modal-title"></i> Ghi chú đơn hàng</h4>
                    <small class="font-bold">Ghi chú sẽ được lưu vào lịch sử đơn hàng</small>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Ghi chú</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control order-note" style="width:100%;resize: none;" placeholder=" Ghi chú" type="text"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary update-order-note">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="update_orders_details" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-th-list modal-icon"></i>
                    <h4 class="modal-title">Cập nhật chi tiết đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group" style="width:100%;">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" name="search-input-product" class="form-control search-input-product"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm sản phẩm theo tên, mã sản phẩm, barcode..">
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow-x: inherit;">
                        <table class="table shoping-cart-table">
                            <thead>
                                <tr>
                                    <th width="220">Tên sản phẩm</th>
                                    <th width="70">Số lượng</th>
                                    <th width="120">Giá bán</th>
                                    <th width="120">Thành tiền</th>
                                    <th width="120" class="text-right" width="">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="append_product">
                                <?php $total_price = 0;foreach($order_details as $key => $value){ ?>
                                    <tr class="gradeX get_parent_<?=$value['product_id']?>">
                                        <input class="get_product_id form-control" type="hidden" value="<?=$value['product_id']?>">
                                        <td style="text-align:left;"><input readonly="" class="form-control" value="{!! $value['name'] !!}"></td>
                                        <td>
                                            <input id="quantity_suggest" class="product_quantity form-control" style="width:100%;" type="text" min="1" max="999" value="<?=$value['quantity']?>">
                                        </td>
                                        <td style="text-align:left;">
                                            <input readonly="" class="price_product form-control" value="{!! number_format($value['price']) !!}">
                                            <input type="hidden" class="get_price_product" value="{!! $value['price'] !!}">
                                        </td>
                                        <td style="text-align:left;">
                                            <input readonly="" class="line_total_price form-control" value="{!! number_format($value['price'] * $value['quantity']) !!}">
                                            <input class="get_line_total_price" type="hidden" value="{!! $value['price'] * $value['quantity'] !!}">
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" data-toggle="modal" data-href="" class="btn-danger btn btn-delete btn-delete-product">
                                                <i class="fa fa-trash "></i> Xoá</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $total_price = $total_price + ($value['price'] * $value['quantity']); } ?>
                                <tr class="gradeX" style="background: #fafafb;color: #131212;border-top: solid 1px #ffffff;">
                                    <td colspan="3" style="text-align:left;">
                                        <b style="margin: 5px 0px!important;display: -webkit-inline-box;color: #6d889c;">Tổng giá trị đơn hàng (vnđ)</b>
                                    </td>
                                    <td colspan="2">
                                        <input readonly class="order_total_price form-control" style="width: 100%;border: none;color: #ed5565;font-weight: 600;background: #fafafb;" type="text" value=" {!! number_format($total_price) !!}"> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary btn-order-update">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="delivery_print" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-truck modal-icon"></i>
                    <h4 class="modal-title">Đơn hàng - {!! $order['code'] !!}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <a onclick="delivery_print()"><i class="fa fa-print"></i> In thông tin vận đơn</a> <br>
                        <div class="col-lg-12 form-horizontal table-zip">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-8">
                                         <select name="export_warehouse" class="form-control export_warehouse" style="width:100%;margin: 15px 0px 0px 0px;">
                                            <option value="0">-- Chọn kho xuất hàng --</option>
                                            <?php foreach($warehouse as $key=>$value){ ?>
                                                <option value="{!! $value->id !!}">-- {!! $value->name !!} --</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <a attr-value="2" class="btn btn-lading-update" style="margin-top: 15px;display: -webkit-inline-box;border: solid 1px #e5e6e7;background: #fff;">
                                                <i class="fa fa-truck"></i> Xác nhận lấy hàng
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="content_print">
                            <a style="margin-bottom: 10px;display: block;">
                                <strong class="ng-binding"><!-- Người nhận: -->Mã vận đơn: {!! $order['lading_code'] !!}</strong>
                            </a>
                            <p>
                                <i class="fa fa-user"></i>  <strong class="ng-binding"><!-- Người nhận: -->Người nhận( khách hàng): {!! $customer['name'] !!}</strong>
                            </p>
                            <p class="ng-binding">
                                <i class="fa fa-map-marker"></i>  <strong>Tỉnh thành:</strong> {!! $provinces_name_receiver['name'] !!} <br>
                                <i class="fa fa-map-marker"></i>  <strong>Quận huyện:</strong> {!! $districts_name_receiver['name'] !!} <br>
                                <i class="fa fa-map-marker"></i>  <strong>Địa chỉ nhận hàng:</strong> 
                                <?php 
                                if($order['receiver_address'] != ''){
                                    echo $order['receiver_address'];
                                }elseif($customer['address'] != ''){
                                    echo $customer['address'];
                                }
                                ?>
                            </p>
                            <i class="fa fa-phone"></i> <strong>Số điện thoại:</strong> {!! $customer['phone'] !!}<br>
                        </div>
                    </div>

                    <div class="table-responsive table_print" style="overflow-x: inherit;">
                        <table class="table shoping-cart-table">
                            <thead>
                                <tr>
                                    <th width="220">Tên sản phẩm</th>
                                    <th width="70">Số lượng</th>
                                    <th width="120">Giá bán</th>
                                    <th width="120">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="append_product">
                                <?php $total_price = 0;foreach($order_details as $key => $value){ ?>
                                    <tr class="gradeX get_parent_<?=$value['product_id']?>">
                                        <td style="text-align:left;"><input readonly="" class="form-control" value="{!! $value['name'] !!}"></td>
                                        <td>
                                            <input readonly id="quantity_suggest" class="product_quantity form-control" style="width:100%;" type="text" min="1" max="999" value="<?=$value['quantity']?>">
                                        </td>
                                        <td style="text-align:left;">
                                            <input readonly class="price_product form-control" value="{!! number_format($value['price']) !!}">
                                        </td>
                                        <td style="text-align:left;">
                                            <input readonly class="line_total_price form-control" value="{!! number_format($value['price'] * $value['quantity']) !!}">
                                        </td>
                                    </tr>
                                <?php $total_price = $total_price + ($value['price'] * $value['quantity']); } ?>
                                <tr class="gradeX" style="background: #fafafb;color: #131212;border-top: solid 1px #ffffff;">
                                    <td colspan="3" style="text-align:left;">
                                        <b style="margin: 5px 0px!important;display: -webkit-inline-box;color: #6d889c;">Tổng giá trị đơn hàng (vnđ)</b>
                                    </td>
                                    <td colspan="2">
                                        <input readonly class="order_total_price form-control" style="width: 100%;border: none;color: #ed5565;font-weight: 600;background: #fafafb;" type="text" value=" {!! number_format($total_price) !!}"> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<meta name="csrf-token" content="{{ csrf_token() }}" />

@stop

@section('script')

<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>
<script src="js/jquery.number.js"></script>
<script src="js/bootstrap-confirmation.js"></script>

<script type="text/javascript">

jQuery(document).ready(function($) {
    // Search Customer
    var engine = new Bloodhound({
        remote: {
            url: '/get-customer-auto-complete?search-input-customer=%QUERY%',
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
                return '<div class="user-search-result"><i class="fa fa-user"></i> '+data.name+' ---- <i class="fa fa-envelope"></i>  '+ data.email +' ---- <i class="fa fa-phone"></i>  '+ data.phone +'</div>'
            }
        },
        engine: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $('.fill-cus-id').val(selection.id);
        $('.fill-cus-name').val(selection.name);
        $('.fill-cus-email').val(selection.email);
        $('.fill-cus-phone').val(selection.phone);
        $('.fill-cus-address').val(selection.address);
        $('.fill-cus-gender').val(selection.gender);
        $('.fill-cus-provinces').val(selection.province_id);
        $('.fill-cus-birthdate').val(selection.birthdate);
    });


    // Search Product
    var engineProduct = new Bloodhound({
        remote: {
            url: '/get-product-auto-complete?search-input-product=%QUERY%',
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
                return '<div class="user-search-result">'+data.name+' <br>  Sku: '+ data.sku +'</div>'
            }
        },
        engineProduct: Hogan
    }).on('typeahead:selected', function(event, selection) {
        var str_product='<tr class="gradeX get_parent_'+selection.id+'"><input class="get_product_id form-control" type="hidden" value="'+ selection.id +'"/><td style="text-align:left;"><input readonly class="form-control" value="'+ selection.name +'"></input></td><td><input id="quantity_suggest" class="product_quantity form-control" style="width:100%;" type="text" min="1" max="999" value="1"></td><td style="text-align:left;"><input readonly class="price_product form-control" value="'+ $.number(selection.price) +'" /><input type="hidden" class="get_price_product" value="'+ selection.price +'" /></td><td style="text-align:left;"><input readonly class="line_total_price form-control" value="'+ $.number(selection.price) +'"/><input class="get_line_total_price" type="hidden" value="'+ selection.price +'"/></td><td><div class="btn-group"><a href="#" data-toggle="modal" data-href="" class="btn-danger btn btn-delete btn-delete-product"><i class="fa fa-trash "></i> Xoá</a></div></td>';

        if(!$('.append_product tr').hasClass('get_parent_'+selection.id)){
            $('.append_product').prepend(str_product);
            // SET TOTAL PRICE
            total_price = 0;
            $( ".append_product tr .get_line_total_price" ).each(function( index ) {
                total_price  = parseInt(total_price)      + parseInt($(this).val());
            });
            $(".order_total_price").val($.number(total_price));    
        }
    });

    $('.append_product').on('keyup', '.product_quantity', function() {
        quantity = $(this).val();
        product_id = $(this).parent();
        price_product = $(this).parent().parent().children().children('.get_price_product').val();
        $(this).parent().parent().children().children('.line_total_price').val($.number(quantity * price_product));
        $(this).parent().parent().children().children('.get_line_total_price').val(quantity * price_product);

        total_price = 0;
        $( ".append_product tr .get_line_total_price" ).each(function( index ) {
            total_price  = parseInt(total_price) + parseInt($(this).val());
        });
        $(".order_total_price").val($.number(total_price));    
    });

    // Thay đổi giá trị đơn hàng khi thay đổi số lượng sản phẩm
    $('.append_product').on('click', '.btn-delete-product', function() {
        $(this).parent().parent().parent('tr').remove();
        total_price = 0;
        $( ".append_product tr .get_line_total_price" ).each(function( index ) {
            total_price  = parseInt(total_price) + parseInt($(this).val());
        });
        $(".order_total_price").val($.number(total_price));    
    });

});

$('#delivery_info').on('keyup', '.cod_price', function() {
    if( parseInt($(this).val()) > <?=$cod_price?> ){
        $(this).val(0);
    }
});

$('[data-toggle="tooltip"]').tooltip();   

$('.fill-cus-birthdate').datepicker({
    todayBtn: "linked",
    format: "yyyy-mm-dd",
    keyboardNavigation: false,
    forceParse: false,
    calendarWeeks: true,
    autoclose: true
});

$('.btn-customer-update').on('click',function(e){            
    var customer_id = $('.fill-cus-id').val();
    var customer_name = $('.fill-cus-name').val();
    var customer_phone = $('.fill-cus-phone').val();
    var customer_email = $('.fill-cus-email').val();
    var customer_address = $('.fill-cus-address').val();
    var customer_birthdate = $('.fill-cus-birthdate').val();
    var customer_gender = $('.fill-cus-gender').val();
    var customer_provinces = $('.fill-cus-provinces').val();
    var customer_districts = $('.fill-cus-districts').val();

    if(customer_phone == ""){
        alert("Số điện thoại khách hàng không được để trống!");
        return false;
    }

    token = $('meta[name="csrf-token"]').attr('content');

    var conf = confirm("Bạn có muốn cập nhật lại thông tin khách hàng không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-customer',
            data:{
                _token: token,
                customer_id : customer_id,
                customer_name : customer_name,
                customer_phone : customer_phone,
                customer_email : customer_email,
                customer_address : customer_address,
                customer_birthdate : customer_birthdate,
                customer_gender : customer_gender,
                customer_provinces : customer_provinces,
                customer_districts : customer_districts,
                order_id: <?=$order['id']?>,
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
});

$(".btn-call-customer").click(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    var call_status = $(this).attr('attr-value');

    var conf = confirm("Bạn có muốn cập nhật trạng thái liên lạc với khách hàng không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-call-status',
            data:{
                _token: token,
                order_id:<?=$order['id']?>,
                call_status:call_status
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
}); 

$(".update-receiver-address").click(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    var receiver_provinces = $('.receiver-order-provinces').val();
    var receiver_districts = $('.receiver-order-districts').val();
    var receiver_address = $('.receiver-order-address').val();

    var conf = confirm("Bạn có muốn cập nhật địa chỉ nhận hàng không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-receiver-order',
            data:{
                _token: token,
                receiver_provinces : receiver_provinces,
                receiver_districts : receiver_districts,
                receiver_address : receiver_address,
                order_id: <?=$order['id']?>,
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
});

$(".formsuccess").click(function(event) {
    if( !confirm('Bạn có muốn xác nhận đơn hàng thành công không?') ) 
        event.preventDefault();
});

$(".formcancel").click(function(event) {
    if( !confirm('Bạn có muốn huỷ đơn hàng này không?') ) 
        event.preventDefault();
});

$(".formdelivery").click(function(event) {
    if( !confirm('Bạn có muốn chuyển sang hệ thống giao vận không?') ) 
        event.preventDefault();
});

$(".formvirtual").click(function(event) {
    if( !confirm('Bạn có muốn xoá đơn hàng này không, thông tin đơn hàng và khách hàng sẽ bị xoá khỏi hệ thống! ?') ) 
        event.preventDefault();
});

$('.btn-order-update').on('click',function(e){            

    var exitSubmit = false;

    var arrayProductId = {};
    if($( ".append_product tr" ).length <= 1){
        alert("Đơn hàng chưa có sản phẩm. Hãy thêm sản phẩm vào đơn hàng!");
        return false;
    }else{
        $( ".append_product tr" ).each(function( index ) {
            if($(this).children().children(".product_quantity").val() == 0){
                exitSubmit = true;
                return false;
            }else{
                arrayProductId[$(this).children(".get_product_id").val()] = $(this).children().children(".product_quantity").val();
            }
        });
    }    

    if (exitSubmit) {
        alert("Sản phẩm không được để trống hoặc số lượng sản phẩm bằng 0!");
        return false;
    }

    token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type:"POST",
        url:'update-order',
        data:{
            _token: token,
            product_id : arrayProductId, 
            order_id : <?=$order['id']?>
        },
        success:function(data){
            alert(data.msg);
            location.reload();
        }
    });
});

$(".btn-lading-update").click(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    var lading_status = $(this).attr('attr-value');

    // Check nếu giao hàng
    if(lading_status == 2){
        var export_warehouse = $('.export_warehouse').val();
        if(export_warehouse == 0){
            alert("Bạn chưa chọn kho xuất hàng!");
            return false;
        }
    }

    var conf = confirm("Bạn có muốn cập nhật trạng thái giao hàng không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-lading-status',
            data:{
                _token: token,
                order_id:<?=$order['id']?>,
                lading_status:lading_status,
                export_warehouse:export_warehouse
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }

});

$(".btn-payment-update").click(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    var payment_status = $(this).attr('attr-value');

    var conf = confirm("Bạn có muốn cập nhật trạng thái thanh toán không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-payment-status',
            data:{
                _token: token,
                order_id:<?=$order['id']?>,
                payment_status:payment_status,
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }

});

$('.fill-cus-provinces').change(function() {
    provinces_id = $('.fill-cus-provinces').val();
    token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:"POST",
        url:'load-districts',
        data:{
            _token: token,
            provinces_id : provinces_id
        },
        success:function(data){
            $('.fill-cus-districts').empty();
            $('.fill-cus-districts').append(data.strappend);
        }
    });
});

$('.receiver-order-provinces').change(function() {
    provinces_id = $('.receiver-order-provinces').val();
    token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:"POST",
        url:'load-districts',
        data:{
            _token: token,
            provinces_id : provinces_id
        },
        success:function(data){
            $('.receiver-order-districts').empty();
            $('.receiver-order-districts').append(data.strappend);
        }
    });
});


$(".update-order-note").click(function(){
    token = $('meta[name="csrf-token"]').attr('content');
    var order_note = $('.order-note').val();

    var conf = confirm("Bạn có muốn cập nhật ghi chú đơn hàng không?, thao tác này sẽ được lưu trong lịch sử xử lý đơn hàng!");
    if (conf == true) {
        $.ajax({
            type:"POST",
            url:'update-note-order',
            data:{
                _token: token,
                order_note : order_note,
                order_id: <?=$order['id']?>,
            },
            success:function(data){
                alert(data.msg);
                location.reload();
            }
        });
    } else {
        return false;
    }
}); 

function delivery_print() {
    //$('#delivery_print').print();
    var headerToPrint = $('#delivery_print .modal-header').html();
    var headerToPrintRe = headerToPrint.replace('<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>', ' ');
    var contentToPrint = $('#delivery_print .content_print').html();
    var tableToPrint = $('#delivery_print .table_print').html();
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+headerToPrintRe+contentToPrint+tableToPrint+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
}

</script>

@stop
