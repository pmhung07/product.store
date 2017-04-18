<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';

    protected $fillable = ['id', 'name'];

    public $timestamps = true;

    public function product(){
    	$this.hasMany('App\Product');
    }
}
