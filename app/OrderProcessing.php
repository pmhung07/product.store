<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProcessing extends Model
{
    protected $table = 'order_processing';

    protected $fillable = ['id', 'order_id', 'user_id', 'status', 'order_status','lading_status','note','report'];

    public $timestamps = true;

    public function orders(){
    	return $this->belongsTo('App\Orders');
    }
}
