<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LandingResourceController extends Controller
{
    public function getIndex($p1, $p2, $p3 = null, $p4 = null)
    {
        if($p3 && $p4) {
            return file_get_contents(public_path() . '/elements/'.$p3.'/'.$p4);
        }

        return file_get_contents(public_path() . '/elements/'.$p1.'/'.$p2);
    }
}
