<?php

namespace App\Http\Controllers\System;

use App\Customers;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\EmailMarketingCampainFormRequest;
use App\Models\EmailMarketingCampain;
use App\Models\EmailMarketingCampainHasCustomer;
use App\Models\EmailMarketingCampainHasEmailTemplate;
use App\Models\EmailMarketingQueue;
use App\Models\EmailMarketingSendMailLog;
use App\Models\EmailTemplate;
use App\Provinces;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EmailMarketingController extends Controller
{
    public function __construct()
    {
        $this->uploader = app('Uploader');
    }
    public function getIndex(Request $request)
    {
        $items = EmailMarketingCampain::orderBy('updated_at', 'DESC')->paginate(20);
        return view('system/email-marketing/index', compact('items'));
    }

    public function getCreate()
    {
        $item = new EmailMarketingCampain();

        // Mẫu email
        $templateEmails = EmailTemplate::orderBy('updated_at', 'DESC')->get();

        $provinces = Provinces::orderBy('name', 'DESC')->get();
        $districts = new Collection();

        return view('system/email-marketing/create', compact('item', 'templateEmails', 'provinces', 'districts'));
    }

    public function postCreate(EmailMarketingCampainFormRequest $request)
    {
        $item = new EmailMarketingCampain();
        $item->name = clean($request->get('name'));
        $item->save();

        // Đọc file excel lưu thành mảng khách hàng
        $customers = new Collection();
        if($request->hasFile('file-customers')) {
            $fileName = $this->uploader->upload('file-customers');
            $filePath = public_path().parse_image_url($fileName);
            Excel::load($filePath, function($reader) use($customers) {
                $results = $reader->all();
                foreach($results as $row) {
                    $customers->push(new Customers([
                        'id' => (int) $row->id,
                        'email' => $row->email,
                        'name' => $row->name
                    ]));
                }
            });
        }


        $emailTemplateSelected = (array) $request->get('email_template_selected');
        $configEmail = config('mail.from');
        foreach($emailTemplateSelected as $itemTemplate) {
            EmailMarketingCampainHasEmailTemplate::insert([
                'campain_id' => $item->id,
                'template_id' => $itemTemplate['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // Nếu thằng nào gửi ngay thì cho nó đi luôn và lưu log lại
            $template = EmailTemplate::where('id', $itemTemplate['id'])->firstOrNew([]);
            if($itemTemplate['now'] == 'true') {
                if($template) {
                    foreach($customers as $customer) {
                        \Mail::send('layout/mail/send-mail-template', ['title' => $item->name,'content' => $template->content], function ($m) use ($template, $item, $customer, $configEmail) {
                            $m->from($configEmail['address'], $configEmail['name']);
                            $m->to($customer->email, $customer->name)->subject($item->name);
                        });
                        $log = new EmailMarketingSendMailLog([
                            'campain_id' => $item->id,
                            'customer_id' => $customer->id,
                            'template_id' => $template->id
                        ]);
                        $log->save();
                    }
                }
            } else {
                foreach($customers as $customer) {
                    $hour = array_get($itemTemplate, 'hour');
                    $minute = array_get($itemTemplate, 'minute');
                    $month = array_get($itemTemplate, 'month');
                    $day = array_get($itemTemplate, 'day');
                    $year = array_get($itemTemplate, 'year');
                    $queue = new EmailMarketingQueue([
                        'campain_id' => $item->id,
                        'template_id' => $template->id,
                        'merchant_id' => 0,
                        'customer_id' => $customer->id,
                        'email' => $customer->email,
                        'send_schedule_at' => date('Y-m-d H:i:s', mktime($hour, $minute, 0, $month, $day, $year))
                    ]);
                    $queue->save();
                }
            }
        }

        return response()->json([
            'code' => 200,
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);

        // return redirect()->route('system.emailMarketing.choiceCustomer', $item->id)->with('success', 'Cập nhật thành công');
    }

    public function getChoiceCustomer($id, Request $request)
    {
        $item = EmailMarketingCampain::findOrFail($id);

        // Khach hang
        $sort = 'created_at';
        $order = 'DESC';
        $rows = Customers::select('customers.*','provinces.name as provinces_name','districts.name as districts_name')
                           ->Join('provinces', 'provinces.id', '=', 'customers.province_id')
                           ->join('districts', 'districts.id', '=', 'customers.district_id')
                           ->where('customers.active','!=',0);

        if ($request->has('cus_name'))
            $rows = $rows->where('customers.name', 'LIKE', '%'.$request->input("cus_name").'%');
        if ($request->has('cus_phone'))
            $rows = $rows->where('customers.phone', 'LIKE', '%'.$request->input("cus_phone").'%');
        if ($request->has('cus_email'))
            $rows = $rows->where('customers.email', 'LIKE', '%'.$request->input("cus_email").'%');

        $province_id = (int) $request->get('province_id');
        $district_id = (int) $request->get('district_id');
        $vip_customer = (int) $request->get('vip_customer');

        if($province_id) $rows->where('customers.province_id', '=', $province_id);
        if($district_id) $rows->where('customers.district_id', '=', $district_id);
        if($vip_customer) {
            $rows->join('orders', 'customers.id', '=', 'orders.customer_id')
                 ->orderBy('orders.total_price', 'DESC');
            $sort = 'orders.total_price';
            $order = 'DESC';
        }

        $customers = $rows->orderBy($sort,$order)->paginate(50);

        $provinces = Provinces::orderBy('name', 'DESC')->get();
        $districts = new Collection();
        if($province_id) {
            $districts = Districts::where('province_id', $province_id)->get();
        }

        // Bulk action
        $bulkActions = [
            "SEND_SMS"     => 'Gửi tin nhắn',
            "SEND_EMAIL"   => 'Gửi mail',
            // "DELETE_MULTI" => 'Xóa'
        ];

        return view('system/email-marketing/customer', compact('item', 'bulkActions', 'customers', 'provinces', 'districts'));
    }

    public function getEdit($id)
    {
        $campain = EmailMarketingCampain::findOrFail($id);
        // Mẫu email
        $templateEmails = EmailTemplate::orderBy('updated_at', 'DESC')->get();

        // Những mẫu đã chọn
        $templateSelected = EmailTemplate::join('email_marketing_campain_has_email_template', 'email_template.id', '=', 'email_marketing_campain_has_email_template.template_id')
                                        ->join('email_marketing_queue', 'email_template.id', '=', 'email_marketing_queue.template_id')
                                        ->select('email_template.*', 'email_marketing_queue.send_schedule_at')
                                        ->where('email_marketing_campain_has_email_template.campain_id', '=', $id)
                                        ->groupBy('email_template.id')
                                        ->get();

        $provinces = Provinces::orderBy('name', 'DESC')->get();
        $districts = new Collection();

        return view('system/email-marketing/edit', compact('campain', 'templateEmails', 'provinces', 'districts', 'templateSelected'));
    }

    public function postEdit($id, EmailMarketingCampainFormRequest $request)
    {
        $item = EmailMarketingCampain::findOrFail($id);
        $item->name = clean($request->get('name'));
        $item->save();

        // Đọc file excel lưu thành mảng khách hàng
        $customers = new Collection();
        if($request->hasFile('file-customers')) {
            // Clear old data
            EmailMarketingCampainHasCustomer::where('campain_id', $id)->delete();

            $fileName = $this->uploader->upload('file-customers');
            $filePath = public_path().parse_image_url($fileName);
            Excel::load($filePath, function($reader) use($customers, $item) {
                $results = $reader->all();
                foreach($results as $row) {
                    $customers->push(new Customers([
                        'id' => (int) $row->id,
                        'email' => $row->email,
                        'name' => $row->name
                    ]));

                    EmailMarketingCampainHasCustomer::insert([
                        'campain_id' => $item->id,
                        'customer_id' => $row->id,
                        'created_at' => date('Y-m-d H:i'),
                        'updated_at' => date('Y-m-d H:i')
                    ]);
                }
            });
        } else {
            $customers = Customers::join('email_marketing_campain_has_customer', 'customers.id', '=', 'email_marketing_campain_has_customer.customer_id')
                                ->where('email_marketing_campain_has_customer.campain_id', '=', $id)
                                ->select('customers.*')
                                ->get();
        }

        $emailTemplateSelected = (array) $request->get('email_template_selected');

        EmailMarketingCampainHasEmailTemplate::where('campain_id', $id)->delete();
        EmailMarketingQueue::where('campain_id', $id)->delete();

        $configEmail = config('mail.from');
        foreach($emailTemplateSelected as $itemTemplate) {
            EmailMarketingCampainHasEmailTemplate::insert([
                'campain_id' => $item->id,
                'template_id' => $itemTemplate['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            // Nếu thằng nào gửi ngay thì cho nó đi luôn và lưu log lại
            $template = EmailTemplate::where('id', $itemTemplate['id'])->firstOrNew([]);
            if($itemTemplate['now'] == 'true') {
                if($template) {
                    foreach($customers as $customer) {
                        \Mail::send('layout/mail/send-mail-template', ['title' => $template->title,'content' => $template->content], function ($m) use ($template, $item, $customer, $configEmail) {
                            $m->from($configEmail['address'], $configEmail['name']);
                            $m->to($customer->email, $customer->name)->subject($template->title);
                        });
                        $log = new EmailMarketingSendMailLog([
                            'campain_id' => $item->id,
                            'customer_id' => $customer->id,
                            'template_id' => $template->id
                        ]);
                        $log->save();
                    }
                }
            } else {
                foreach($customers as $customer) {
                    $hour = array_get($itemTemplate, 'hour');
                    $minute = array_get($itemTemplate, 'minute');
                    $month = array_get($itemTemplate, 'month');
                    $day = array_get($itemTemplate, 'day');
                    $year = array_get($itemTemplate, 'year');
                    $queue = new EmailMarketingQueue([
                        'campain_id' => $item->id,
                        'template_id' => $template->id,
                        'merchant_id' => 0,
                        'customer_id' => $customer->id,
                        'email' => $customer->email,
                        'send_schedule_at' => date('Y-m-d H:i:s', mktime($hour, $minute, 0, $month, $day, $year))
                    ]);
                    $queue->save();
                }
            }
        }

        return response()->json([
            'code' => 200,
            'type' => 'success',
            'message' => 'Cập nhật thành công'
        ]);

        // return redirect()->route('system.emailMarketing.index')->with('success', 'Cập nhật thành công');
    }

    public function getDelete($id)
    {
        $item = EmailMarketingCampain::findOrFail($id);
        $item->delete();

        return redirect()->route('system.emailMarketing.index')->with('success', 'Xóa thành công');
    }

    public function getDetail($id)
    {
        # code...
    }

    public function getScheduleAt(Request $request)
    {
        $item = EmailMarketingQueue::where('template_id', $request->get('template_id'))
                                    ->where('campain_id', $request->get('campain_id'))
                                    ->where('merchant_id', $request->get('merchant_id'))
                                    ->first();

        if($item) {
            $timeInt = strtotime($item->send_schedule_at);
            return [
                'year' => date('Y', $timeInt),
                'month' => date('m', $timeInt),
                'day' => date('d', $timeInt),
                'hour' => date('H', $timeInt),
                'minute' => date('i', $timeInt)
            ];
        }

        return [
            'year' => '',
            'month' => '',
            'day' => '',
            'hour' => '',
            'minute' => ''
        ];
    }
}
