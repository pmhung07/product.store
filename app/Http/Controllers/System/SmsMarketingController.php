<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\SmsMarketingCampain;
use App\Models\SmsMarketingSendLog;
use Excel;
use Illuminate\Http\Request;

class SmsMarketingController extends Controller
{
    public function __construct()
    {
        $this->uploader = app('Uploader');
        $this->smsService = app('App\Hocs\Sms\SmsInterface');
    }

    public function getIndex()
    {
        $campains = SmsMarketingCampain::orderBy('created_at', 'DESC')
                                        ->paginate(20);

        return view('system/sms-marketing/index', compact('campains'));
    }

    public function getCreate()
    {
        return view('system/sms-marketing/create');
    }

    public function postCreate(Request $request)
    {
        $campain = new SmsMarketingCampain();
        $campain->name = clean($request->get('name'));
        $campain->merchant_id = 0;
        $campain->sms = clean($request->get('sms'));
        $campain->creator_id = $request->user()->id;
        $campain->save();

        $success = [];
        // Đọc file excel lưu thành mảng khách hàng
        if($request->hasFile('file-customers')) {
            $fileName = $this->uploader->upload('file-customers');
            $filePath = public_path().parse_image_url($fileName);
            Excel::load($filePath, function($reader) use($campain) {
                $results = $reader->all();
                foreach($results as $row) {
                    $this->smsService->setApiKey('A50406AEFD520F879469E308CFDC4B');
                    $this->smsService->setSecret('C046566E24CE0514CBA8D373F73667');

                    $log = new SmsMarketingSendLog();
                    $log->sms = $campain->sms;
                    $log->campain_id = $campain->id;
                    $log->customer_id = $row->id;
                    $log->customer_phone = $row->phone;
                    $log->customer_name = $row->name;

                    try {
                        $this->smsService->send($row->phone, $campain->sms);
                        if($this->smsService->success()) {
                            $success[] = $row->phone;
                            $log->status = SmsMarketingSendLog::SUCCESS;
                        } else {
                            $log->status = SmsMarketingSendLog::FAIL;
                            $log->error_log = "FAIL";
                        }
                    } catch (\Exception $e) {
                        $log->status = SmsMarketingSendLog::FAIL;
                        $log->error_log = $e->getMessage();
                    }

                    $log->save();
                }
            });
        }

        if($countSuccess = count($success)) {
            return redirect()->route('system.smsMarketing.index')->with('success', 'Gửi thành công sms cho '.count($success).' người');
        }

        return redirect()->route('system.smsMarketing.index')->with('error', 'Gửi không thành công');
    }

    public function getEdit($id)
    {
        $campain = SmsMarketingCampain::findOrFail($id);
        return view('system/sms-marketing/edit', compact('campain'));
    }

    public function postEdit($id, Request $request)
    {
        $campain = SmsMarketingCampain::findOrFail($id);
        $campain->name = clean($request->get('name'));
        $campain->merchant_id = 0;
        $campain->sms = clean($request->get('sms'));
        $campain->creator_id = $request->user()->id;
        $campain->save();

        $success = [];
        // Đọc file excel lưu thành mảng khách hàng
        if($request->hasFile('file-customers')) {
            $fileName = $this->uploader->upload('file-customers');
            $filePath = public_path().parse_image_url($fileName);
            Excel::load($filePath, function($reader) use($campain) {
                $results = $reader->all();
                foreach($results as $row) {
                    $this->smsService->setApiKey('A50406AEFD520F879469E308CFDC4B');
                    $this->smsService->setSecret('C046566E24CE0514CBA8D373F73667');

                    $log = new SmsMarketingSendLog();
                    $log->sms = $campain->sms;
                    $log->campain_id = $campain->id;
                    $log->customer_id = $row->id;
                    $log->customer_phone = $row->phone;
                    $log->customer_name = $row->name;

                    try {
                        $this->smsService->send($row->phone, $campain->sms);

                        if($this->smsService->success()) {
                            $success[] = $row->phone;
                            $log->status = SmsMarketingSendLog::SUCCESS;
                        } else {
                            $log->status = SmsMarketingSendLog::FAIL;
                            $log->error_log = 'FAIL';
                        }
                    } catch (\Exception $e) {
                        $log->status = SmsMarketingSendLog::FAIL;
                        $log->error_log = $e->getMessage();
                    }

                    $log->save();
                }
            });
        }

        if($countSuccess = count($success)) {
            return redirect()->route('system.smsMarketing.index')->with('success', 'Gửi thành công sms cho '.count($success).' người');
        }

        return redirect()->route('system.smsMarketing.index')->with('error', 'Gửi không thành công');
    }
}
