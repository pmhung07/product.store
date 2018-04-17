<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPostSuggest extends Model
{
    protected $table = 'shop_posts_suggest';

    protected $fillable = ['id', 'product_group_id', 'admin_id', 'title', 'content', 'teaser', 'image', 'active', 'meta_title', 'meta_keyword', 'meta_description'];

    public function category()
    {
        return $this->belongsTo('App\ProductGroup', 'product_group_id');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSlug()
    {
        return removeTitle($this->getTitle());
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTeaser()
    {
        return $this->teaser;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUrl()
    {
        return route('shop.post-suggest.detail', [$this->getId(), $this->getSlug()]);
    }
}
