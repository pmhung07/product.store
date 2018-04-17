@extends('shop/layout/default')

@section('content')
<section id="product" class="product-detail-container">
    <div class="container wow fadeIn">
        <style>
            .breadcrumb > li + li::before
            {
            /* content: " › "; */
            border-left: 0px solid transparent;
            }
        </style>
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    @include('shop/product/breadcrumb')
                </div>
            </div>
        </div>
    </div>

    <div id="top-detail" class="top-detail wow fadeIn" style="background:#fff">
        <div class="container">
            <div class="content">
                <div class="clearfix" id="detail-product" style="background:#fff">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-sys-left-wrapper">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 slide-imagesm fadeIn wow main-image-wrap" style="position: relative;overflow: hidden;">
                                    @include('shop/product/left')
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 product fadeIn wow info-product-right-wrap">
                                    @include('shop/product/right')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    {{-- Mô tả sản phẩm --}}
                                    @include('shop/product/tab-content-spec')

                                    {{-- Comment box --}}
                                    <div class="fb-comments" data-href="{{ route('shop.product.detail', [$product->id, $product->getSlug()]) }}" data-width="100%" data-numposts="5"></div>

                                    {{-- Sản phẩm liên quan --}}
                                    @include('shop/product/relate-products')
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 no-padding store-wrapper">
                            {{-- @include('shop/product/store') --}}

                            @include('shop/product/policy')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--popup content-->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=442754092739471";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
    // $("#slide-image").owlCarousel({
    //     margin:10,
    //     autoplay: false,
    //     nav:true,
    //     navText: ["", ""],
    //     dots: false,
    //     items: 1,
    //     animateOut: 'fadeOut',
    //     animateIn: 'fadeIn',
    // });

    $(function() {
        // $( '.swipebox' ).swipebox();

        $('.plus-qty').on('click', function() {
            var qty = parseInt($('#quantity-custom').val());
            $('#quantity-custom').val(qty + 1);
        });

        $('.minus-qty').on('click', function() {
            var qty = parseInt($('#quantity-custom').val());
            var newQty = qty - 1 >= 0 ? qty - 1 : 0;
            $('#quantity-custom').val(newQty);
        });

        $('#tinhthanh').on('change', function() {
            var $this = $(this);
            $.ajax({
                url: '{{ route('shop.product.detail.ajax.get_html_stock') }}',
                type: 'GET',
                dataType: 'html',
                data: {
                    product_id : {{ $product->getId() }},
                    province_id: $this.val()
                },
                success: function(responseHTML) {
                    $('#stock-box').empty();
                    $('#stock-box').html(responseHTML);
                }
            });
        });


        // var cloneBtnBuyNow = $('.product-btn-buy').clone();
        // $('.hidden-btn-buy-now').html(cloneBtnBuyNow);
        $('.product-btn-buy-2').click(function() {
            $('.action-add-to-cart').trigger('click');
        });

        $(window).on('scroll', function() {

            if($(window).scrollTop() >= $('.sec-policies-feature').offset().top) {
                $('.sec-policies-feature').addClass('policy-fixed');

                if($(window).scrollTop() + $('.sec-policies-feature').height() >= $('.footer-map').offset().top) {
                    // $('.sec-policies-feature').removeClass('policy-fixed');
                    $('body').trigger('clear-right-fixed');
                }
            }

            if($(window).scrollTop() <= $('.deliver-top').offset().top + $('.deliver-top').height() + 20) {
                // $('.sec-policies-feature').removeClass('policy-fixed');
                $('body').trigger('clear-right-fixed');
            }


            if($('.sec-related-product').length > 0 && $(window).scrollTop() >= $('.sec-related-product').offset().top) {
                // $('.sec-policies-feature').removeClass('policy-fixed');
                $('body').trigger('clear-right-fixed');
            }
        });

        $('body').on('clear-right-fixed', function() {
            $('.sec-policies-feature').removeClass('policy-fixed');
        });


        // Thumbs slider
        $('.product-thumbs-slider').each(function(index, el) {
            var $this = $(el);
            if($this.data('count_items') > 6) {
                $this.addClass('owl-carousel owl-theme');
                var slider = $this.owlCarousel({
                    margin:10,
                    autoplay: false,
                    nav:true,
                    navText: ["", ""],
                    dots: false,
                    items: 6,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                });

                $this.parent().find('.slider-controls .left').click(function() {
                    slider.trigger('prev.owl.carousel');
                });

                $this.parent().find('.slider-controls .right').click(function() {
                    slider.trigger('next.owl.carousel');
                });
            } else {
                $this.parent().find('.slider-controls').addClass('hide');
            }
        });

        $(".thumb-item-image").on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            $('.image-product-carousel').attr('src', $this.find('img').attr('src').replace('sm_', 'lg_'));
        });
    });

</script>
@stop