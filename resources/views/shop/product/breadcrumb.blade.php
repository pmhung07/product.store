<ol class="breadcrumb" style="padding-left: 0">
    <li class="home"> <a href="{{ url('/') }}" title="Trang chủ">Trang chủ</a></li>
    <li class="space"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
    <li class="collections">
        <a href="{{ is_object($product->category) ? $product->category->getUrl() : url('/') }}">{{ is_object($product->category) ? $product->category->name : 'Uncategory' }}</a>
    </li>
    <li class="space"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
    <li class="product active">
        <a href="{{ $product->getUrl() }}">{{ $product->name }}</a>
    <li>
</ol>