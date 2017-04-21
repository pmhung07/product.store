<div class="top-container border-bot">
    <div>
        <div class="col-lg-4 col-md-4 col-sm-10 menu" style="padding:0px">
            <ul>
                @foreach($GLB_PostCategories as $item)
                    <li class="-menu-blog" style="float:left;padding: 0 10px"><a style="color:#000;text-transform:uppercase;font-family:'SFU'" href="{{ $item->getUrl() }}">{{ $item->getName() }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-10" >
            <p style="float:right" class="hidden-xs hidden-sm">
                <span>Khám phá, tận hưởng niềm đam mê thời trang và làm đẹp mỗi ngày</span>
            </p>
        </div>
    </div>
</div>