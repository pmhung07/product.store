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
}
