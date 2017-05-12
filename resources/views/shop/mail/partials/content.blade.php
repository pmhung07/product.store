<div style="margin: 30px 0 0 0;">
    <p style="background: #d80808; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">Mã đơn hàng: <span style="font-size: 25px;">{{ $order->getCode() }}</span></p>
</div>

<div style="margin: 30px 0 0 0;">
    <p style="background: #d80808; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">1. Thông tin đơn hàng</p>
</div>

<table width="100%;" style="border-spacing: 0; border-collapse: collapse;">
    <thead>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Trạng thái</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Ngày đặt</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Tên</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Liên lạc</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Email</th>
    </thead>
    <tbody>
        <tr>
            <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">Chờ xác nhận</td>
            <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $order->getCreatedAt() }}</td>
            <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $order->getCustomerName() }}</td>
            <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $order->getCustomerPhone() }}</td>
            <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $order->getCustomerEmail() }}</td>
        </tr>
    </tbody>
</table>

<div style="margin: 30px 0 0 0;">
    <p style="background: #d80808; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">2. Thông tin hành khách</p>
</div>
<table width="100%;" style="border-spacing: 0; border-collapse: collapse;">
    <thead>
        <th style="font-weight: bold; padding: 10px; border: 1px solid #ccc; background: #757575; color: #fff;">Tên khách hàng</th>
    </thead>
    <tbody>
        <tr>
            <td style="font-weight: bold; font-size: 20px; text-transform: uppercase; text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $order->getCustomerName() }}</td>
        </tr>
    </tbody>
</table>

<div style="margin: 30px 0 0 0;">
    <p style="background: #d80808; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">3. Thông tin đơn hàng</p>
</div>

<table class="table" style="width: 100%; margin-top: 0px; border-spacing: 0; border-collapse: collapse;">
    <thead>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Sản phẩm</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Đơn giá</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Số lượng</th>
        <th style="border: 1px solid #ccc; padding: 5px; background: #757575; color: #fff;">Tiền</th>
    </thead>
    <tbody>
        @foreach($orderDetail as $item)
            <tr>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">
                    <a href="">
                        <img src="">
                        <p>Tên sản phẩm</p>
                    </a>
                </td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">10.000</td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">1</td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">10.000</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" style="text-align: right; padding: 5px;">Tổng tiền</td>
            <td style="text-align: center; padding: 5px; font-weight: bold; font-size: 20px">{{ $order->presenter()->getTotalMoney() }} vnđ</td>
        </tr>
    </tbody>
</table>