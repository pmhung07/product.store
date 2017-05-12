<?php

namespace App\Http\Controllers;

use App\Frame;
use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $frame = Frame::orderBy('updated_at', 'DESC')->first();
        echo $frame->content;
        preg_match_all('#src="(.+)"#', $frame->content, $matches);
        _debug($matches);
    }
}
