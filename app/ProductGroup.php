<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $table = 'product_group';

    protected $fillable = ['id', 'name', 'parent_id', 'description'];

    public $timestamps = true;

    public function product_group(){

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

    public function getUrl()
    {
        return route('shop.category.products', [$this->getId(), $this->getSlug()]);
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'products_groups', 'group_id', 'product_id');
    }
}
