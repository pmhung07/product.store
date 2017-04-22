<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use Illuminate\Http\Request;

class PostController extends ShopBlogController
{

    public function getDetail($id, $slug)
    {
        $post = ShopPost::with('category')->findOrFail($id);

        // Tin cùng chuyên mục
        $relatedPosts = ShopPost::with('category')
                         ->where('category_id', $post->category_id)
                         ->take(8)
                         ->orderBy('created_at', 'DESC')
                         ->get();

        return view('shop/post/detail', compact('post', 'relatedPosts'));
    }
}
