<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SystemTestimonialFormRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller {

    /**
     * @var \Models\Testimonial
     */
    protected $testimonial;

    public function __construct(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
        $this->imageUploader = app('ImageUploader');
    }

    public function getIndex()
    {
        $testimonials = $this->testimonial->get();
        return view('system/testimonial/index', compact('testimonials'));
    }

    public function getCreate()
    {
        $testimonial = new Testimonial();
        return view('system/testimonial/create', compact('testimonial'));
    }

    public function postCreate(SystemTestimonialFormRequest $request)
    {
        $data = [
            'name' => clean($request->get('name')),
            'profession' => clean($request->get('profession')),
            'comment' => clean($request->get('comment'))
        ];

        if($request->hasFile('avatar')) {
            $resultUpload = $this->imageUploader->upload('avatar');
            if($resultUpload['status'] > 0) {
                $data['avatar'] = $resultUpload['filename'];
            }
        }

        if($testimonial = $this->testimonial->create($data)) {
            return redirect()->route('system.testimonial.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('system.testimonial.index')->with('error', 'Cập nhật thất bại');
    }

    public function getEdit($id)
    {
        $testimonial = $this->testimonial->findOrFail($id);
        return view('system/testimonial/edit', compact('testimonial'));
    }

    public function postEdit($id, SystemTestimonialFormRequest $request)
    {
        $data = [
            'name' => clean($request->get('name')),
            'profession' => clean($request->get('profession')),
            'comment' => clean($request->get('comment'))
        ];

        if($request->hasFile('avatar')) {
            $resultUpload = $this->imageUploader->upload('avatar');
            if($resultUpload['status'] > 0) {
                $data['avatar'] = $resultUpload['filename'];
            }
        }

        if($testimonial = Testimonial::where('id', $id)->update($data)) {
            return redirect()->route('system.testimonial.index')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('system.testimonial.index')->with('error', 'Cập nhật thất bại');
    }

    public function getDelete($id)
    {
        $testimonial = $this->testimonial->findOrFail($id);
        if($testimonial->delete()) {
            return redirect()->route('system.testimonial.index')->with('success', 'Xóa thành công');
        }

        return redirect()->route('system.testimonial.index')->with('error', 'Xóa thất bại');
    }

}
