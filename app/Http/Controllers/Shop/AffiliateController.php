<?php

namespace App\Http\Controllers\Shop;

use App\AffiliateUserProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use Cookie;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function getIndex($id, Request $request)
    {
        $affiliateUserProduct = AffiliateUserProduct::where('id', $id)->first();

        if( $affiliateUserProduct )
        {
            Cookie::queue('affiliate_user_product', $id, 60*24*30);

            $product = Product::where('id', $affiliateUserProduct->product_id)->first();

            if( $product )
            {
                return redirect()->to($product->getUrl());
            }
        }

        return redirect()->to('/');
    }
}
