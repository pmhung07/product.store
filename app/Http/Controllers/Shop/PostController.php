<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use App\ShopPostCategories;
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

        // Tất cả danh mục tin tức
        $postCategories = ShopPostCategories::all();
        foreach($postCategories as $category) {
            // 2 bài nổi bật
            $hotPosts = ShopPost::where('category_id', $category->getId())->orderByRaw('RAND()')->take(2)->get();
            $category->hotPosts = $hotPosts;

            // 5 bài mới
            if($hotPosts->count()) {
                $newPosts = ShopPost::whereNotIn('id', $hotPosts->lists('id'))->orderBy('created_at', 'DESC')->take(5)->get();
            } else {
                $newPosts = ShopPost::orderBy('created_at', 'DESC')->take(5)->get();
            }
            $category->newPosts = $newPosts;
        }

        // 5 bài hot trên top
        $hotPosts = ShopPost::with('category')->orderByRaw('RAND()')->take(5)->get();

        return view('shop/post/index', compact('category', 'hotPosts', 'posts', 'postCategories'));
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
