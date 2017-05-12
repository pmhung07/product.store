<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\GaData;

use Illuminate\Http\Request;

class GaController extends Controller
{

    public function getIndex(Request $request)
    {
        $query = GaData::whereRaw(1);

        $startDate = clean($request->get('date_from', date('Y-m-01')));
        $endDate = clean($request->get('date_to', date('Y-m-d', strtotime('last day of this month'))));

        $rows = $query->orderBy('date', 'ASC')->whereBetween('date', [$startDate, $endDate])->get();

        // Lấy dữ liệu thật
        $chart = [];
        foreach($rows as $row) {
            $chart['labels'][] = date('d/m/Y', strtotime($row['created_at']));
            $chart['visit']['data'][] = $row['visit'];
            $chart['page_view']['data'][] = $row['unique_page_view'];
            $chart['time_on_page']['data'][] = $row['time_on_page'];
            $chart['session_duration']['data'][] = $row['session_duration'];
            $chart['bounce_rate']['data'][] = $row['bounce_rate'];
        }

        // Dữ liệu fake
        // $chart = [];
        // for($i = strtotime('2017-05-01'); $i < time(); $i += 86400) {
        //     $chart['labels'][] = date('d/m/Y', $i);
        //     $chart['visit']['data'][] = rand(1000, 10000);
        // }

        // for($i = strtotime('2017-05-01'); $i < time(); $i += 86400) {
        //     $chart['page_view']['data'][] = rand(5000, 20000);
        // }

        // for($i = strtotime('2017-05-01'); $i < time(); $i += 86400) {
        //     $chart['time_on_page']['data'][] = rand(2000, 10000);
        // }

        // for($i = strtotime('2017-05-01'); $i < time(); $i += 86400) {
        //     $chart['session_duration']['data'][] = rand(2000, 10000);
        // }

        return view('system/ga/index', compact('rows', 'chart'));
    }
}
