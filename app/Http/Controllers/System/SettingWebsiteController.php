<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\SettingWebsite;
use Illuminate\Http\Request;

class SettingWebsiteController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = app('ImageUploader');
    }

    public function getIndex()
    {
        $merchantId = 1;
        $setting = SettingWebsite::where('merchant_id', $merchantId)->firstOrNew([]);
        return view('system/setting-website/index', compact('setting'));
    }

    public function postIndex(Request $request)
    {
        $merchantId = 1;
        $setting = SettingWebsite::where('merchant_id', $merchantId)->firstOrNew([]);
        $setting->company_name = clean($request->get('company_name'));
        $setting->address = clean($request->get('address'));
        $setting->phone = clean($request->get('phone'));
        $setting->mail = clean($request->get('mail'));
        $setting->skype = clean($request->get('skype'));
        $setting->yahoo = clean($request->get('yahoo'));
        $setting->facebook = clean($request->get('facebook'));
        $setting->google = clean($request->get('google'));
        $setting->youtube = clean($request->get('youtube'));
        $setting->twitter = clean($request->get('twitter'));
        $setting->pinterest = clean($request->get('pinterest'));
        $setting->tumblr = clean($request->get('tumblr'));
        $setting->instagram = clean($request->get('instagram'));
        $setting->linkedin = clean($request->get('linkedin'));
        $setting->province_id = intval($request->get('province_id'));
        $setting->district_id = intval($request->get('district_id'));
        $setting->merchant_id = $merchantId;

        if($request->hasFile('logo')) {
            $resultUpload = $this->imageUploader->upload('logo');
            if($resultUpload['status'] > 0) {
                $setting->logo = $resultUpload['filename'];
            }
        }

        $setting->save();

        return redirect()->route('system.setting_website.index')->with('success', 'Cập nhật thành công');
    }
}
