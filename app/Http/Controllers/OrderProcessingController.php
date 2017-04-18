<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\OrderProcessing;
use App\Permissions;
use App\Orders;

class OrderProcessingController extends Controller
{
    // Quá trình xử lý
    public function getOrderProcessing(Request $request,$order_id){
        $sort='created_at';
        $order='asc';
        $rows = OrderProcessing::select('order_processing.*','users.name as username','order_processing.created_at as processing_created_at')
        ->join('users', 'order_processing.user_id', '=', 'users.id')
        ->join('orders', 'orders.id', '=', 'order_processing.order_id')
        ->where('order_id','=',$order_id)
        ->groupBy('order_processing.order_status');

        $data = $rows->orderBy($sort,$order)->get();
        //var_dump($data);die();
        return view('admin.order-processing.index', ['rows' => $data]);
    }
}
