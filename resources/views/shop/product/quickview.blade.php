<link rel="stylesheet" href="/shop/assets/hstatic.net/modalpopup.css" />
<div class="modal-content" id="my-product-quickview">
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
                        <a class="titlekm" href="{{ $product->getUrl() }}"><h1>{{ $product->getName() }}</h1></a>
                        <h4 class="masp">Mã SP : <span class="text">{{ $product->getSku() }}</span></h4>
                        <div class="price">
                            <label class="variant-pricekm">{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></label>
                        </div>

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

                        <form action="/cart" menthod="post" class="product-formkm" id="product-form">
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

<input type="hidden" id="_product_id">
<input type="hidden" id="_qty">
<input type="hidden" id="_variant_sku">

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
    });
</script>

<script type="text/javascript">
    $(function() {

        get_variant();

        // Set up param for cart
        $('#_product_id').val({{ $product->getId() }});
        $("#_qty").val($('#quantity-customkm').val());

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
                    $('#my-product-quickview .masp .text').text(response.sku);
                    $('#my-product-quickview .variant-pricekm').html(response.price + '<span>đ</span>');
                    $('#my-product-quickview').find('.image1').find('img').attr('src', response.image.medium);
                    $('#_variant_sku').val(response.sku);
                }
            });
        }

        // Click vào nút mua hàng
        $(document).on('click', '.product-btn-buy', function(e) {
            e.preventDefault();
            var paramsAddToCart = {
                product_id : $('#_product_id').val(),
                qty: $('#_qty').val(),
                variant_sku: $('#_variant_sku').val()
            };
            var url = '/cart/add-to-cart?product_id='+ paramsAddToCart.product_id +'&qty=' + paramsAddToCart.qty + '&variant_sku='+paramsAddToCart.variant_sku;
            window.location.href = url;
        });
    });
</script>