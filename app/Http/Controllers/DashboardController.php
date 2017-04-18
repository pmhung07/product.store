<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Orders;
use App\OrderDetails;
use App\WarehouseReturnProductPh;

use Carbon\Carbon;

use DB;

class DashboardController extends Controller
{
    public function getDashboard(Request $request){

    	$count_orders_waiting  = Orders::where('order_status','=',0)->where('status','=',1)->count();
    	$count_orders_approval = Orders::where('order_status','=',1)->where('status','=',1)->count();
    	$count_orders_delivery = Orders::where('order_status','=',2)->where('status','=',1)->count();
        $count_orders_success  = Orders::where('order_status','=',3)->where('status','=',1)->count();
    	$count_orders_cancel   = Orders::where('order_status','=',4)->where('status','=',1)->count();

    	$fromDate = Carbon::now()->startOfWeek();
		$tillDate = date('Y-m-d H:i:s');

        $totalPriceByDate           = Orders::whereDate('created_at','=',date('Y-m-d'))->sum('total_price');
        $totalPriceByWeek           = Orders::whereBetween('created_at', [$fromDate, $tillDate] )->sum('total_price');
        $totalPriceByMonth          = Orders::whereMonth('created_at','=',date('m'))->sum('total_price');
        $totalPriceByYear           = Orders::whereYear('created_at','=',date('Y'))->sum('total_price');

        $totalPriceByDateSuccess    = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereDate('orders.created_at','=',date('Y-m-d'))->where('orders.order_status','=',3)->get();
        $totalPriceByWeekSuccess    = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereBetween('orders.created_at', [$fromDate, $tillDate] )->where('orders.order_status','=',3)->get();
        $totalPriceByMonthSuccess   = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereMonth('orders.created_at','=',date('m'))->where('orders.order_status','=',3)->get();
        $totalPriceByYearSuccess    = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereYear('orders.created_at','=',date('Y'))->where('orders.order_status','=',3)->get();

        $countOrderByDateSuccess    = Orders::whereDate('created_at','=',date('Y-m-d'))->where('order_status','=',3)->count();
        $countOrderByWeekSuccess    = Orders::whereBetween('created_at', [$fromDate, $tillDate] )->where('order_status','=',3)->count();
        $countOrderByMonthSuccess   = Orders::whereMonth('created_at','=',date('m'))->where('order_status','=',3)->count();
        $countOrderByyearSuccess    = Orders::whereYear('created_at','=',date('Y'))->where('order_status','=',3)->count();

        $totalPriceByDateCancel     = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereDate('orders.created_at','=',date('Y-m-d'))->where('orders.order_status','=',4)->get();
        $totalPriceByWeekCancel     = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereBetween('orders.created_at', [$fromDate, $tillDate] )->where('orders.order_status','=',4)->get();
        $totalPriceByMonthCancel    = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereMonth('orders.created_at','=',date('m'))->where('orders.order_status','=',4)->get();
        $totalPriceByYearCancel     = OrderDetails::select(DB::raw('SUM(order_details.total_price) as total_price,SUM(order_details.quantity) as total_quantity'))->join('orders', 'orders.id', '=', 'order_details.order_id')->whereYear('orders.created_at','=',date('Y'))->where('orders.order_status','=',4)->get();

        $countOrderByDateCancel     = Orders::whereDate('created_at','=',date('Y-m-d'))->where('order_status','=',4)->count();
        $countOrderByWeekCancel     = Orders::whereBetween('created_at', [$fromDate, $tillDate] )->where('order_status','=',4)->count();
        $countOrderByMonthCancel    = Orders::whereMonth('created_at','=',date('m'))->where('order_status','=',4)->count();
        $countOrderByyearCancel     = Orders::whereYear('created_at','=',date('Y'))->where('order_status','=',4)->count();

        $totalPriceByDateReturn     = DB::table('warehouse_return_product_ph_details')->select(DB::raw('SUM(total_price) as total_price_return,SUM(quantity) as total_quantity'))->join('warehouse_return_product_ph', 'warehouse_return_product_ph.id', '=', 'warehouse_return_product_ph_details.warehouse_return_product_ph_id')->whereDate('warehouse_return_product_ph.created_at','=',date('Y-m-d'))->get();
        $totalPriceByWeekReturn     = DB::table('warehouse_return_product_ph_details')->select(DB::raw('SUM(total_price) as total_price_return,SUM(quantity) as total_quantity'))->join('warehouse_return_product_ph', 'warehouse_return_product_ph.id', '=', 'warehouse_return_product_ph_details.warehouse_return_product_ph_id')->whereBetween('warehouse_return_product_ph.created_at',[$fromDate, $tillDate])->get();
        $totalPriceByMonthReturn    = DB::table('warehouse_return_product_ph_details')->select(DB::raw('SUM(total_price) as total_price_return,SUM(quantity) as total_quantity'))->join('warehouse_return_product_ph', 'warehouse_return_product_ph.id', '=', 'warehouse_return_product_ph_details.warehouse_return_product_ph_id')->whereMonth('warehouse_return_product_ph.created_at','=',date('m'))->get();
        $totalPriceByYearReturn     = DB::table('warehouse_return_product_ph_details')->select(DB::raw('SUM(total_price) as total_price_return,SUM(quantity) as total_quantity'))->join('warehouse_return_product_ph', 'warehouse_return_product_ph.id', '=', 'warehouse_return_product_ph_details.warehouse_return_product_ph_id')->whereYear('warehouse_return_product_ph.created_at','=',date('Y'))->get();

        $countOrderByDateReturn     = WarehouseReturnProductPh::whereDate('created_at','=',date('Y-m-d'))->count();
        $countOrderByWeekReturn     = WarehouseReturnProductPh::whereBetween('created_at', [$fromDate, $tillDate] )->count();
        $countOrderByMonthReturn    = WarehouseReturnProductPh::whereMonth('created_at','=',date('m'))->count();
        $countOrderByyearReturn     = WarehouseReturnProductPh::whereYear('created_at','=',date('Y'))->count();

        $arrViewTotalPrice = array(
        	'today'                    => $totalPriceByDate,
        	'week'                     => $totalPriceByWeek,
        	'month'                    => $totalPriceByMonth,
        	'year'                     => $totalPriceByYear, 

        	'today_success'            => $totalPriceByDateSuccess[0]->total_price,
        	'week_success'             => $totalPriceByWeekSuccess[0]->total_price,
        	'month_success'            => $totalPriceByMonthSuccess[0]->total_price,
        	'year_success'             => $totalPriceByYearSuccess[0]->total_price,

            'today_quantity_success'   => $totalPriceByDateSuccess[0]->total_quantity,
            'week_quantity_success'    => $totalPriceByWeekSuccess[0]->total_quantity,
            'month_quantity_success'   => $totalPriceByMonthSuccess[0]->total_quantity,
            'year_quantity_success'    => $totalPriceByYearSuccess[0]->total_quantity,

            'count_today_success'      => $countOrderByDateSuccess,
            'count_week_success'       => $countOrderByWeekSuccess,
            'count_month_success'      => $countOrderByMonthSuccess,
            'count_year_success'       => $countOrderByyearSuccess,

            'today_cancel'             => $totalPriceByDateCancel[0]->total_price,
            'week_cancel'              => $totalPriceByWeekCancel[0]->total_price,
            'month_cancel'             => $totalPriceByMonthCancel[0]->total_price,
            'year_cancel'              => $totalPriceByYearCancel[0]->total_price,

            'today_quantity_cancel'    => $totalPriceByDateCancel[0]->total_quantity,
            'week_quantity_cancel'     => $totalPriceByWeekCancel[0]->total_quantity,
            'month_quantity_cancel'    => $totalPriceByMonthCancel[0]->total_quantity,
            'year_quantity_cancel'     => $totalPriceByYearCancel[0]->total_quantity,

            'count_today_cancel'       => $countOrderByDateCancel,
            'count_week_cancel'        => $countOrderByWeekCancel,
            'count_month_cancel'       => $countOrderByMonthCancel,
            'count_year_cancel'        => $countOrderByyearCancel,

            'today_return'             => $totalPriceByDateReturn[0]->total_price_return,
            'week_return'              => $totalPriceByWeekReturn[0]->total_price_return,
            'month_return'             => $totalPriceByMonthReturn[0]->total_price_return,
            'year_return'              => $totalPriceByYearReturn[0]->total_price_return,

            'today_quantity_return'    => $totalPriceByDateReturn[0]->total_quantity,
            'week_quantity_return'     => $totalPriceByWeekReturn[0]->total_quantity,
            'month_quantity_return'    => $totalPriceByMonthReturn[0]->total_quantity,
            'year_quantity_return'     => $totalPriceByYearReturn[0]->total_quantity,

            'count_today_return'       => $countOrderByDateReturn,
            'count_week_return'        => $countOrderByWeekReturn,
            'count_month_return'       => $countOrderByMonthReturn,
            'count_year_return'        => $countOrderByyearReturn
        );

    	return view('admin.dashboard.index',compact('arrViewTotalPrice', 'count_orders_waiting','count_orders_approval','count_orders_success','count_orders_cancel','count_orders_delivery'));
    }
}
