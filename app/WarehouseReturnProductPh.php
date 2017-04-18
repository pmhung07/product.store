<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseReturnProductPh extends Model
{
    protected $table = 'warehouse_return_product_ph';

    protected $fillable = ['id', 'order_id', 'warehouse_id', 'code', 'name'];

    public $timestamps = true;

    public function warehouse(){
    	return $this->belongsTo('App\Warehouse');
    }

}
