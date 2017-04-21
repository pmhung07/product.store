<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPost extends Model
{
    protected $table = 'shop_posts';

    protected $fillable = ['id', 'category_id', 'admin_id', 'title', 'content', 'teaser', 'image', 'active', 'meta_title', 'meta_keyword', 'meta_description'];

    public function category()
    {
        return $this->belongsTo('App\ShopPostCategories', 'category_id');
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

    public function getUrl()
    {
        return route('shop.post.detail', [$this->getId(), $this->getSlug()]);
    }
}
