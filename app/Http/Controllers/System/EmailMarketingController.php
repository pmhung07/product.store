<?php

namespace App\Http\Controllers\System;

use App\Customers;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\EmailMarketingCampainFormRequest;
use App\Models\EmailMarketingCampain;
use App\Models\EmailMarketingCampainHasEmailTemplate;
use App\Models\EmailMarketingSendMailLog;
use App\Models\EmailTemplate;
use App\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EmailMarketingController extends Controller
{
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
        $customers->push(new Customers(['id' => 1000, 'email' => 'cong.itsoft@gmail.com', 'name' => 'Justin']));

        $emailTemplateSelected = (array) $request->get('email_template_selected');
        foreach($emailTemplateSelected as $itemTemplate) {
            EmailMarketingCampainHasEmailTemplate::insert([
                'campain_id' => $item->id,
                'template_id' => $itemTemplate['id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // Nếu thằng nào gửi ngay thì cho nó đi luôn và lưu log lại
            if($itemTemplate['now']) {
                $template = EmailTemplate::where('id', $itemTemplate['id'])->first();
                if($template) {
                    foreach($customers as $customer) {
                        \Mail::send('layout/mail/send-mail-template', ['title' => $item->name,'content' => $template->content], function ($m) use ($template, $item, $customer) {
                            $m->from('tamnguyen@9119.vn', $item->name);
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

            }
        }

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
        $item = EmailMarketingCampain::findOrFail($id);
        return view('system/email-marketing/edit', compact('item'));
    }

    public function postEdit($id, EmailMarketingCampainFormRequest $request)
    {
        $item = EmailMarketingCampain::findOrFail($id);
        $item->name = clean($request->get('name'));
        $item->save();

        return redirect()->route('system.emailMarketing.index')->with('success', 'Cập nhật thành công');
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
}
