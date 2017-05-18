<?php

namespace App\Http\Controllers\Shop\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\VariantCombination;
use App\Models\VariantValue;
use App\Product;
use App\Properties;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getQuickView(Request $request)
    {
        $productId = (int) $request->get('product_id');
        $product = Product::findOrFail($productId);

        // Variant
        $properties = Properties::with('values')->where('product_id', $product->id)->get();

        return view('shop/product/quickview', compact('product', 'properties'));
    }

    /**
     * Thông tin biến thể
     * @param  Request $request
     * @return json
     */
    public function getVariant(Request $request)
    {
        $variantIdsString = $request->get('value_ids');
        $variantIds = explode(',', $variantIdsString);
        foreach($variantIds as $k => &$value) {
            if(!$value) unset($variantIds[$k]);
            $value = (int) $value;
        }
        unset($value);
        asort($variantIds);

        $productId = (int) $request->get('product_id');

        $variant = Product::join('variant_values', 'product.id', '=', 'variant_values.variant_id')
                           ->where('variant_values.values_int', implode('', $variantIds))
                           ->select('product.*')
                           ->first();

        if($variant) {
            return response()->json([
                'code' => 200,
                'variant' => [
                    'id' => $variant->id,
                    'price' => $variant->price,
                    'sku' => $variant->sku,
                    'image' => [
                        'large' => parse_image_url('lg_' . $variant->image),
                        'medium' => parse_image_url('md_' . $variant->image),
                        'small' => parse_image_url('sm_' . $variant->image)
                    ]
                ]
            ]);
        } else {
            return response()->json([
                'code' => 404
            ]);
        }
    }
}
