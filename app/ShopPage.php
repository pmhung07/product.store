<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPage extends Model
{
    protected $table = 'shop_pages';

    protected $guarded = ['id'];

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
