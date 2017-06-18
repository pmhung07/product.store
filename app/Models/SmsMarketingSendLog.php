<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsMarketingSendLog extends Model
{
    protected $table = 'sms_marketing_send_log';
    protected $guarded = ['id'];

    const SUCCESS = 200;
    const FAIL = 500;
}
