<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="/shop/favicon.ico" type="image/png" />
        <title>
            Thanh toán đơn hàng
        </title>
        <meta name="description" content="Thanh toán đơn hàng" />
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href='/shop/assets/hstatic.net/checkouts.css?v=1.1' rel='stylesheet' type='text/css'  media='all'  />
        <link href='/shop/assets/hstatic.net/check_out.css?v=8910' rel='stylesheet' type='text/css'  media='all'  />
        <script src='/shop/assets/hstatic.net/jquery.min.js' type='text/javascript'></script>
        <script src='/shop/assets/hstatic.net/jquery.validate.js' type='text/javascript'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript" src="/shop/assets/js/my-plugin/load-district.js"></script>
    </head>
    <body>
        <input id="reloadValue" type="hidden" name="reloadValue" value="" />
        <div class="content">
            <div class="wrap">
                <div class="sidebar">
                    <div class="sidebar-content">
                        <div class="order-summary order-summary-is-collapsed">
                            <h2 class="visually-hidden">Thông tin đơn hàng</h2>
                            <div class="order-summary-sections">
                                <div class="order-summary-section order-summary-section-product-list" data-order-summary-section="line-items">
                                    <table class="table">
                                        <thead>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Giá</th>
                                        </thead>
                                        <tbody>
                                            @foreach(Cart::content() as $item)
                                                <tr class="product">
                                                    <td class="product-image">
                                                        <div class="product-thumbnail">
                                                            <div class="product-thumbnail-wrapper">
                                                                <img class="product-thumbnail-image" alt="{{ $item->name }}" src="{{ parse_image_url($item->options->product->image) }}" />
                                                            </div>
                                                            <span class="product-thumbnail-quantity" aria-hidden="true">{{ $item->qty }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="product-description">
                                                        <span class="product-description-name order-summary-emphasis">{{ $item->name }}</span>
                                                        <span class="product-description-variant order-summary-small-text">

                                                        </span>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="order-summary-emphasis">{{ formatCurrency($item->price) }}₫</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="1"></td>
                                                <td>Tổng cộng:</td>
                                                <td>{{ Cart::subtotal(0, '.', '.') }}đ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main">
                    <div class="main-content">
                        <div class="step">
                            <form class="form" method="POST" action="">
                                <div class="step-sections steps-onepage" step="1">

                                    <div class="section">
                                        <div class="section-header">
                                            <h2 class="section-title">Thông tin giao hàng</h2>
                                        </div>
                                        <div class="section-content section-customer-information no-mb">
                                            <div class="form-group">
                                                @include('includes/flash-message')
                                            </div>

                                            <div class="form-group">
                                                <input placeholder="Họ và tên" class="form-control input-lg" name="customer_name" value="{{ old('customer_name') }}" />
                                                <small class="help-inline text-warning">Trường thông tin bắt buộc phải nhập</small>
                                            </div>

                                            <div class="form-group">
                                                <input placeholder="Email" class="form-control input-lg" name="customer_email" value="{{ old('customer_email') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input placeholder="Số điện thoại" class="form-control input-lg" name="customer_phone" value="{{ old('customer_phone') }}" />
                                                <small class="help-inline text-warning">Trường thông tin bắt buộc phải nhập</small>
                                            </div>

                                            <div class="form-group">
                                                <input placeholder="Địa chỉ" class="form-control input-lg" name="customer_address" value="{{ old('customer_address') }}" />
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" id="province" name="city_id">
                                                    <option value="">Tỉnh / thành</option>
                                                    @foreach($provinces as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == old('city_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <select class="form-control" id="district" name="district_id">
                                                    <option value="">Chọn quận / huyện</option>
                                                    @foreach($districts as $item)
                                                        <option class="option" value="{{ $item->id }}" {{ $item->id == old('district_id') ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input placeholder="Mã giảm giá" class="form-control input-lg" name="coupon" value="{{ old('coupon') }}" />
                                            </div>

                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="6Lc9dBsUAAAAAG3jMxuA9SmX2XrgBwukv4m7XytN"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-footer">

                                    {!! csrf_field() !!}
                                    <button type="submit" class="step-footer-continue-btn btn">
                                        <span class="btn-content">Hoàn tất đơn hàng</span>
                                        <i class="btn-spinner icon icon-button-spinner"></i>
                                    </button>

                                    <a class="step-footer-previous-link" href="{{ route('shop.cart.index') }}">
                                        Giỏ hàng
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function() {
                $('#province').loadDistricts({
                    observers: '#district'
                });
            });
        </script>
    </body>
</html>