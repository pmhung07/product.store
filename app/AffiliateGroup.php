<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateGroup extends Model
{
    protected $table = 'affiliate_group';

    protected $fillable = ['id', 'name', 'active','admin_id'];

    public $timestamps = true;
}
