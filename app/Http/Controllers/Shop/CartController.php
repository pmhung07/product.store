<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends ShopController
{

    public function getIndex(Request $request)
    {
        $cartItems = Cart::content();

        $this->metadata->title = 'Giỏ hàng';
        $this->metadata->description = 'Giỏ hàng, lưu thông tin sản phẩm bạn đã chọn mua';
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/cart/index', compact('cartItems', 'metadata'));
    }

    public function addToCart(Request $request)
    {
        $id = (int) $request->get('product_id');
        $qty = (int) $request->get('qty');
        $sku = $request->get('variant_sku');

        // Nếu là sản phẩm con thì phải xác định ngay
        if(!$sku) {
            $product = Product::findOrFail($id);
        } else {
            $product = Product::where('sku', $sku)->first();
        }

        Cart::add([
            'id' => $product->id,
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'qty' => $qty,
            'options' => [
                'product' => $product,
                'is_variant' => $sku ? true : false
            ]
        ]);

        return redirect()->route('shop.cart.index')->with('success', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('shop.cart.index')->with('success', 'Cập nhật thành công');
    }

    public function ajaxUpdate(Request $request)
    {
        $data = (array) $request->get('data');

        foreach($data as $rowId => $qty) {
            Cart::update($rowId, $qty);
        }

        return response()->json(['code' => 1]);
    }

    public function clear()
    {
        Cart::destroy();
        return redirect()->route('shop.cart.index')->with('success', 'Cập nhật thành công');
    }
}
