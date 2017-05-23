<?php

namespace App\Http\Controllers\Shop;

use App\Hocs\Metadata;
use App\Http\Controllers\Controller;
use App\Models\SettingWebsite;
use App\ProductGroup;

class ShopController extends Controller {

    public function __construct()
    {
        // Nhóm sản phẩm làm menu
        $this->categories = ProductGroup::all();
        view()->share('GLB_Categories', $this->categories);

        // Cấu hình chung website
        $this->setting = SettingWebsite::where('merchant_id', 1)->firstOrNew([]);
        view()->share('GLB_Setting', $this->setting);

        // Metadata
        $this->metadata = new Metadata();
    }
}