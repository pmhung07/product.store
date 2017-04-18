<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehousePhDetails extends Model
{
    protected $table = 'warehouse_ph_details';

    protected $fillable = ['id', 'warehouse_ph_id', 'product_id', 'unit_id', 'quantity','price','total_price'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
