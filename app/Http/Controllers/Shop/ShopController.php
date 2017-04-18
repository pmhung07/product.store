<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\ProductGroup;

class ShopController extends Controller {

    public function __construct()
    {
        // Nhóm sản phẩm làm menu
        $this->categories = ProductGroup::all();
        view()->share('GLB_Categories', $this->categories);
    }
}