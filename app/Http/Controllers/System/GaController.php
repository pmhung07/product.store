<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\GaData;

use Illuminate\Http\Request;

class GaController extends Controller
{

    public function getIndex()
    {
        $query = GaData::whereRaw(1);
        $rows = $query->orderBy('date', 'DESC')->paginate(25);
        return view('system/ga/index', compact('rows'));
    }
}
