<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffliateUserProductLogs extends Model
{
    protected $table = 'affiliate_user_product_logs';

    protected $fillable = ['id', 'user_id','affiliate_user_order_logs_id','order_id','product_id','product_quantity','current_price','current_profit','profit_price	'];

    public $timestamps = true;
}
