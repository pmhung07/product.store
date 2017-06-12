<?php

namespace App\Http\Controllers\System;

use App\Customers;
use App\Hocs\Sms\SmsInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class SendSmsController extends Controller
{

    public function __construct(SmsInterface $sms)
    {
        $this->sms = $sms;
    }

    public function sendSmsToCustomers(Request $request)
    {
        $ids = $request->get('customers');
        $ids = explode(',', $ids);
        $msg = clean($request->get('msg'));

        $customers = Customers::whereIn('id', $ids)->get();

        $sms = $this->sms;
        $sms->setApiKey('A50406AEFD520F879469E308CFDC4B');
        $sms->setSecret('C046566E24CE0514CBA8D373F73667');

        $numSuccess = 0;
        foreach($customers as $item) {
            try {
                $sms->send($item->phone, $msg);
                if($sms->success()) {
                    $numSuccess ++;
                }
            } catch (\Exception $e) {

            }
        }

        return response()->json([
            'code' => 1,
            'message' => $numSuccess.' tin nhắn được gửi thành công',
            'type' => 'success'
        ]);

    }
}
