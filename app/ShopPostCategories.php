<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPostCategories extends Model
{
    protected $table = 'shop_post_categories';

    protected $fillable = ['id', 'name', 'parent_id', 'slug'];

    public $timestamps = true;
}
