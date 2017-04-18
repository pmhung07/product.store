<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseInventory extends Model
{
    protected $table = 'warehouse_inventory';

    protected $fillable = ['id', 'warehouse_ph_id', 'product_id', 'unit_id', 'quantity', 'price'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
