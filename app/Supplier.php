<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = ['id', 'name', 'phone', 'email', 'address'];

    public $timestamps = true;

    public function warehouse_ph(){
    	return $this->hasMany('App\warehouse_ph');
    }
}
