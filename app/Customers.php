<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    protected $fillable = ['id', 'province_id', 'district_id','name', 'email', 'phone','address', 'birthdate', 'gender'];

    public $timestamps = true;

    public function provinces(){
		return $this->belongsTo('App\Provinces');
	}

	public function districts(){
		return $this->belongsTo('App\Districts');
	}

	public function orders(){
		return $this->hasMany('App\Orders');
	}
}
