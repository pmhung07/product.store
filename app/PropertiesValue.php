<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesValue extends Model
{
    protected $table = 'properties_value';

    protected $fillable = ['id', 'name', 'properties_id'];

    public $timestamps = true;

}
