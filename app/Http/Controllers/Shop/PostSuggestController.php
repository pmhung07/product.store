<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use App\ShopPost;
use App\ShopPostCategories;
use App\ShopPostSuggest;
use App\ProductGroup;
use Illuminate\Http\Request;

class PostSuggestController extends ShopBlogController
{

    /**
     * Tin tức
     * @return string
     */

    /**
     * Chi tiết tin tức
     * @param  integer $id
     * @param  string $slug
     * @return string
     */
    public function getDetail($id, $slug)
    {
        $post = ShopPostSuggest::with('category')->findOrFail($id);
        //$product = Product::with('category', 'images')->find($post->category_id);

        // Tin cùng chuyên mục
        $relatedProduct = Product::where('product_group_id', $post->product_group_id)->orderBy('updated_at', 'DESC')->take(10)->get();
        $relatedPosts = ShopPostSuggest::where('product_group_id', $post->product_group_id)->whereNotIn('id', [$post->id])->orderBy('updated_at', 'DESC')->take(10)->get();

        // Metadata
        $this->metadata->title = $post->meta_title ? $post->meta_title : $post->title;
        $this->metadata->description = substr(strip_tags($post->meta_description ? $post->meta_description : $post->content), 0, 200);
        $this->metadata->image = $post->image ? url(parse_image_url($post->image)) : '';
        $this->metadata->url = $post->getUrl();
        $metadata = $this->metadata->toArray();

        return view('shop/post_suggest/detail', compact('post', 'metadata', 'relatedPosts', 'relatedProduct'));
    }
}
