<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehousePh extends Model
{
    protected $table = 'warehouse_ph';

    protected $fillable = ['id', 'supplier_id', 'warehouse_id', 'code', 'name'];

    public $timestamps = true;

    public function warehouse(){
    	return $this->belongsTo('App\Warehouse');
    }

}
