<div class="stock-item" data-id="{{ $stock->id }}">
    <span class="dist">{{ is_object($stock->district) ? $stock->district->name : '--' }}: </span>
    <span class="street">{{ $stock->address }}</span>
    <p class="link hide">
        <a href="/products/280-282-nguyen-oanh-phuong-17-quan-go-vap?view=storenew2" target="_blank">  (Xem bản đồ)</a>
    </p>
</div>