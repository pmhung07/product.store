<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['id', 'name'];

    public $timestamps = true;

}
