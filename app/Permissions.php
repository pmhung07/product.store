<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
	protected $table = 'permissions';

    protected $fillable = ['id', 'parent_id', 'name', 'slug', 'description', 'order'];

    public $timestamps = true;

    public function users() {
    	return $this->hasMany('App\User')->withTimestamps();
	}
}
