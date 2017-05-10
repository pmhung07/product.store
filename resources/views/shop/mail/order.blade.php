<!DOCTYPE html>
<html>
<head>
    <title>Thông báo đơn hàng của bạn</title>
</head>
<body style="font-family: tahoma, arial, sans-serif">
    <h1 style="text-transform: uppercase; text-align: center;">Thông tin đơn hàng</h1>
    <div style="text-align: center;">
        <p>Chào {{ $order->getCustomerEmail() }}!</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của <a href="http://{{ $_SERVER['SERVER_NAME'] }}/">{{ $_SERVER['SERVER_NAME'] }}</a></p>
        <p>Sau đây là thông tin đơn hàng của bạn</p>
    </div>

    @include('frontend/email/partials/content')
</body>
</html>