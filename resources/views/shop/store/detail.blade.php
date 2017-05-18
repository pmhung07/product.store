@extends('shop/layout/default')

@section('content')
<section id="store-detail-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <h1 class="name">Cửa hàng {{ $store->name }}</h1>
                <div class="content">{!! $store->content !!}</div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h2>Sản phẩm mới nhất</h2>
                <ul class="list-unstyled product-section">
                    @foreach($products as $k => $item)
                        <li class="product-item">
                            <a class="link" href="{{ $item->getUrl() }}" title="{{ $item->name }}">
                                <img class="img" src="{{ parse_image_url('md_'. $item->image) }}" alt="{{ $item->name }}">
                                <div class="info">
                                    <span class="price">{{ formatCurrency($item->price) }}</span>
                                    <span class="name">{{ $item->name }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@stop