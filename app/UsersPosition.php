<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPosition extends Model
{
    protected $table = 'users_position';
    protected $fillable = ['id', 'name', 'permissions_default', 'active', 'fixed'];
    public $timestamps = true;
}
