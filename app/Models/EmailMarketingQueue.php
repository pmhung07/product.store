<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailMarketingQueue extends Model
{
    protected $table = 'email_marketing_queue';
    protected $guarded = ['id'];
}
