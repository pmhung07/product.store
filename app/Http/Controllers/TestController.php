<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        // $frame = Frame::orderBy('updated_at', 'DESC')->first();
        // echo $frame->content;
        // preg_match_all('#src="(.+)"#', $frame->content, $matches);
        // _debug($matches);

        \Mail::raw("Chao cong", function ($m) {
            $m->from('hello@app.com', 'Your Application');
            $m->to('cong.itsoft@gmail.com', 'cong luong')->subject('Your Reminder!');
        });

        // $sms = app('App\Hocs\Sms\SmsInterface');
        // $sms->setApiKey('A50406AEFD520F879469E308CFDC4B');
        // $sms->setSecret('C046566E24CE0514CBA8D373F73667');
        // $sms->send('0901452368', 'Chao cong');
    }
}
