<div class="owl-carousel owl-theme" id="slide-image">
    <div class="item itemdelete lazy"
        data-original="{{ parse_image_url($product->image) }}"
        data-option="do">
        <a href="{{ parse_image_url($product->image) }}"
            title="Click để xem"
            data-option="do"
            data-image="{{ parse_image_url($product->image) }}"
            data-zoom-image="{{ parse_image_url($product->image) }}"
            rel="lightbox-do">
            <img class="image-product-carousel"  src="{{ parse_image_url('md_'.$product->image) }}"/>
            <p class="click-p" href="{{ parse_image_url($product->image) }}"
                data-zoom-image="{{ parse_image_url($product->image) }}"
                rel="lightbox-do" >
            </p>
        </a>
    </div>
    <?php foreach($product->images as $item): ?>
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
            <p class="click-p" href="{{ parse_image_url($item->image) }}"
                data-zoom-image="{{ parse_image_url($item->image) }}"
                rel="lightbox-do" >
            </p>
        </a>
    </div>
    <?php endforeach; ?>
</div>

<div class="thumbnails-hidden">
    @foreach($product->images as $item)
    <a rel="gallery-1" class="swipebox thumbnail thumdelete" href="{{ parse_image_url($item->image) }}">
        <img src="{{ parse_image_url('sm_'.$item->image) }}">
    </a>
    @endforeach
</div>