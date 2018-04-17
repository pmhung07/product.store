<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\ShopPost;
use App\ShopPostCategories;
use App\Product;
use Illuminate\Http\Request;

class PostController extends ShopBlogController
{

    /**
     * Tin tức
     * @return string
     */
    public function getIndex(Request $request)
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
                $newPosts = ShopPost::where('category_id', $category->getId())->orderBy('created_at', 'DESC')->take(5)->get();
            }
            $category->newPosts = $newPosts;
        }

        // 5 bài hot trên top
        $hotPosts = ShopPost::with('category')->orderByRaw('RAND()')->take(5)->get();

        $this->metadata->title = 'Tin tức, Blog';
        $this->metadata->description = 'Tin tức, Blog';
        $this->metadata->image = $this->setting->logo ? url(parse_image_url($this->setting->logo)) : '';
        $this->metadata->url = $request->url();
        $metadata = $this->metadata->toArray();

        return view('shop/post/index', compact('category', 'hotPosts', 'posts', 'postCategories', 'metadata'));
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
        $relatedProduct = Product::orderBy('updated_at', 'DESC')->limit(4)->get();

        // Metadata
        $this->metadata->title = $post->meta_title ? $post->meta_title : $post->title;
        $this->metadata->description = substr(strip_tags($post->meta_description ? $post->meta_description : $post->content), 0, 200);
        $this->metadata->image = $post->image ? url(parse_image_url($post->image)) : '';
        $this->metadata->url = $post->getUrl();
        $metadata = $this->metadata->toArray();

        return view('shop/post/detail', compact('post', 'relatedPosts', 'metadata', 'relatedProduct'));
    }
}
