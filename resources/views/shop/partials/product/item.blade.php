<div class="product-wrapper image1x height-index clickImageUrl product-item-wrapper">
    <div class="product-information">
        <div class="product-detail product-detail-1004310600 height-index-1 background-size newclick">
            <a class="newclick" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}" style="display: block;">
                <div class="product-image" style="position:relative;overflow:hidden;">
                    <img class="image-default image" src="{{ parse_image_url('md_'.$product->getImage()) }}" />
                    @if($product->back_image)
                        <img class="image-hover image" src="{{ parse_image_url($product->back_image) }}" alt="{{ $product->getName() }}" />
                    @else
                        <img class="image-hover image" src="{{ parse_image_url($product->image) }}" alt="{{ $product->getName() }}" />
                    @endif
                </div>
            </a>

            @if(isset($type))
                @if($type == 'hot')
                    <div class="topdeal-tags"></div>
                @elseif($type == 'new')
                    <div class="topbst-tags topdeal-tags"></div>
                @endif
            @endif

            <div class="product-info " >
                <a class="newclick" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
                    <h2>
                        {{ $product->getName() }}
                    </h2>
                </a>
                <div class="price-info clearfix">
                    <div class="price-new-old">
                        <span>{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
