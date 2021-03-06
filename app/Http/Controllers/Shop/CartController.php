<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends ShopController
{

    public function getIndex()
    {
        $cartItems = Cart::content();
        return view('shop/cart/index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $id = (int) $request->get('product_id');
        $qty = (int) $request->get('qty');

        $product = Product::findOrFail($id);
        Cart::add([
            'id' => $id,
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'qty' => $qty,
            'options' => ['product' => $product]
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
