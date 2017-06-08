@if($relatedProducts->count() > 0)
    <div class="sec-related-product">
        <h5 class="sec-heading">
            <span>Sản phẩm có thể bạn quan tâm</span>
        </h5>
        <div class="row">
            @foreach($relatedProducts as $item)
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-24">
                    {!! view('shop/partials/product/item', ['product' => $item, 'type' => ''])->render() !!}
                </div>
            @endforeach
        </div>
    </div>
@endif