<?php

namespace App\Http\Controllers\Shop\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function check($code, Request $request)
    {
        $coupon = Coupon::where('code', $code)->first();
        if(!$coupon) {
            return response()->json(['code' => 404, 'message' => 'Mã này không tồn tại, vui lòng nhập mã khác nếu có']);
        }

        return response()->json(['code' => 200]);
    }
}
