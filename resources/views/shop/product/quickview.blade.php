<link rel="stylesheet" href="/shop/assets/hstatic.net/modalpopup.css" />
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-titlekm">Lựa chọn màu</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="content">
                <div class="clearfix" id="detail-product">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <div class="image-variantkm">
                            <a class="image1" href="{{ $product->getUrl() }}">
                                <img class="" width="100%" src="{{ parse_image_url('md_'. $product->getImage()) }}">
                            </a>
                        </div>
                        <div class="link-view-detail">
                            <a class="link1" href="{{ $product->getUrl() }}">Xem chi tiết</a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 product popupLayout">
                        <a class="titlekm" href="/products/tui-xach-nho-txn062#do"><h1>{{ $product->getName() }}</h1></a>
                        <h4 class="masp">Mã SP : {{ $product->getSku() }}</h4>
                        <div class="price">
                            <label class="variant-pricekm">{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></label>
                        </div>

                        <form action="/cart" menthod="post" class="product-formkm" id="product-form">
                            <div class="filter-color-size hide">
                                <h3 class="size-pick">Chọn màu yêu thích</h3>
                                <ul class="option option1 option1km">
                                    <li>
                                        <label class="color">
                                            <input data-productid="1011534851" checked="checked" type="radio" value="Đỏ" name="colorkm">
                                            <span>
                                                <img src="//product.hstatic.net/1000003969/product/do_41__icon.jpg">Đỏ
                                            </span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>

                            <span style="font-size: 14px;color: #333;font-family: 'Roboto-Medium';">Số lượng</span>
                            <div class="selector-wrapper-qtykm">
                                <input name="quantity" type="text" min="1" value="1" class="quantity-customkm" id="quantity-customkm" size="3">
                                <div class="plus-qtykm">
                                    <span>+</span>
                                </div>
                                <div class="minus-qtykm">
                                    <span>-</span>
                                </div>
                            </div>
                            <div style="margin-top: 15px;">
                                <div class="product-btn-buy">
                                    <a href="javascript:void(0)" title="Đặt mua" class="addnowkm">ĐẶT HÀNG NGAY<br><div>Giao tận nơi hoặc nhận ở cửa hàng</div></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('.plus-qtykm').on('click', function() {
            var qty = $('#quantity-customkm').val();
            qty ++;
            $('#quantity-customkm').val(qty);
        });

        $('.minus-qtykm').on('click', function() {
            var qty = $('#quantity-customkm').val();
            qty --;

            if(qty >= 1) {
                $('#quantity-customkm').val(qty);
            }
        });

        $('.product-btn-buy').addToCart({
            product_id : {{ $product->getId() }},
            qty: $('#quantity-customkm').val()
        });
    });
</script>