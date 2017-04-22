<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['id', 'name'];
    public $timestamps = true;

    public function districts()
    {
        return $this->hasMany('App\Districts', 'province_id');
    }
}
