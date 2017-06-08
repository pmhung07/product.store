@if($warehouses->count() > 0)
    <div class="deliver-top withStore">
        <div class="countstocks">Hệ thống {{ $warehouses->count() }} cửa hàng</div>
        <div class="hidden"><a class="storemulticlick clickmultistock" data-toggle="modal" data-target="#myModalmultistock" href="#">bấm để xem danh sách</a></div>
        <div class="chontinhthanh">
            <select id="tinhthanh">
                <option value="">Tỉnh/Thành phố</option>
                @foreach($provinces as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div id="stock-box" class="">
            @foreach($warehouses as $item)
                {!! view('shop/product/stock_item', ['stock' => $item])->render() !!}
            @endforeach
        </div>
    </div>
@endif