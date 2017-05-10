<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateProduct extends Model
{
    protected $table = 'affiliate_product';

    protected $fillable = ['id', 'product_id', 'profit','admin_id'];

    public $timestamps = true;
}
