<!--<div class="deliver-top withStore"></div>-->
<div class="sec-policies-feature">
    <div class="hidden-btn-buy-now" style="padding: 10px 0 0 0">
        <div class="wrapper-rightInfo">
            <div class="price">
                <label class="variant-price">{{ formatCurrency($product->price) }}<sup>đ</sup></label>
            </div>

            <div id="show-bonus"></div>

            <div class="product-form">
                <div class="clearfix"></div>
                <div>
                    <div class="product-btn-buy-2">
                        <a href="javascript:void(0)" title="Đặt mua" class="addnow">MUA NGAY</a>
                    </div>
                </div>
            </div>
            <div class="deliver-top-no deliver-phone">
                <div class="tit">Hỗ trợ mua nhanh</div>
                <div class="tit-color">{{ $GLB_Setting->phone }}</div>
                <div class="descrip">Mã SP: {{ $product->sku }}</div>
            </div>
        </div>
    </div>
    <div class="deliver-top info ">
        <div class="tit-color">Sẽ có tại nhà bạn</div>
        <div class="descrip">từ 1-5 ngày làm việc</div>
    </div>
    <div class="deliver-top-no deliver-dt">
        <a href="#">
            <div class="tit">Giao hàng miễn phí</div>
            <div class="descrip">sản phẩm trên 300,000đ</div>
        </a>
    </div>
    <div class="deliver-top-no deliver-ch" style="background:none !important">
        <div style="position:absolute;margin-left:-37px;">
            <img src="//hstatic.net/969/1000003969/10/2016/6-15/icon-day90.png"/>
        </div>
        <a href="#">
            <div class="tit">Đổi trả miễn phí</div>
            <div class="descrip">Đổi trả miễn phí
                90 ngày
            </div>
        </a>
    </div>
    <div class="deliver-top-no deliver-pay">
        <a href="#">
            <div class="tit">thanh toán</div>
            <div class="descrip">Thanh toán khi nhận hàng</div>
        </a>
    </div>
    <div class="deliver-top-no deliver-phone">
        <div class="tit">Hỗ trợ mua nhanh</div>
        <div class="tit-color">{{ $GLB_Setting->phone }}</div>
        <div class="descrip">từ 8:30 - 21:30 mỗi ngày</div>
    </div>
</div>