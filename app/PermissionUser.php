<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_user';

    protected $fillable = ['id', 'permission_id', 'user_id'];

    public $timestamps = true;

}
