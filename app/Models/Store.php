<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';

    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo('App\Provinces', 'province_id');
    }

    public function district()
    {
        return $this->belongsTo('App\Districts', 'district_id');
    }
}
