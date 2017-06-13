<?php

namespace App\Http\Controllers\System;

use App\Customers;
use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\EmailMarketingCampainFormRequest;
use App\Models\EmailMarketingCampain;
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
        return view('system/email-marketing/create', compact('item'));
    }

    public function postCreate(EmailMarketingCampainFormRequest $request)
    {
        $item = new EmailMarketingCampain();
        $item->name = clean($request->get('name'));
        $item->save();

        return redirect()->route('system.emailMarketing.choiceCustomer', $item->id)->with('success', 'Cập nhật thành công');
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
