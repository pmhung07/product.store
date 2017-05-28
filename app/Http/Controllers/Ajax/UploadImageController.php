<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App;

class UploadImageController extends Controller
{
    public function __construct()
    {
        $this->imageUploader = App::make('ImageUploader');
    }

    public function postUpload(Request $request)
    {
        $resultUpload = $this->imageUploader->upload('file');
        if($resultUpload['status'] > 0) {
            return response()->json([
                'code' => 1,
                'filename' => $resultUpload['filename'],
                'url' => url(parse_image_url($resultUpload['filename']))
            ]);
        }

        return response()->json(['code' => 0]);

    }
}
