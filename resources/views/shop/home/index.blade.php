@extends('shop/layout/default')

@section('content')
<div id="slide-thumb" class="wow fadeIn slide-thumb">
    <section class="photoslider-section no-padding">
        <div id="home-slider" class="owl-carousel owl-theme">
            <?php for($i = 0; $i < 3; $i ++): ?>
                <div class="item">
                    <a href="/single-product.php">
                    <img src="/shop/assets/file.hstatic.net/1000003969/file/sd01034-banner-web-fix.jpg" />
                    </a>
                </div>
            <?php endfor; ?>
        </div>
        <script>
            $("#home-slider").owlCarousel({
                margin:10,
                autoplay: true,
                nav:false,
                dots: false,
                items: 1,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
            });
        </script>
    </section>
</div>
<div id="home-filter-top5" class="wow fadeIn">
    <div class="container">
        <div class="row" style="text-align:center;margin-bottom:20px">
            <div class="col-xs-12 col-sm-12 col-md-12" >
                <div class="col-lg-2 col-md-3 col-sm-10 col-xs-10"></div>
                <div class="col-lg-6 col-md-4 col-sm-10 col-xs-10">
                    <h3 class="title-top">Top 05 sản phẩm hot nhất tuần</h3>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-10 col-xs-10"></div>
            </div>
        </div>
        <div class="home-filter-top5 center-product product-item products-resize home-filter-product-new">
            <?php foreach($hotProducts as $item): ?>
                {!! view('shop/partials/product/item', ['product' => $item])->render() !!}
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-more-bottom">
                <span class="title-more">Mời bạn <a href="collections/san-pham-top.html" class="link">xem thêm các sản phẩm hot</a></span> khác
            </div>
        </div>
    </div>
</div>
<div id="home-filter-product-new" class="wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="title" id="price-200">
                    <div class="flexbox-title-content">
                        <span class="flexbox-title-name">TOP sản phẩm mới nhất tuần này</span>
                    </div>
                </div>
                <div class="center-product product-item products-resize home-filter-product-new">
                    <?php foreach($newestProductsInWeek as $item): ?>
                        {!! view('shop/partials/product/item', ['product' => $item])->render() !!}
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-more-bottom">
                <span class="title-more">Mời bạn <a href="pages/new-collection.html" class="link">xem thêm các mẫu mới</a> khác</span>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid wow fadeIn">
    <div class="container" >
        <div class="row shoptype">
            <div class="col-xs-12 col-sm-12" >
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-bottoms" style="padding-left:10px;">
                        <h3 class="category-title title-shoptype">
                            <a href="javascript:void(0)">tin thời trang</a>
                        </h3>
                        <p class="title-shoptype-small">Hiểu thời trang và thật thời trang mỗi ngày!</p>
                    </div>
                </div>
                <div class="col-xs-10 col-sm-6">
                    <div class="row">
                        <div id="owl-blog-slider" class="owl-carousel owl-theme">
                            <?php for($i = 0; $i < 5; $i ++): ?>
                                <div class="blog-slider-item 5 item">
                                    <a href="/single-blog.php" target="_blank"><img src="/shop/assets/file.hstatic.net/1000003969/file/kel_0077_copy_1024x1024.jpg" alt="Mẹo bảo quản giày và túi xách mùa nắng nóng"></a>
                                    <div class="blog-slider-info">
                                        <a href="blogs/meo.1.html" target="_blank" class="blog-category">Mẹo</a>
                                        <h3>
                                            <a href="/single-blog.php" target="_blank" class="blog-title">Mẹo bảo quản giày và túi xách mùa nắng nóng</a>
                                        </h3>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <script>
                    $("#owl-blog-slider").owlCarousel({
                        pagination : false,
                        navigation : true,
                        navigationText:["<i class=\"insert-left\"><\/i>","<i class=\"insert-right\"><\/i>"],
                        autoPlay: 8000,
                        items :1,
                        transitionStyle : "fade",
                        itemsDesktop : [1024,1],
                        itemsDesktopSmall : [967,1],
                        itemsTablet: [600,1],
                    });
                    $('#owl-insert-slider').owlCarousel({
                        pagination : false,
                        navigation : true,
                        items :4,
                        navigationText:["<i class=\"insert-left\"><\/i>","<i class=\"insert-right\"><\/i>"],
                        itemsDesktop : [1024,3],
                        itemsDesktopSmall : [967,2],
                        itemsTablet: [600,1],
                        itemsMobile : [600,1]
                    });
                </script>
                <div class="col-xs-10 col-sm-4">
                    <div class="row">
                        <div class="blog-read-viewed">
                            <h2>
                                <span>Bài được xem nhiều nhất</span>
                            </h2>
                            <?php for($i = 0; $i < 5; $i ++): ?>
                                <div class="clearfix blog-read-item">
                                    <a href="/single-blog.php" target="_blank">
                                        <div class="item-img pull-left">
                                            <img class="lazy" src="/shop/assets/file.hstatic.net/1000003969/file/kel_0077_copy_1024x1024.jpg"/><span style="margin-left:-100px">1</span>
                                        </div>
                                    </a>
                                    <div class="caption pull-right" >
                                        <h3 class="title"><a href="/single-blog.php" target="_blank">Mẹo bảo quản giày và túi xách mùa nắng nóng</a></h3>
                                        <span class="date">11.04.2017</span>
                                        <a href="blogs/meo.1.html" target="_blank" class="title-category">Tin Mẹo</a>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title-more-bottom">
                    <span class="title-more">Bài viết mới cập nhật mỗi ngày. Mời bạn <a href="blogs/magazine.html" class="link">xem thêm</a> tin bài khác</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop