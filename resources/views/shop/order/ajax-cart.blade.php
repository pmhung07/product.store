<table class="table">
    <thead>
        <th scope="col">Hình ảnh</th>
        <th scope="col">Mô tả</th>
        <th scope="col">Giá</th>
    </thead>
    <tbody>
        @foreach($cartItems as $item)
            <tr class="product">
                <td class="product-image">
                    <div class="product-thumbnail">
                        <div class="product-thumbnail-wrapper">
                            <img class="product-thumbnail-image" alt="{{ $item->name }}" src="{{ parse_image_url($item->options->product->image) }}" />
                        </div>
                        <span class="product-thumbnail-quantity" aria-hidden="true">{{ $item->qty }}</span>
                    </div>
                </td>
                <td class="product-description">
                    <span class="product-description-name order-summary-emphasis">{{ $item->name }}</span>
                    <span class="product-description-variant order-summary-small-text">

                    </span>
                </td>
                <td class="product-price">
                    <span class="order-summary-emphasis">{{ formatCurrency($item->price) }}₫</span>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="1"></td>
            <td>Tổng cộng:</td>
            <td>{{ formatCurrency($totalPrice) }}đ</td>
        </tr>
    </tbody>
</table>