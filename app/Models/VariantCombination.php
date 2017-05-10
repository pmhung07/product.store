<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantCombination extends Model
{
    protected $table = 'variant_combination';

    protected $guarded = ['id'];

    public $timestamps = false;
}
