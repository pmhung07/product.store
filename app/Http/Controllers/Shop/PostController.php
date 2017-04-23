<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use Illuminate\Http\Request;

class PostController extends ShopBlogController
{

    /**
     * Tin tức
     * @return string
     */
    public function getIndex()
    {
        $posts = ShopPost::orderBy('updated_at', 'DESC')->paginate(20);

        return view('shop/post_category/posts', compact('category', 'posts'));
    }

    /**
     * Chi tiết tin tức
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
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
