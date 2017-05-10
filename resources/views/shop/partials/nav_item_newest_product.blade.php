<li class="menu-hover-li newest">
    <div class="col-lg-12 col-md-12 menu-back-new">
        <span class="menu-title-new" >Mới nhất hôm nay</span>
    </div>
    <div class="col-lg-12 col-md-12" style="padding-right:5px">
        <div class="col-lg-5 col-md-5" style="padding:0">
            <a class="link-image" href="{{ $product->getUrl() }}" target="_blank">
                <img class="image" src="{{ parse_image_url('md_' . $product->getImage()) }}"/>
            </a>
        </div>
        <div class="col-lg-7 col-md-7 menu-content-new">
            <div style="padding-bottom: 10px;">
                <span class="menu-tilte-pr" >{{ $product->getName() }}</span><br/>
            </div>
            <div class="menu-price-pr">{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></div>
            <a href="{{ $product->getUrl() }}">Xem chi tiết</a>
        </div>
    </div>
</li>