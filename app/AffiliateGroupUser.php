<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateGroupUser extends Model
{
    protected $table = 'affiliate_group_user';

    protected $fillable = ['id', 'affiliate_group_id', 'user_id','leader','active','admin_id'];

    public $timestamps = true;
}
