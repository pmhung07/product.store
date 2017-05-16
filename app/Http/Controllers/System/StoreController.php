<?php

namespace App\Http\Controllers\System;

use App\Districts;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Core\StoreFormRequest;
use App\Models\Store;
use App\Provinces;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StoreController extends Controller
{
    public function getIndex(Request $request)
    {
        $query = Store::orderBy('created_at', 'DESC');

        $name = clean($request->get('name'));
        if($name) $query->where('name', 'LIKE', '%'. $name .'%');

        $stores = $query->paginate(20);
        return view('system/store/index', compact('stores'));
    }

    public function getCreate(Request $request)
    {
        $store = new Store();
        $provinces = Provinces::all();
        $districts = new Collection();
        if($provinceId = $request->old('province_id')) {
            $districts = Districts::where('province_id', $provinceId)->get();
        }
        return view('system/store/create', compact('store', 'provinces', 'districts'));
    }

    public function postCreate(StoreFormRequest $request)
    {
        $store = new Store();
        $store->name = clean($request->get('name'));
        $store->address = clean($request->get('address'));
        $store->phone = clean($request->get('phone'));
        $store->content = clean($request->get('content'));
        $store->province_id = (int) $request->get('province_id');
        $store->district_id = (int) $request->get('district_id');
        $store->admin_id = $request->user()->id;
        $store->save();

        return redirect()->route('system.store.index')->with('success', 'Tạo cửa hàng thành công');
    }

    public function getUpdate($id, Request $request)
    {
        $store = Store::findOrFail($id);
        $provinces = Provinces::all();
        $districts = new Collection();
        if($provinceId = $request->old('province_id', $store['province_id'])) {
            $districts = Districts::where('province_id', $provinceId)->get();
        }
        return view('system/store/edit', compact('store', 'provinces', 'districts'));
    }

    public function postUpdate($id, StoreFormRequest $request)
    {
        $store = Store::findOrFail($id);
        $store->name = clean($request->get('name'));
        $store->address = clean($request->get('address'));
        $store->phone = clean($request->get('phone'));
        $store->content = clean($request->get('content'));
        $store->admin_id = $request->user()->id;
        $store->province_id = (int) $request->get('province_id');
        $store->district_id = (int) $request->get('district_id');
        $store->save();

        return redirect()->route('system.store.index')->with('success', 'Cập nhật thành công');
    }

    public function getDelete($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('system.store.index')->with('success', 'Xóa thành công');
    }
}
