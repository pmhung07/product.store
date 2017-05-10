<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateUserProduct extends Model
{
    protected $table = 'affiliate_user_product';

    protected $fillable = ['id', 'affiliate_product_id', 'user_id','active'];

    public $timestamps = true;
}
