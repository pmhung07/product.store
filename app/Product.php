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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return removeTitle($this->getName());
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getUrl()
    {
        return route('shop.product.detail', [$this->getId(), $this->getSlug()]);
    }

}
