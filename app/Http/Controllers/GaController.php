<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\GaData;

use Illuminate\Http\Request;

class GaController extends Controller
{

    public function analyze(Request $request)
    {
        $ga = new \Nht\Hocs\GaData();
        return $ga->fetch();
    }

    public function getIndex()
    {

    }
}
