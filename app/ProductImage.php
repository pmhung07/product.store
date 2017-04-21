<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public $timestamps = false;

    protected $guarded = ['id'];
}
