<?php

namespace App\Http\Controllers\System;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SystemBannerFormRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->upload = App::make('Uploader');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Banner::orderBy('updated_at', 'DESC');

        $targetPage = $request->get('_page');
        $position = $request->get('position');

        if($targetPage) $query->where('page', $targetPage);
        if($position) $query->where('position', $position);

        $banners = $query->paginate(20);
        $positionList = Banner::getPositionList();
        $pageList     = Banner::getPageList();
        return view('system/banner/index', compact('banners', 'positionList', 'pageList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $banner = new Banner();
        return view('system/banner/create', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SystemBannerFormRequest $request)
    {
        $formData = $request->except('_token');
        if($request->hasFile('image')) {
            $formData['image'] = $this->upload->upload('image');
        }

        if(Banner::insert($formData)) {
            return redirect()->route('system.banner.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('system/banner/edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SystemBannerFormRequest $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $formData = $request->except('_token');

        if($request->hasFile('image')) {
            $formData['image'] = $this->upload->upload('image');
        }

        if(Banner::where('id', $id)->update($formData)) {
            return redirect()->back()->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if($banner->delete()) {
            return redirect()->route('system.banner.index')->with('success', 'Xóa thành công');
        }

        return redirect()->back()->with('error', 'Xóa không thành công');
    }


    public function active($id) {
        $banner = Banner::findOrFail($id);
        $banner->status = !$banner->status;

        if($banner->save()) {
            return response()->json([
               'code' => 1,
               'status' => $banner->getStatus()
            ]);
        }

        return response()->json([
           'code' => 0
        ]);
    }


    /**
     * Ajax editable
     * @param  Request $request
     * @return json
     */
    public function ajaxEditAble(Request $request)
    {
        $id    = $request->get('pk');
        $field = $request->get('name');
        $value = clean($request->get('value'));

        $item = Banner::findOrFail($id);
        $item->$field = $value;

        if($item->save()) {
            return response()->json(['code' => 1]);
        }

        return response()->json(['code' => 0]);
    }
}
