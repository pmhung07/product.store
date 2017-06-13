<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPage;
use App\ShopPost;
use App\ShopPostCategories;
use Illuminate\Http\Request;

class PageController extends ShopBlogController
{
    public function getDetail($id, $slug, Request $request)
    {
        $page = ShopPage::findOrFail($id);

        $this->metadata->title = $page->meta_title ? $page->meta_title : $page->title;
        $this->metadata->description = $page->meta_description ? $page->meta_description : $page->teaser;
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/page/detail', compact('page', 'metadata'));
    }
}