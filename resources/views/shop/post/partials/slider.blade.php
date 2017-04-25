<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
    <div class="row">
        <div id="owl-blog-slider" class="owl-carousel owl-theme">
            @foreach($hotPosts as $item)
                <div class="blog-slider-item">
                    <a href="{{ $item->getUrl() }}">
                        <img src="{{ parse_image_url('lg_' . $item->getImage()) }}" alt="{{ $item->getTitle() }}">
                    </a>
                    <div class="blog-slider-info">
                        <a href="{{ $item->category->getUrl() }}" class="blog-category">{{ $item->category->getName() }}</a>
                        <h3>
                            <a href="{{ $item->getUrl() }}" class="blog-title">{{ $item->getTitle() }}</a>
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
    <div class="row">
        <div class="blog-read-viewed">
            <h2>
                <span>Bài được xem nhiều nhất</span>
            </h2>

            @foreach($hotPosts as $item)
                <div class="clearfix blog-read-item">
                    <a class="link-image" href="{{ $item->getUrl() }}" target="_blank">
                        <div class="item-img">
                            <img class="lazy image" src="{{ parse_image_url($item->getImage()) }}">
                        </div>
                    </a>
                    <div class="caption">
                        <h3 class="title"><a href="{{ $item->getUrl() }}" target="_blank">{{ $item->getTitle() }}</a></h3>
                        <span class="date">{{ date('d.m.Y', strtotime($item->created_at)) }}</span>
                        <a href="/blogs/mot" target="_blank" class="title-category">{{ $item->category->getName() }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>