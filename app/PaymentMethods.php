<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = ['id', 'name', 'status'];

    public $timestamps = true;

    public function orders(){
		return $this->hasMany('App\Orders');
	}

}
