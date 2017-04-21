<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Routing\Controller;

class ProvinceController extends Controller {

    /**
     * Danh sách thành phố
     * @return string
     */
    public function getIndex()
    {
        return response()->json([
            'total' => \DB::table('provinces')->count(),
            'data' => \DB::table('provinces')->orderBy('name', 'ASC')->get()
        ]);
    }

    /**
     * Danh sách quận huyện thuộc thành phố
     * @param  integer $id ProvinceID
     * @return string
     */
    public function getDistricts($id)
    {
        return response()->json([
            'total' => \DB::table('districts')->where('province_id', $id)->count(),
            'data' => \DB::table('districts')->where('province_id', $id)->orderBy('name', 'ASC')->get()
        ]);
    }
}