@extends('shop/layout/default')

@section('content')
<div class="container wow fadeIn" style="padding-top: 50px;">
    <div class="collection-index-1 color2 clearfix">
        <div class="row">
            <div class="col-xs-12 col-lg-3">
                <div class="collection-option-filter" id="collection-option-filter">
                    <div class="catalog_filters_module tags">
                        <ul class="main_item_left list-unstyled">
                            @foreach($GLB_Categories as $item)
                                <li class="item">
                                    <a href="{{ $item->getUrl() }}">{{ $item->getName() }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-9">
                <div class="collec-quickview-top topbar">
                    <span class="first">Bạn đang xem: </span><span class="checkedvalactive">{{ $category->getName() }}</span> <span class="checkedval"></span>
                </div>
                <div class="product-item product-index clearfix active left-border" id="product-lists" style="margin-bottom:20px" >
                    @foreach($products as $item)
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            {!! view('shop/partials/product/item', ['product' => $item])->render() !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop