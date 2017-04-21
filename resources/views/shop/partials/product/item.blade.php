<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4 product-wrapper image1x height-index clickImageUrl product-item-wrapper" >
    <div class="product-information">
        <div class="product-detail product-detail-1004310600 height-index-1 background-size newclick">
            <a class="newclick" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
                <div class="product-image" style="position:relative;overflow:hidden;">
                    <img class="image-default image" src="{{ parse_image_url('md_'.$product->image) }}" />
                    <img class="image-hover image" src="{{ parse_image_url($product->image) }}" alt="{{ $product->getName() }}" />
                </div>
            </a>
            {{-- <div class="topdeal-tags"></div> --}}
            <div class="product-info " >
                <a class="newclick" href="/single-product.php" title="{{ $product->getName() }}">
                    <h2>
                        {{ $product->getSku() }}
                    </h2>
                </a>
                <div class="price-info clearfix">
                    <div class="price-new-old">
                        <span>{{ formatCurrency($product->getPrice()) }}<sup>đ</sup></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapBtn col-md-10 buttoncart">
            <div class="product-buy">
                <a class="quick-view" data-title="{{ $product->getName() }}" href="javascript:;" data-id="{{ $product->getId() }}" data-sku="{{ $product->getSku() }}">
                    <span>Mua Nhanh</span>
                </a>
            </div>
        </div>
    </div>
</div>