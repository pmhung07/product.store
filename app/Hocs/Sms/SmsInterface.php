<?php

namespace App\Hocs\Sms;

interface SmsInterface {
    public function send($phone, $message);
}