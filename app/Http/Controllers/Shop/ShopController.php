<?php

namespace App\Http\Controllers\Shop;

use App\Hocs\Metadata;
use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\SettingWebsite;
use App\ProductGroup;

class ShopController extends Controller {

    public function __construct()
    {
        // Nhóm sản phẩm làm menu footer
        $this->categories = ProductGroup::all();
        view()->share('GLB_Categories', $this->categories);

        // Menu
        $this->menus = Navigation::orderBy('sort', 'DESC')->where('active', 1)->get();
        $this->menus  = (new \App\Hocs\Sortable\Sortable($this->menus))->getData();
        view()->share('GLB_Menus', $this->menus);

        // Cấu hình chung website
        $this->setting = SettingWebsite::where('merchant_id', 1)->firstOrNew([]);
        view()->share('GLB_Setting', $this->setting);

        // Metadata
        $this->metadata = new Metadata();
    }
}