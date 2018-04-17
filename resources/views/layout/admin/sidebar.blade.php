<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs usr-name">
                                {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</strong>
                            </span>
                            <span class="text-muted text-xs block" style="color: #e5f2ce;">
                                {!! get_position_name(Auth::user()->id) !!}
                            </span>
                            <!--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-success">0</span>
                            </a>-->
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    Ls
                </div>
            </li>

            <?php if(active_sidebar(2) == 1 ){ ?>
            <li @if(Request::is('system/dashboard')) {!! 'class="active"' !!} @endif>
                <a href="/system/dashboard">
                    <i class="fa fa-th-large"></i>
                    <span class="nav-label">Tổng quan</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(active_sidebar(1) == 1 ){ ?>
            <li @if(Request::is('system/orders/*')) {!! 'class="active"' !!} @endif>
                <a href="/system/orders/index?filter-order-status=0">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-label">Bán hàng</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(   active_sidebar(3) == 1  ||
                        active_sidebar(21) == 1 ||
                        active_sidebar(25) == 1 ||
                        active_sidebar(29) == 1 ||
                        active_sidebar(30) == 1 ||
                        active_sidebar(59) == 1    ){ ?>
            <li @if(Request::is('system/product-group/*') ||
                    Request::is('system/product/*') ||
                    Request::is('system/purchases/*') ||
                    Request::is('system/stock/*') ||
                    Request::is('system/stock-receipt/*') ||
                    Request::is('system/inventory/index') ||
                    Request::is('system/inventory/*') ||
                    Request::is('system/return-product/*')
                    ) {!! 'class="active"' !!} @endif>
                <a href="/system/product-group/index">
                    <i class="fa fa-database"></i>
                    <span class="nav-label">Quản lý kho </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">

                    <?php if(active_sidebar(3) == 1 ){ ?>
                    <li>
                        <a href="/system/product-group/index"
                        @if(
                            Request::is('system/product-group/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-sitemap"></i>
                            Nhóm sản phẩm
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(21) == 1 ){ ?>
                    <li>
                        <a href="/system/product/index"
                        @if(
                            Request::is('system/product/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-list"></i>
                            Sản phẩm
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(25) == 1 ){ ?>
                    <li>
                        <a href="/system/stock/index"
                        @if(
                            Request::is('system/stock/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-database"></i>
                            Kho hàng
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(29) == 1 ){ ?>
                    <li>
                        <a href="/system/inventory/index"
                        @if(
                            Request::is('system/inventory/index')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-cubes"></i>Hàng tồn kho
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(30) == 1 ){ ?>
                    <li>
                        <a href="/system/stock-receipt/index"
                        @if(
                            Request::is('system/stock-receipt/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-indent"></i>
                            Nhập kho
                        </a>
                    </li>
                    <?php } ?>

                    <?//php if(active_sidebar(0) == 1 ){ ?>
                    <!--<li>
                        <a href="/system/transfer-product/index"
                        /*@if(
                            Request::is('system/transfer-product/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>*/
                            <i class="fa fa-retweet"></i>
                            Chuyển kho
                        </a>
                    </li>-->
                    <?//php } ?>

                    <?php if(active_sidebar(59) == 1 ){ ?>
                    <li>
                        <a href="/system/return-product/index"
                        @if(
                            Request::is('system/return-product/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-reply-all"></i>
                            Trả hàng
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

            <?php if(active_sidebar(62) == 1 ){ ?>
            <li @if(Request::is('system/statistic/channel') ||
                    Request::is('system/statistic/product-group') ||
                    Request::is('system/statistic/product') ||
                    Request::is('system/statistic/staff') ||
                    Request::is('system/statistic/customer') ||
                    Request::is('system/statistic/sales/dashboard') ||
                    Request::is('system/statistic/regions')
                    ) {!! 'class="active"' !!} @endif>
                <a href="/system/statistic/sales/dashboard">
                    <i class="fa fa-bar-chart-o"></i>
                    <span class="nav-label">Thống kê, báo cáo</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(active_sidebar(52) == 1 ){ ?>
            <li @if(Request::is('system/staff/*')) {!! 'class="active"' !!} @endif>
                <a href="/system/staff/index">
                    <i class="fa fa-sitemap"></i>
                    <span class="nav-label">Nhân viên</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(active_sidebar(43) == 1 ){ ?>
            <li @if(Request::is('system/customer/*')) {!! 'class="active"' !!} @endif>
                <a href="/system/customer/index">
                    <i class="fa fa-user"></i>
                    <span class="nav-label">Khách hàng</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(   active_sidebar(0) == 1  ){ ?>

            <li @if(Request::is('system/email-marketing/*')) {!! 'class="active"' !!} @endif>
                <a href="javascript:;">
                    <i class="fa fa-inbox"></i>
                    <span class="nav-label">Chăm sóc khách hàng</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <?php if(active_sidebar(0) == 1 ){ ?>
                    <li>
                        <a href="{{ route('system.emailMarketing.index') }}"><i class="fa fa-envelope"></i> Email marketing</a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(0) == 1 ){ ?>
                    <li>
                        <a href="{{ route('system.smsMarketing.index') }}"><i class="fa fa-paper-plane"></i> SMS marketing</a>
                    </li>
                    <?php } ?>
                </ul>
            </li>

            <?php } ?>

            <?php if(active_sidebar(78) == 1 ){ ?>
            <li @if(Request::is('system/landing-page/index') ||
                    Request::is('system/landing-page/create') ||
                    Request::is('system/landing-page/builder')
                    ) {!! 'class="active"' !!} @endif>
                <a href="/system/landing-page/index">
                    <i class="fa fa-magic"></i>
                    <span class="nav-label">Landing Page </span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(active_sidebar(81) == 1 ){ ?>
            <li class="{{ Request::is('system/affiliate/*') ? 'active' : '' }}">
                <a href="/system/affiliate/manager/dashboard">
                    <i class="fa fa-globe"></i>
                    <span class="nav-label">Affiliate management</span>
                    <span class="fa arrow"></span>
                </a>
            </li>
            <?php } ?>

            <?php if(   active_sidebar(85) == 1  ){ ?>

            <li class="{{ Request::is('system/online-store/post-categories/*') || 
                            Request::is('system/online-store/setting/*') || 
                            Request::is('system/online-store/banner/*') || 
                            Request::is('system/online-store/testimonial/*') || 
                            Request::is('system/online-store/post-suggest/*') || 
                            Request::is('system/online-store/post/*') || 
                            Request::is('system/online-store/page/*') || 
                            Request::is('system/online-store/coupon/*') || 
                            Request::is('system/online-store/ga/*') || 
                            Request::is('system/store/*') || 
                            Request::is('system/online-store/navigation/*') ? 'active' : '' }}">
                <a href="javascript:;">
                    <i class="fa fa-leaf"></i>
                    <span class="nav-label">Website</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/setting/index"
                        @if(
                            Request::is('system/online-store/setting/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-cogs"></i>
                            Cài đặt
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="{{ route('system.navigation.index') }}"
                        @if(
                            Request::is('system/online-store/navigation/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-tag"></i>
                            Menu
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="{{ route('system.banner.index') }}"
                        @if(
                            Request::is('system/online-store/banner/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-picture-o"></i>
                            Banner
                        </a>
                    </li>
                    <?php } ?>


                    <li>
                        <a href="{{ route('system.testimonial.index') }}"
                        @if(
                            Request::is('system/online-store/testimonial/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-fire"></i>
                            Ý kiến khách hàng
                        </a>
                    </li>


                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/post-categories/index"
                        @if(
                            Request::is('system/online-store/post-categories/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-sitemap"></i>
                            Danh mục tin
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/post/index"
                        @if(
                            Request::is('system/online-store/post/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-indent"></i>
                            Tin tức
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/post-suggest/index"
                        @if(
                            Request::is('system/online-store/post-suggest/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-indent"></i>
                            Suggest Post
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/page/index"
                        @if(
                            Request::is('system/online-store/page/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-files-o"></i>
                            Trang tĩnh
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/store/index"
                        @if(
                            Request::is('system/store/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-home"></i>
                            <span class="nav-label">Cửa hàng</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/coupon/index"
                        @if(
                            Request::is('system/online-store/coupon/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-lastfm"></i>
                            Mã coupon
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(active_sidebar(85) == 1 ){ ?>
                    <li>
                        <a href="/system/online-store/ga/index"
                        @if(
                            Request::is('system/online-store/ga/*')
                        )  {!! 'style="color: #a8d3ec;"' !!} @endif>
                            <i class="fa fa-line-chart"></i>
                            Google analytics
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>

        </ul>

    </div>
</nav>