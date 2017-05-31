<div class="thongtingia clearfix">
    <div class="changeLabel">
        <div class="hot-tags redTag">Sản phẩm giá tốt</div>
    </div>

</div>
<div class="thongtingia">
    <h1>{{ $product->getName() }}</h1>
    <h4>Mã SP : <span class="maspd">{{ $product->getSku() }}</span></h4>
    <!-- Variant -->
    <div class="sec-properties">
        @foreach($properties as $property)
            <div class="properties-item">
                <h5 class="name">{{ $property->name }}</h5>
                @if($property->values->count())
                    <ul class="list-unstyled property-values-list" id="property-values-list-{{ $property->id }}">
                        @foreach($property->values->all() as $k => $valueItem)
                            <li class="property-values-item {{ $k == 0 ? ' active' : '' }}" data-value_id="{{ $valueItem->id }}" data-property_id="{{ $property->id }}">
                                {{ $valueItem->name }}
                                <i class="bg-bottom-property"></i>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
    <div class="price">
        <label class="variant-price red">{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></label>
    </div>
</div>

<form action="../cart.html" menthod="post" class="product-form" id="product-form">
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

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="share-buttons" style="margin-top: 20px;">
        <h6>Chia sẻ với bạn bè</h6>
        <div class="addthis_inline_share_toolbox_vvrr"></div>
    </div>
</form>

<script type="text/javascript">
    $(function() {

        var _urlAddToCart = '{{ route('shop.cart.add') }}?product_id={{ $product->getId() }}&qty=' + $('#quantity-custom').val();

        get_variant();

        $('.action-add-to-cart').on('click', function() {
            var url = _urlAddToCart;
            window.location.href = url;
            return false;
        });

        $('.property-values-item').on('click', function() {
            var $this = $(this);

            $('#property-values-list-' + $this.data('property_id')).find('.property-values-item').removeClass('active');
            $this.addClass('active');

            get_variant();
        });


        function get_variant() {
            var combination = [];
            $('.property-values-item.active').each(function(ind, el) {
                combination.push($(el).data('value_id'));
            });

            $.ajax({
                url : '/ajax/product/get-variant',
                type : 'GET',
                dataType : 'json',
                data : {
                    _token : "{{ csrf_token() }}",
                    product_id : '{{ $product->id }}',
                    value_ids : combination.join(',')
                },
                success: function(response) {
                    if(response.code == 200) {
                        var variant = response.variant;
                        $('.maspd').text(variant.sku);
                        $('.variant-price').text(variant.price);
                        $('#main-product-image').attr('data-original', variant.image.large);
                        $('#main-product-image > a').attr('href', variant.image.large);
                        $('#main-product-image > a').attr('data-image', variant.image.large);
                        $('#main-product-image > a').attr('data-zoom-image', variant.image.large);
                        $('#main-product-image .image-product-carousel').attr('src', variant.image.medium);
                        $('#main-product-image .click-p').attr('data-zoom-image', variant.image.large);
                        _urlAddToCart += '&variant_sku=' + variant.sku;
                    }
                }
            });
        }
    });
</script>