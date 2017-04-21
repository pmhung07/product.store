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
                <div class="thongso" role="tabpanel" id="tab-product">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" ><a href="balo-day-rut-bl020.html#home" aria-controls="home1" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home1">
                            <!--DESCRIPTION-->
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <img class="img-responsive" src="https://product.hstatic.net/1000003969/product/txt058_imgthongso_large.jpg" alt="Ba lô dây rút phom dáng bucket BL020" title="Ba lô dây rút phom dáng bucket BL020"/>
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
                <div class="description" role="tabpanel" id="tab-product">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="balo-day-rut-bl020.html#home" aria-controls="home" role="tab" data-toggle="tab">Chi tiết sản phẩm</a></li>
                        {{-- <li role="presentation" class=""><a data-toggle="modal" data-target="#myModalbaoquan"  href="balo-day-rut-bl020.html#huongdanbaoquan" aria-controls="huongdanbaoquan" role="tab" data-toggle="tab">Hướng dẫn bảo quản</a></li> --}}
                        {{-- <li role="presentation"><a onclick="$('body').animate({scrollTop: $('#product-review').offset().top}, 500)" href="balo-day-rut-bl020.html#review" aria-controls="review" role="tab" data-toggle="tab">Đánh Giá - Hỏi Đáp</a></li> --}}
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <p><strong><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">MÔ TẢ SẢN PHẨM</span></strong></p>
                            <p><strong><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"></span></strong><br></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">Vừa có thể kết hợp như chiếc ba lô, vừa giống dạng túi bucket, Balo BL020 đang làm phái đẹp đứng ngồi không yên.</span></p>
                            <p><br><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Kiểu dáng bucket với dây rút và tua rua ấn tượng.</span><br><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Chất liệu mềm mại</span><br><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Dây quai mang và tay cầm chắc chắn</span><br><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Phom túi rộng có thể đựng được nhiều vật dụng như sách vở, bóp ví, đồ dùng cá nhân...</span></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"></span><br></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"><strong>THÔNG TIN PHỐI ĐỒ</strong></span></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;"><strong></strong></span><br></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Balo phù hợp với đi làm, đi chơi, đi du lịch...</span></p>
                            <p><span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">- Phối với trang phục cá tính</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-none">
                    <div class="comment" style="margin-top: 40px;display:block" id="">
                        <div id="product-review" style="position:relative;z-index:2;">
                            <h3>Mời bạn đánh giá hoặc đặt câu hỏi về Ba lô dây rút phom dáng bucket BL020</h3>
                            <div id="fb-root"></div>
                            <div class="fb-comment">
                                <div class="comment-content">
                                    <div id="__izi-comment_widget"></div>
                                    <script>!function(a,b){var c=a.createElement("iframe"),e=(b.location.href,"https://juno.izicomment.com"),f=function(a,b){var c=document.getElementById(a);c.style.visibility="hidden",c.style.height=b+4+"px",c.style.visibility="visible"},g=function(){for(var a=document.getElementsByTagName("meta"),b=[],c=0;c<a.length;c++){for(var d=[],e=a[c].getAttribute("content"),f=0;f<a[c].attributes.length;f++){var g=a[c].attributes[f];d.push(g.name+"="+g.value)}e&&b.push({attributes:d,content:e})}return b},h=function(d){if(d.origin===e)try{var h=JSON.parse(d.data);if("height"==h.topic&&f("__izi-iframe_comment_widget",h.docHeight),"ready"==h.topic){var i={topic:"ready",meta:g(),location:b.location,document:{title:a.title,referrer:a.referrer}};c.contentWindow.postMessage(JSON.stringify(i),"*")}}catch(a){console.log(a,"Init comment widget failure!")}};c.src=e+"/widget/index.html",c.scrolling="no",c.style.border="none",c.style.overflow="hidden",c.style.height="100%",c.style.width="100%",c.style.minHeight="250px",c.id="__izi-iframe_comment_widget",a.getElementById("__izi-comment_widget").appendChild(c),window.addEventListener?window.addEventListener("message",h,!1):window.attachEvent&&window.attachEvent("onmessage",h)}(document,window);</script>
                                </div>
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