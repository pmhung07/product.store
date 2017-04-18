<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'users';

    protected $fillable = ['id', 'user', 'name', 'email', 'identity_card_number'];

    public $timestamps = true;

}
