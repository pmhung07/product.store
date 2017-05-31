<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use App\ShopPostCategories;
use Illuminate\Http\Request;

class PostCategoryController extends ShopBlogController
{

    public function getPosts($id, $slug, Request $request)
    {
        $category = ShopPostCategories::findOrFail($id);

        $posts = ShopPost::where('category_id', $id)->orderBy('updated_at', 'DESC')->paginate(20);

        $this->metadata->title = $category->name;
        $this->metadata->description = $category->name;
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/post_category/posts', compact('category', 'posts', 'metadata'));
    }
}
