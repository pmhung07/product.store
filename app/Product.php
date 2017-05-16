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

    public function getImage()
    {
        return $this->image;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUrl()
    {
        return route('shop.product.detail', [$this->getId(), $this->getSlug()]);
    }

    public function hasChild()
    {
        return $this->where('parent_id', $this->id)->count() ? true : false;
    }

    public function category()
    {
        return $this->belongsTo('App\ProductGroup', 'product_group_id');
    }

    public function images()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }

    public function variants()
    {
        return $this->hasMany('App\Product', 'parent_id');
    }

}
