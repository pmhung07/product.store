<header class="wow fadeIn">
    <div class="top hidden-sm hidden-xs">
        <div class="container">
            <div class="row">
                <!---->
                <div class="col-md-6 col-sm-12 left no-padding">
                    <div class="col-md-4 col-sm-12 logoTop">
                        <div class="logo">
                            <a href="/" title="JUNO" class="logo"><img style="width: 30px;" alt="JUNO" src="/shop/assets/images/logo.png" /></a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 no-padding searchTop">
                        <div class="search-collection col-xs-10 no-padding">
                            <form class="search" action="https://juno.vn/search">
                                <input id="text-product" class="col-xs-10 no-padding" type="text" name="q" placeholder="Bạn cần tìm gì?" />
                                <input type="hidden" value="product" name="type" />
                                <button id="submit-search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 no-padding rightTop_head">
                    <div class="col-md-6 col-sm-12 switchboardTop">
                        <div class="switchboard_wrapper">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>BÁN HÀNG: <strong>1800 1162</strong> (miễn phí)</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 no-padding storeTop">
                        <div class="headStore_wrapper hide">
                            <a target="_blank"  href="collections/cua-hang-khu-vuc-tp-ho-chi-minh%3Fview=stores.html">
                            <i class="fa fa-building" aria-hidden="true"></i>
                                <span>Xem hệ thống <strong>42</strong> cửa hàng</span>
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
                                        unset($categories[$key]);
                                    }
                                }

                                if ($cate_child)
                                {
                                    // Tìm sản phẩm mới nhất của danh mục này
                                    $newestProduct = App\Product::where('product_group_id', $parent_id)->orderBy('created_at', 'DESC')->first();
                                    echo '<ul class="dropdown-menu drop-menu" style=";width:520px;border-radius: 0px 0px 5px 5px;">';
                                    if($newestProduct) {
                                        echo view('shop/partials/nav_item_newest_product', ['product' => $newestProduct])->render();
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
        <div class="fixed-nav">
            <button id="menu-toggle" class="navbar-toggle pull-left" type="button" data-toggle="modal" data-target="#menu-modal">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a href="/" title="JUNO" class="logo"><img alt="JUNO" src="/assets/hstatic.net/969/1000003969/1000161857/logo.png%3Fv=8910" /></a>
            <a href="/cart.php" class="cart-link">
            <span ><i class="fa fa-shopping-bag" aria-hidden="true"></i> <strong>0₫</strong></span>
            </a>
            <form class="frm-search" action='https://juno.vn/search'>
                <input  type="text" name='q' value="" id="inputSearch" placeholder="Tìm kiếm...">
            </form>
            <script>
                $(document).ready(function(){

                    $('#wrapper').click(function(e){
                        if (e.target !== $('.btn-search')){
                            return;
                        }else{
                            $('.btn-search').removeClass('active');
                            $('.frm-search').find('input').css('width', '1px');
                            setTimeout(function(){
                                $('.frm-search').find('input').css('display', 'none');
                                $('.logo').show();
                                $('#menu-toggle').show();
                                $('body').removeClass('searching');
                            },500);
                        }
                    });

                });

            </script>
        </div>
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