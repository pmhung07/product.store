@extends('shop/layout/default')

@section('content')
<section id="product">
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
                            <div class="deliver-top withStore">
                                <div class="countstocks">Có {{ $warehouses->count() }} cửa hàng</div>
                                <div class="descrip">còn sản phẩm này</div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="descriptionproduct" class="container wow fadeIn" style="margin-top:20px">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="thongso hide" role="tabpanel" id="tab-product">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" ><a href="balo-day-rut-bl020.html#home" aria-controls="home1" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home1">
                            <!--DESCRIPTION-->
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <img class="img-responsive" src="{{ parse_image_url('md_'. $product->getImage()) }}" alt="{{ $product->getName() }}" title="{{ $product->getName() }}"/>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="backsys" >
                                            <div><span class="infobe">Mã SP</span><span class="infoaf">BL020</span></div>
                                            <div><span class="infobe">Kiểu dáng</span><span class="infoaf"> Ba lô thời trang</span></div>
                                            <div><span class="infobe">Chất liệu</span><span class="infoaf"> Da tổng hợp</span></div>
                                            <div><span class="infobe">Màu sắc</span><span class="infoaf"> Đen - Đỏ</span></div>
                                            <div><span class="infobe">Kích cỡ</span><span class="infoaf"> 25cm x 30cm x 11cm</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($product->getContent())
                    <div class="description" role="tabpanel" id="tab-product">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="javascript;" aria-controls="home" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">

                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-none hide">
                    <div class="comment" style="margin-top: 40px;display:block" id="">
                        <div id="product-review" style="position:relative;z-index:2;">
                            <h3>Mời bạn đánh giá hoặc đặt câu hỏi về Ba lô dây rút phom dáng bucket BL020</h3>
                            <div id="fb-root"></div>
                            <div class="fb-comment">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="more-sp-detail">
                </div>
            </div>
        </div>
    </div>
</section>
<!--popup content-->



<script type="text/javascript">
    $("#slide-image").owlCarousel({
        margin:10,
        autoplay: true,
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
    });

</script>
@stop