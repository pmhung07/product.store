<div class="owl-carousel owl-theme" id="slide-image">
    <div id="main-product-image" class="item itemdelete lazy"
        data-original="{{ parse_image_url($product->image) }}"
        data-option="do">
        <a href="{{ parse_image_url($product->image) }}"
            title="Click để xem"
            data-option="do"
            data-image="{{ parse_image_url($product->image) }}"
            data-zoom-image="{{ parse_image_url($product->image) }}"
            rel="lightbox-do">
            <img class="image-product-carousel"  src="{{ parse_image_url('md_'.$product->image) }}"/>
            <p class="click-p"
                data-zoom-image="{{ parse_image_url($product->image) }}"
                rel="lightbox-do" >
            </p>
        </a>
    </div>
    <?php foreach($product->variants()->get() as $item): ?>
        <div class="item itemdelete lazy"
            data-original="{{ parse_image_url($item->image) }}"
            data-option="do">
            <a href="{{ parse_image_url($item->image) }}"
                title="Click để xem"
                data-option="do"
                data-image="{{ parse_image_url($item->image) }}"
                data-zoom-image="{{ parse_image_url($item->image) }}"
                rel="lightbox-do">
                <img  class="image-product-carousel" src="{{ parse_image_url('md_'.$item->image) }}"/>
                <p class="click-p"
                    data-zoom-image="{{ parse_image_url($item->image) }}"
                    rel="lightbox-do" >
                </p>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="thumbnails-hidden" style="overflow: hidden;">
    @foreach($product->variants()->get() as $item)
    <a rel="gallery-1" class="swipebox thumbnail thumdelete" href="{{ parse_image_url($item->image) }}">
        <img src="{{ parse_image_url('sm_'.$item->image) }}">
    </a>
    @endforeach
</div>

@if($product->spec)
<div id="spec">
    <h5 class="heading">
        <span>Thông số kỹ thuật</span>
    </h5>
    <div class="spec-info">{!! $product->spec !!}</div>
</div>
@endif