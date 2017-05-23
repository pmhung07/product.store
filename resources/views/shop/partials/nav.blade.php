<header class="wow fadeIn">
    <div class="top hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <!---->
                <div class="col-md-6 col-sm-12 left no-padding">
                    <div class="col-md-4 col-sm-12 logoTop">
                        <div class="logo">
                            <a href="/" title="JUNO" class="logo"><img style="width: 30px;" alt="JUNO" src="{{ parse_image_url('sm_'.$GLB_Setting->logo) }}" onerror="this.src='/img/default_picture.png'" /></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 no-padding searchTop">
                        <div class="search-collection col-xs-10 no-padding">
                            <form class="search" action="/search">
                                <input id="text-product" class="col-xs-10 no-padding" type="text" name="q" placeholder="Bạn cần tìm gì?" />
                                <input type="hidden" value="product" name="type" />
                                <button id="submit-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 rightTop_head">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 switchboardTop">
                            <div class="switchboard_wrapper">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span><strong>{{ $GLB_Setting->phone }}</strong> (miễn phí)</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 no-padding storeTop">
                            <div class="headStore_wrapper">
                                <a target="_blank"  href="/store.html" style="color: #444">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                    <span>Xem hệ thống <strong>{{ App\Models\Store::count() }}</strong> cửa hàng</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 no-padding cartTop">
                            <div class="carttop_wrapper">
                                <div class="cart-relative">
                                    <a href="{{ route('shop.cart.index') }}">
                                        <div class="cart-total-price">
                                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                            <span>{{ Cart::subtotal(0, '.', '.') }}₫</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
    <div id="fix-top-menu" class="top2 hidden-sm hidden-xs">
        <div class="container-fluid menutopid" style="">
            <div class="container" style="position:relative">
                <div class="row">
                    <div class="col-lg-10 col-md-10">
                        <?php
                            function showCategories($categories, $parent_id = 0)
                            {
                                $cate_child = array();
                                foreach ($categories as $key => $item)
                                {
                                    // Nếu là chuyên mục con thì hiển thị
                                    if ($item['parent_id'] == $parent_id)
                                    {
                                        $cate_child[] = $item;
                                    }
                                }

                                if ($cate_child)
                                {
                                    // Tìm sản phẩm mới nhất của danh mục này
                                    $newestProduct = App\Product::join('products_groups', 'product.id', '=', 'products_groups.product_id')
                                                                 ->where('products_groups.group_id', '=', $parent_id)
                                                                 ->groupBy('product.id')
                                                                 ->select('product.*')
                                                                 ->first();

                                    echo '<ul class="dropdown-menu drop-menu" style=";width:520px;border-radius: 0px 0px 5px 5px;">';
                                    if($newestProduct) {
                                        echo view('shop/partials/nav_item_newest_product', ['product' => $newestProduct])->render();
                                    } else {
                                        echo '<li class="menu-hover-li newest" style="height: 100px;"></li>';
                                    }
                                    foreach ($cate_child as $key => $item)
                                    {
                                        // Hiển thị tiêu đề chuyên mục
                                        echo '<li style="width:30%;float:left;">';
                                            echo '<a href="'. $item->getUrl() .'"><i class="fa fa-caret-right" style="color:#666;padding-right:10px"></i>'. $item->getName() .'</a>';

                                        // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                                        showCategories($categories, $item['id']);
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                }
                            }
                        ?>
                        <ul class="menu-top clearfix hidden-xs">
                            <?php foreach($GLB_Categories as $item): ?>
                                <?php if($item->parent_id > 0) continue; ?>
                                <li class="menu-li" >
                                    <a href="{{ $item->getUrl() }}" class="" >
                                        <div class="coll-icon">
                                            <img class="ico-top" src="{{ parse_image_url($item->icon) }}"/>
                                            <span class="title-main-menu">{{ $item->name }}</span>
                                        </div>
                                    </a>
                                    <?php showCategories($GLB_Categories, $item->getId()); ?>
                                </li>
                            <?php endforeach; ?>

                            <li class="menu-li fix-icon-coll">
                                <a href="{{ route('shop.post.index') }}" class="" target="_blank">
                                    <div class="coll-icon">
                                        <img class="ico-top" src="https://file.hstatic.net/1000003969/file/imgImport_tinthoitrang_hover.svg" data-position="imgImport_tinthoitrang.svg" />
                                        <span class="title-main-menu">Tin Thời Trang</span>
                                    </div>
                                </a>
                            </li>
                            <script type="text/javascript">
                                $(function() {
                                    $('.menu-li').each(function() {
                                        if($(this).find('.dropdown-menu').length > 0) {
                                            $(this).addClass('hasChild');
                                        }
                                    });
                                });
                            </script>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top hidden-lg hidden-md" id="mobile-menu">
        @include('shop/partials/nav-mobile')
    </div>
    <script>
        $(function(){
            $('.togleclick').click(function(){
                $('.toggle-search').toggle(200);
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</header>