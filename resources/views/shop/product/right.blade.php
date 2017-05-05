<div class="thongtingia clearfix">
    <div class="changeLabel">
        <div class="hot-tags redTag">Sản phẩm giá tốt</div>
    </div>

</div>
<div class="thongtingia">
    <h1>{{ $product->getName() }}</h1>
    <h4>Mã SP : <span class="maspd">{{ $product->getSku() }}</span></h4>
    <div class="price">
        <label class="variant-price red">{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></label>
    </div>
</div>

<form action="../cart.html" menthod="post" class="product-form" id="product-form">
    <div class="attributes hide">
        <h3 class="">Chọn màu yêu thích</h3>
        <ul class="option option1 list-unstyled">
            <li><label class="color"><input data-productid="1011535102" type="radio" value="Hồng" name="colorkm"><span><img src="//product.hstatic.net/1000003969/product/hong_123_20_icon.jpg">Hồng</span></label></li>
            <li><label class="color"><input data-productid="1011535102" type="radio" value="Hồng" name="colorkm"><span><img src="//product.hstatic.net/1000003969/product/hong_123_20_icon.jpg">Hồng</span></label></li>
            <li><label class="color"><input data-productid="1011535102" type="radio" value="Hồng" name="colorkm"><span><img src="//product.hstatic.net/1000003969/product/hong_123_20_icon.jpg">Hồng</span></label></li>
        </ul>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
        <select id="product-select" name="id" class="varian-select hidden" >
        </select>
    </div>
    <span style="font-size: 14px;color: #333;font-family: 'Roboto-Medium';" >Số lượng</span>
    <div class="selector-wrapper-qty">
        <input name="quantity" type="text" min="1" value="1" class="qty" id="quantity-custom" size="3"/>
        <div class="plus-qty">
            <span>+</span>
        </div>
        <div class="minus-qty">
            <span>-</span>
        </div>
    </div>
    <div class="wrappbtn">
        <div class="product-btn-buy">
            <a href="javascript:;" title="Đặt mua" class="add addnow action-add-to-cart">
                MUA NGAY<br/>
                <div>Giao tận nơi hoặc nhận ở cửa hàng</div>
            </a>
        </div>
        <div class="product-btn-buy-to-cart">
            <a href="javascript:;" title="Đặt mua" class="add buy-to-cart action-add-to-cart"> Thêm sản phẩm này vào giỏ hàng</a>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(function() {
        $('.action-add-to-cart').on('click', function() {
            var url = '{{ route('shop.cart.add') }}?product_id={{ $product->getId() }}&qty=' + $('#quantity-custom').val();
            window.location.href = url;
            return false;
        });
    });
</script>