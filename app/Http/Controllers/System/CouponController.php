<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Core\CouponFormRequest;
use App\Models\Coupon;
use App\Product;
use App\ProductGroup;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function getIndex(Request $request)
    {
        $query = Coupon::whereRaw(1);

        $code = clean($request->get('code'));
        if($code) {
            $query->where('code', $code);
        }

        $coupons = $query->orderBy('updated_at', 'DESC')->paginate(20);

        return view('system/coupon/index', compact('coupons'));
    }

    public function getCreate()
    {
        $coupon = new Coupon;
        return view('system/coupon/create', compact('coupon'));
    }

    public function postCreate(CouponFormRequest $request)
    {
        $productId = clean($request->get('product_id'));
        $productGroupId = clean($request->get('product_group_id'));

        $coupon = new Coupon();
        $coupon->code = clean($request->get('code'));
        $coupon->value = clean($request->get('value'));
        $coupon->type_value = clean($request->get('type_value'));
        $coupon->type = clean($request->get('type'));
        $coupon->creator_id = $request->user()->id;

        if($productId) {
            $coupon->data = serialize(explode(',', $productId));
        }

        if($productGroupId) {
            $coupon->data = serialize(explode(',', $productGroupId));
        }

        $coupon->save();

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function getUpdate($id)
    {
        $coupon = Coupon::findOrFail($id);

        $productGroupSelected = [];
        $productSelected = [];

        if($coupon->type == Coupon::TYPE_PRODUCT_GROUP) {
            $productGroupId = unserialize($coupon->data);
            $productGroupCollection = ProductGroup::whereIn('id', $productGroupId)->get();
            foreach($productGroupCollection as $item) {
                $productGroupSelected[] = [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            }
        }
        elseif($coupon->type == Coupon::TYPE_PRODUCT) {
            $productId = unserialize($coupon->data);
            $productCollection = Product::whereIn('id', $productId)->get();
            foreach($productCollection as $item) {
                $productSelected[] = [
                    'id' => $item->id,
                    'name' => $item->name
                ];
            }
        }

        return view('system/coupon/edit', compact('coupon', 'productGroupSelected', 'productSelected'));
    }

    public function postUpdate($id, CouponFormRequest $request)
    {
        $productId = clean($request->get('product_id'));
        $productGroupId = clean($request->get('product_group_id'));

        $coupon = Coupon::findOrFail($id);
        $coupon->code = clean($request->get('code'));
        $coupon->value = clean($request->get('value'));
        $coupon->type_value = clean($request->get('type_value'));
        $coupon->type = clean($request->get('type'));
        $coupon->creator_id = $request->user()->id;

        if($productId) {
            $coupon->data = serialize(explode(',', $productId));
        }

        if($productGroupId) {
            $coupon->data = serialize(explode(',', $productGroupId));
        }

        $coupon->save();

        return response()->json([
            'code' => 1,
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);
    }

    public function getDelete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('system.coupon.index')->with('success', 'Xóa thành công');
    }

    public function ajaxSearchProduct(Request $request)
    {
        $q = clean($request->get('q'));

        $products = Product::where('name', 'LIKE', '%'. $q .'%')->take(20)->orderBy('updated_at', 'DESC')->get();

        $json = [];

        foreach($products as $product) {
            $json[] = [
                'id' => $product->id,
                'name' => $product->name
            ];
        }

        return response()->json($json);
    }


    public function ajaxSearchProductGroup(Request $request)
    {
        $q = clean($request->get('q'));

        $groups = ProductGroup::where('name', 'LIKE', '%'. $q .'%')->take(20)->orderBy('updated_at', 'DESC')->get();

        $json = [];

        foreach($groups as $item) {
            $json[] = [
                'id' => $item->id,
                'name' => $item->name
            ];
        }

        return response()->json($json);
    }
}
