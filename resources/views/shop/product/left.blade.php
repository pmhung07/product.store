<div class="" id="slide-image">
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
    <?php
        $productImages = new Illuminate\Support\Collection();
        if($product->hasChild()) {
            $productImages = $product->variants()->get();
        } else {
            $productImages = $product->images()->get();
        }
    ?>
    <?php foreach($productImages as $item): ?>
       {{--  <div class="item itemdelete lazy"
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
        </div> --}}
    <?php endforeach; ?>
</div>

<div class="thumbnails-hidden" style="overflow: hidden;">
    <div class="product-thumbs-slider" data-count_items="{{ $productImages->count() }}">
        @foreach($productImages as $k => $item)
        <a rel="gallery-1" class="thumb-item-image swipebox thumbnail thumdelete {{ $k == $productImages->count()-1 ? 'last' : '' }}" href="{{ parse_image_url($item->image) }}">
            <img src="{{ parse_image_url('sm_'.$item->image) }}">
        </a>
        @endforeach
    </div>
    <div class="slider-controls">
        <span class="left">&lsaquo;</span>
        <span class="right">&rsaquo;</span>
    </div>
</div>