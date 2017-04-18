<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['id', 'product_group_id', 'unit_id', 'name', 'sku', 'barcode', 'price'];

    public $timestamps = true;

    public function inventory(){
    	return $this->hasOne('App\Inventory');
    }

    public function units(){
    	return $this->belongsTo('App\Units','unit_id','id');
    }

    public function orders(){
    	return $this->belongsToMany('App\Orders');
    }

}
