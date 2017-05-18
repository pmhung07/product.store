<div class="stock-item" data-id="{{ $stock->id }}">
    <span class="dist">{{ is_object($stock->district) ? $stock->district->name : '--' }}: </span>
    <span class="street">{{ $stock->address }}</span>
</div>