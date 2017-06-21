<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_template';
    protected $primaryKey = 'id';
    protected $guarded = ['id', '_token'];
}
