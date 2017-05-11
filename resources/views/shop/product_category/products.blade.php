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
                                @if($item->parent_id == 0)
                                    <li class="item {{ $item->id == $category->id || $item->id == $category->parent_id ? 'active' : '' }}">
                                        <a href="{{ $item->getUrl() }}">{{ $item->getName() }}</a>
                                        <?php
                                            $_categoryChilds = App\ProductGroup::where('parent_id', $item->id)->get();
                                        ?>
                                        @if($_categoryChilds->count() > 0)
                                            <div class="catalog_filters filter-tag bupbe">
                                                <ul class="check-box-list list-unstyled">
                                                    @foreach($_categoryChilds as $childItem)
                                                    <li class="advanced-filter {{ $childItem->id == $category->id ? 'check' : '' }}">
                                                        <a class="tag-choise" href="{{ $childItem->getUrl() }}">{{ $childItem->name }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endif
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