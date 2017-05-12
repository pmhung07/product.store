<?php

namespace App\Http\Controllers\Shop\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\VariantCombination;
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
        $productId = (int) $request->get('product_id');

        // Find all childs
        // Tìm trong tất cả sản phẩm con, tìm tiếp sp con đó có những giá trị gì.
        // So sánh giá trị đó với giá trị truyền vào nếu khớp thì lấy sản phẩm đó ra
        $childs = Product::where('parent_id', $productId)->get();

        foreach($childs as $item) {
            $variant = VariantCombination::where('product_id', $item->id)->lists('value_id')->toArray();
            asort($variant);
            asort($variantIds);
            if(implode(',', $variant) == implode(',', $variantIds)) {
                return response()->json([
                    'id' => $item->id,
                    'price' => $item->price,
                    'sku' => $item->sku,
                    'image' => [
                        'large' => parse_image_url('lg_' . $item->image),
                        'medium' => parse_image_url('md_' . $item->image),
                        'small' => parse_image_url('sm_' . $item->image)
                    ]
                ]);
            }
        }
    }
}
