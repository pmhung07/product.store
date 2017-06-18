<div style="margin: 30px 0 0 0;">
    <p style="background: #a0a0a0; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">Mã đơn hàng: <span style="font-size: 25px;">{{ $order->code }}</span></p>
</div>

<div style="margin: 30px 0 0 0;">
    <p style="background: #a0a0a0; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">2. Thông tin khách hàng</p>
</div>
<table width="100%;" style="border-spacing: 0; border-collapse: collapse;">
    <thead>
        <th style="text-align: left; border-bottom: 2px solid #ccc; padding: 10px;">Họ và tên</th>
        <th style="text-align: left; border-bottom: 2px solid #ccc; padding: 10px;">Email</th>
        <th style="text-align: left; border-bottom: 2px solid #ccc; padding: 10px;">Sđt</th>
    </thead>
    <tbody>
        <tr>
            <td style="padding: 10px;">{{ $order->customers->name }}</td>
            <td style="padding: 10px;">{{ $order->customers->email }}</td>
            <td style="padding: 10px;">{{ $order->customers->phone }}</td>
        </tr>
    </tbody>
</table>

<div style="margin: 30px 0 0 0;">
    <p style="background: #a0a0a0; color: #fff; margin: 0; padding: 10px; font-weight: bold; font-size: 20px; text-transform: uppercase;">3. Thông tin đơn hàng</p>
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
                    <a href="{{ $item->product->getUrl() }}">
                        <img src="http://{{ $_SERVER['SERVER_NAME'] . parse_image_url('sm_'.$item->product->image) }}">
                        <p>{{ $item->product->name }}</p>
                    </a>
                </td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ formatCurrency($item->price) }}</td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ formatCurrency($item->quantity) }}</td>
                <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ formatCurrency($item->total_price) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right; padding: 5px;">Tổng tiền</td>
            <td style="text-align: center; padding: 5px; font-weight: bold; font-size: 20px">{{ formatCurrency($order->total_price) }} vnđ</td>
        </tr>
    </tbody>
</table>