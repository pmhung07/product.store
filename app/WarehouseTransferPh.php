<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseTransferPh extends Model
{
    protected $table = 'warehouse_transfer_ph';

    protected $fillable = ['id', 'admin_id', 'warehouse_root', 'warehouse_destination', 'code', 'name'];

    public $timestamps = true;

    public function warehouse(){
    	return $this->belongsTo('App\Warehouse');
    }

}
