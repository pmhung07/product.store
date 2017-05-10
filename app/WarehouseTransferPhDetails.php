<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseTransferPhDetails extends Model
{
    protected $table = 'warehouse_transfer_ph_details';

    protected $fillable = ['id', 'transfer_ph_id','product_id', 'quantity'];

    public $timestamps = true;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
