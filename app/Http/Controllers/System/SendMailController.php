<?php

namespace App\Http\Controllers\System;

use App\Customers;
use App\Hocs\Sms\SmsInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;

class SendMailController extends Controller
{

    public function sendMailToCustomers(Request $request)
    {
        $ids = $request->get('customers');
        $ids = explode(',', $ids);
        $title = clean($request->get('title'));
        $content = clean($request->get('content'));

        $customers = Customers::whereIn('id', $ids)->get();

        foreach($customers as $customer) {
            Mail::send('layout/mail/send-mail-template', ['title' => $title, 'content' => $content], function ($m) use ($customer, $title) {
                $m->from('mail@9119.vn', $title);
                $m->to($customer->email, $customer->name)->subject($title);
            });
        }

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }
}
