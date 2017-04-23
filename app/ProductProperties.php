<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
    protected $table = 'product_properties';

    protected $fillable = ['id', 'product_id', 'properties_id','properties_value_id', 'image'];

    public $timestamps = true;

}
