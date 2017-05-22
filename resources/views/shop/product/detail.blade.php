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
                        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 slide-imagesm fadeIn wow" style="position: relative;overflow: hidden;">
                            @include('shop/product/left')
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 product fadeIn wow">
                            @include('shop/product/right')
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 no-padding">
                            @if($warehouses->count() > 0)
                            <div class="deliver-top withStore">
                                <div class="countstocks">Hệ thống {{ $warehouses->count() }} cửa hàng</div>
                                <div class="hidden"><a class="storemulticlick clickmultistock" data-toggle="modal" data-target="#myModalmultistock" href="#">bấm để xem danh sách</a></div>
                                <div class="chontinhthanh">
                                    <select id="tinhthanh">
                                        <option value="">Tỉnh/Thành phố</option>
                                        @foreach($provinces as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="stock-box" class="">
                                    @foreach($warehouses as $item)
                                        {!! view('shop/product/stock_item', ['stock' => $item])->render() !!}
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="sec-policies-feature">
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
                                    <div class="tit-color">1800 1162</div>
                                    <div class="descrip">từ 8:30 - 21:30 mỗi ngày</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="descriptionproduct" class="container wow fadeIn" style="margin-top:20px">
        <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                @if($product->getContent())
                    <div class="description" role="tabpanel" id="tab-product">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="javascript;" aria-controls="home" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home" style="padding-top: 15px;">
                                {!! $product->getContent() !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if($product->introduce)
                    <div class="sec-related-product">
                        <h5 class="sec-heading">
                            <span>Hướng dẫn sử dụng</span>
                        </h5>
                        <div>{!! $product->introduce !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="fb-comments" data-href="{{ url('shop.product.detail', [$product->id, $product->slug]) }}" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>

    @if($relatedProducts->count() > 0)
        <div class="sec-related-product container">
            <h5 class="sec-heading">
                <span>Sản phẩm có thể bạn quan tâm</span>
            </h5>
            <div class="row">
                @foreach($relatedProducts as $item)
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-24">
                        {!! view('shop/partials/product/item', ['product' => $item, 'type' => ''])->render() !!}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</section>
<!--popup content-->

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5674cf635e4c5b26"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=552091071613449";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
    $("#slide-image").owlCarousel({
        margin:10,
        autoplay: false,
        nav:true,
        navText: ["", ""],
        dots: false,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
    });

    $(function() {
        $( '.swipebox' ).swipebox();

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


        $(window).on('scroll', function() {
            if($(window).scrollTop() >= 628 && $(window).scrollTop() <= 760) {
                $('.sec-policies-feature').addClass('policy-fixed');
            } else {
                $('.sec-policies-feature').removeClass('policy-fixed');
                // $('#product').css({
                //     marginBottom: 0
                // });
            }

            // if($(window).scrollTop() >= 900) {
            //     $('.sec-policies-feature').removeClass('fixed');
            //     $('#product').css({
            //         marginBottom: 0
            //     });
            // }

            // if($(window).scrollTop() < 508) {
            //     $('.sec-policies-feature').removeClass('fixed').removeClass('hide');
            //     $('#product').css({
            //         marginBottom: 0
            //     });
            // }
        });
    });

</script>
@stop