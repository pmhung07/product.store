@extends('shop/layout/default')

@section('content')
<div id="cart-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 back-top">
                <div style="background:#333;padding:10px 0;text-align:center;">
                    <span style="text-transform:uppercase;color:#fff;font-size:17px">Giỏ hàng của bạn</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @include('includes/flash-message')
    </div>

    <section id="content" style="margin:15px 0">
        <div class="container">
            <div class="row" id="cart">
                <div class="col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover">
                            <thead>
                                <th>Xóa</th>
                                <th>Ảnh</th>
                                <th>SP</th>
                                <th>Giá</th>
                                <th>SL</th>
                                <th>Tiền</th>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('shop.cart.delete', $item->rowId) }}" class="btn btn-xs btn-danger">x</a>
                                    </td>
                                    <td>
                                        <img src="http://product.hstatic.net/1000003969/product/xanh-la_20_108__small.jpg" height="50">
                                    </td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li><b>{{ $item->name }}</b></li>
                                            <li>Màu: Xanh</li>
                                            <li>Size: L</li>
                                        </ul>
                                    </td>
                                    <td>{{ formatCurrency($item->price) }}<sup>đ</sup></td>
                                    <td>
                                        <input type="number" value="{{ $item->qty }}" data-row_id="{{ $item->rowId }}" name="qty" min="1" max="100" class="qty form-control input-sm">
                                    </td>
                                    <td>{{ formatCurrency($item->qty * $item->price) }}<sup>đ</sup></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                    <td>Tổng tiền:</td>
                                    <td>
                                        <span>{{ Cart::subtotal(0, '.', '.') }}<sup>đ</sup></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="javascript:;" id="update-cart" class="btn-update btn btn-sm btn-primary">Cập nhật</a>
                    <a href="{{ route('shop.cart.clear') }}" class="btn-clear btn btn-sm btn-danger">Xóa sạch giỏ hàng</a>
                    <a href="{{ route('shop.submitOrder') }}" class="btn-checkout btn btn-sm btn-info">Thanh toán</a>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {
            $('#update-cart').on('click', function(e) {
                e.preventDefault();

                var $this = $(this);
                var data = new FormData();

                data.append('_token', '{{ csrf_token() }}');
                $('.qty').each(function() {
                    var _qtyEl = $(this);
                    data.append('data['+_qtyEl.data('row_id')+']', _qtyEl.val());
                });

                $.ajax({
                    url: '/cart/ajax/update-cart',
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
</div>
@stop