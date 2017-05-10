<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateUserOrderLogs extends Model
{
    protected $table = 'affiliate_user_order_logs';

    protected $fillable = ['id', 'order_id', 'user_id'];

    public $timestamps = true;
}
