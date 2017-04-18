<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseReturnProductPhDetails extends Model
{
    protected $table = 'warehouse_return_product_ph_details';

    protected $fillable = ['id', 'warehouse_return_product_id', 'product_id', 'unit_id', 'quantity','price','total_price'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
