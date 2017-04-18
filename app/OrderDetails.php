<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['id', 'order_id', 'product_id', 'unit_id', 'quantity','price','total_price'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
