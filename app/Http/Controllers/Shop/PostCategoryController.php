<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use App\ShopPostCategories;
use Illuminate\Http\Request;

class PostCategoryController extends ShopBlogController
{

    public function getPosts($id, $slug)
    {
        $category = ShopPostCategories::findOrFail($id);

        $posts = ShopPost::where('category_id', $id)->orderBy('updated_at', 'DESC')->paginate(20);

        return view('shop/post_category/posts', compact('category', 'posts'));
    }
}
