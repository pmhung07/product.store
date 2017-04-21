<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPostCategories extends Model
{
    protected $table = 'shop_post_categories';

    protected $fillable = ['id', 'name', 'parent_id', 'slug'];

    public $timestamps = true;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return removeTitle($this->getName());
    }

    public function getUrl()
    {
        return route('shop.post_category.posts', [$this->getId(), $this->getSlug()]);
    }
}
