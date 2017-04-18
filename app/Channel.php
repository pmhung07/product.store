<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channel';

    protected $fillable = ['id', 'name', 'link','name', 'status'];

    public $timestamps = true;

    public function orders(){
		return $this->hasMany('App\Orders');
	}
}
