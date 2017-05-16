@extends('shop/layout/default')

@section('content')
<section id="search-container">
    <div class="container">
        <h1>Kết quả tìm kiếm với từ khóa: {{ $q }}</h1>
        <div class="product-container">
            <div class="row">
                <?php foreach($products as $item): ?>
                    <div class="col-xs-12 col-sm-4 col-md-3 col-lg-24">
                        {!! view('shop/partials/product/item', ['product' => $item, 'type' => ''])->render() !!}
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!--popup content-->
@stop