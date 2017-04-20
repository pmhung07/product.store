<div class="col-lg-3">
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <div class="file-manager">
                <h5>Cài đặt thông tin</h5>
                <ul class="folder-list m-b-md" style="padding: 0">
                    <li>
                        <a href="/system/shop/post-categories/index"
                        @if(
                            Request::is('system/shop/post-categories/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-sitemap"></i>
                            Danh mục tin
                        </a>
                    </li>
                    <li>
                        <a href="/system/shop/post/index"
                        @if(
                            Request::is('system/shop/post/*')
                        )  {!! 'style="color: #115c8c;font-weight: 600;"' !!} @endif>
                            <i class="fa fa-indent"></i>
                            Bài viết
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>