<div id="descriptionproduct" class="wow fadeIn" style="margin-top:20px;min-height: 294px;">
    <div class="clearfix">
        <div class="">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                @if($product->getContent())
                    <li role="presentation" class="active"><a href="#tab-product-info" aria-controls="tab-product-info" role="tab" data-toggle="tab">Thông tin sản phẩm</a></li>
                @endif

                @if($product->spec)
                    <li role="presentation"><a href="#tab-product-spec" aria-controls="tab-product-spec" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
                @endif

                @if($product->introduce)
                    <li role="presentation"><a href="#tab-product-introduce" aria-controls="tab-product-introduce" role="tab" data-toggle="tab">Hướng dẫn sử dụng</a></li>
                @endif
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                @if($product->getContent())
                    <div role="tabpanel" class="tab-pane active" id="tab-product-info">{!! $product->getContent() !!}</div>
                @endif

                @if($product->spec)
                    <div role="tabpanel" class="tab-pane" id="tab-product-spec">{!! $product->spec !!}</div>
                @endif

                @if($product->introduce)
                    <div role="tabpanel" class="tab-pane" id="tab-product-introduce">{!! $product->introduce !!}</div>
                @endif
            </div>
        </div>
    </div>
</div>