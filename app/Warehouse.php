<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';

    protected $fillable = ['id', 'province_id', 'district_id', 'code', 'name', 'address'];

    public $timestamps = true;

    public function warehouseph(){
    	return $this->hasMany('App\WarehousePh');
    }

    public function province()
    {
        return $this->belongsTo('App\Provinces', 'province_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Districts', 'district_id');
    }
}
