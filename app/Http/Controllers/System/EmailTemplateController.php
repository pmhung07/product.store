<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SystemEmailTemplateFormRequest;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    public function getIndex(Request $request)
    {
        $items = EmailTemplate::orderBy('created_at', 'DESC')->paginate(20);
        return view('system/email-template/index', compact('items'));
    }

    public function getCreate(Request $request)
    {
        $item = new EmailTemplate();
        return view('system/email-template/create', compact('item'));
    }

    public function postCreate(SystemEmailTemplateFormRequest $request)
    {
        $item = new EmailTemplate();
        $item->title = clean($request->get('title'));
        $item->content = clean($request->get('content'));
        $item->creator_id = $request->user()->id;
        $item->save();

        if($request->ajax()) {
            return response()->json([
                'code' => 200,
                'item' => $item->toArray()
            ]);
        }

        return redirect()->route('system.emailTemplate.index')->with('success', 'Cập nhật thành công');
    }

    public function getUpdate($id, Request $request)
    {
        $item = EmailTemplate::findOrFail($id);
        return view('system/email-template/edit', compact('item'));
    }

    public function postUpdate($id, SystemEmailTemplateFormRequest $request)
    {
        $item = EmailTemplate::findOrFail($id);
        $item->title = clean($request->get('title'));
        $item->content = clean($request->get('content'));
        $item->creator_id = $request->user()->id;
        $item->save();
        return redirect()->route('system.emailTemplate.index')->with('success', 'Cập nhật thành công');
    }

    public function getDelete($id)
    {
        $item = EmailTemplate::findOrFail($id);
        $item->delete();
        return redirect()->route('system.emailTemplate.index')->with('success', 'Xóa thành công');
    }
}
