<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsProductInStock extends Model
{
    protected $table = 'order_details_product_in_stock';

    protected $fillable = ['id', 'order_id', 'product_id', 'quantity_sub','price_in'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
