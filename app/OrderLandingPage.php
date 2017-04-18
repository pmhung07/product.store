<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLandingPage extends Model
{
    protected $table = 'orders_landingpage';

    protected $fillable = ['id', 'site_id', 'customer_name','customer_phone', 'status', 'order_status'];

    public $timestamps = true;

}
