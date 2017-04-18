<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = ['id', 'product_id', 'value'];

    public $timestamps = true;

    public function product(){
		return $this->belongsTo('App\Product');
	}
}
