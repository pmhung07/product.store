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
}
