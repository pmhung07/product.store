<div class="top-container border-bot">
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 menu" style="padding:0px">
            <ul>
                @foreach($GLB_PostCategories as $item)
                    <li class="-menu-blog" style="float:left;padding: 0 10px"><a style="color:#000;text-transform:uppercase;font-family:'SFU'" href="{{ $item->getUrl() }}">{{ $item->getName() }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>