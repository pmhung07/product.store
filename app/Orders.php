<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id', 'customer_id', 'payment_method_id','channel_id', 'code', 'order_status','lading_status', 'total_price', 'created_at'];

    public $timestamps = true;

    public function product(){
		return $this->belongsToMany('App\Product');
	}
	//note
	public function customers(){
		return $this->belongsTo('App\Customers','customer_id');
	}

	public function payment_methods(){
		return $this->belongsTo('App\PaymentMethods');
	}
	
	public function channel(){
		return $this->belongsTo('App\Channel');
	}
}
