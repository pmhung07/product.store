@extends('shop/layout/default')

@section('content')
<section id="store-container">
    <div class="container">
        <div class="row top-store">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <h1>Hệ thống cửa hàng của chúng tôi</h1>
                <ul class="list-unstyled">
                    @foreach($stores as $k => $store)
                        <li class="store-item">
                            <p><a href="{{ route('shop.store.detail', $store->id) }}" class="store-link">{{ ($k+1) }} .{{ $store->name }}</a></p>
                            <p>Địa chỉ: {{ $store->address }}</p>
                            <p>Số điện thoại: {{ $store->phone }}</p>
                        </li>
                    @endforeach
                </ul>
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
<!--popup content-->
@stop