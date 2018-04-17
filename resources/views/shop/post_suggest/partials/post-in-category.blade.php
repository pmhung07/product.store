<div class="blog-category-items">
    <h3 class="category-title">
        <a href="{{ $category->getUrl() }}">{{ $category->getName() }}</a>
    </h3>

    @if($category->hotPosts->count())
        <div class="items-ngang">
            <div class="row">
                @foreach($category->hotPosts as $item)
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix mg-bt-10">
                        <div class="info pull-left">
                            <h3>
                                <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                            </h3>
                            <span class="date">{{ date('d.m.Y', strtotime($item->created_at)) }}</span>
                            <div class="des">
                                {{ $item->getTeaser() }}
                            </div>
                            <div class="share">
                                <p class="link-icon clearfix">
                                    <a href="javascript:void(0)" class="share-icon"></a>
                                    <a href="#comment_1000355447" class="comment-icon" data-spy="scroll"></a>
                                    <span class="count count_1000355447">1</span>
                                </p>
                                <div class="content">
                                    <ul class="icon-share-share">
                                        <li class="facebook">
                                            <a href="http://www.facebook.com/share.php?v=4&amp;src=bm&amp;u=https://juno.vn/blogs/mot/3-xu-huong-tui-xach-thoi-trang-moi-nhat-he-nay&amp;t=3 Xu hướng túi xách thời trang mới nhất Hè này" onclick="window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=436');   return false;" rel="nofollow" title="Share this on Facebook"></a>
                                        </li>
                                        <li class="google">
                                            <a href="https://plus.google.com/share?url=https://juno.vn/blogs/mot/3-xu-huong-tui-xach-thoi-trang-moi-nhat-he-nay" onclick="javascript:window.open(this.href,'  ','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" rel="nofollow" title="Share this on Google+"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="{{ $item->getUrl() }}">
                            <div class="item-img pull-right" style="background: url('{{ parse_image_url('md_'.$item->getImage()) }}') no-repeat;background-size: cover;background-position: center;"></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($category->newPosts->count())
        <div class="items-doc">
            <div class="row">
                @foreach($category->newPosts as $item)
                    <div class="col-xs-12 col-sm-24 col-md-24 col-lg-24">
                        <a class="ClickBlogItem" href="{{ $item->getUrl() }}">
                            <div class="item-img ClickBlogItem" style="height:305px !important;background: url('{{ parse_image_url('md_' . $item->getImage()) }}') no-repeat;background-size: cover;background-position: center;">
                            </div>
                        </a>
                        <h3 class="ClickBlogItem">
                            <a class="ClickBlogItem" href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a>
                        </h3>
                        <span class="date Mốt">{{ date('d.m.Y', strtotime($item->created_at)) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>