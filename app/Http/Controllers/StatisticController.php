<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Orders;
use App\OrderDetails;
use App\ProductGroup;
use App\Channel;
use App\User;
use App\Provinces;
use App\Product;
use App\Customers;

use Carbon\Carbon;

class StatisticController extends Controller
{

	public function getProduct(Request $request){
		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_product 	= $request->conditions_product;
		$conditions_customers 	= $request->conditions_customers;
		$conditions_channel 	= $request->conditions_channel;
		$conditions_staff 		= $request->conditions_staff;
		$conditions_provinces 	= $request->conditions_provinces;

		if($conditions_product != ''){
			$where .= ' AND product.id='.$conditions_product;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('product.id','product.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('sum(order_details.quantity) as total_quantity'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0)) AS total_quantity_success'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.quantity, 0)) AS total_quantity_cancel'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.quantity, 0)) AS total_quantity_delivery'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.quantity, 0)) AS total_quantity_waiting')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->join('product','order_details.product_id','=','product.id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('product.id')
						 			->orderBy(DB::raw('sum(order_details.total_price)'),'DESC')->get();

		return view('admin.statistic.product',compact('product_group','channel','users','provinces','statistics_product'));
	}

	public function getProductGroup(Request $request){

		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_customers 		= $request->conditions_customers;
		$conditions_channel 		= $request->conditions_channel;
		$conditions_staff 			= $request->conditions_staff;
		$conditions_provinces 		= $request->conditions_provinces;
		$conditions_product_group 	= $request->conditions_product_group;	 

		if($conditions_product_group != ''){
			$where .= ' AND product_group.id='.$conditions_product_group;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('product_group.id','product_group.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('sum(order_details.quantity) as total_quantity'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0)) AS total_quantity_success'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.quantity, 0)) AS total_quantity_cancel'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.quantity, 0)) AS total_quantity_delivery'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.quantity, 0)) AS total_quantity_waiting')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->join('product','order_details.product_id','=','product.id')
									->join('product_group','product_group.id','=','product.product_group_id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('product_group.id')
						 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();

		return view('admin.statistic.product-group',compact('product_group','channel','users','provinces','statistics_product'));
	}

	public function getChannel(Request $request){
		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_customers 		= $request->conditions_customers;
		$conditions_channel 		= $request->conditions_channel;
		$conditions_staff 			= $request->conditions_staff;
		$conditions_provinces 		= $request->conditions_provinces;
		$conditions_product_group 	= $request->conditions_product_group;	 

		if($conditions_product_group != ''){
			$where .= ' AND product_group.id='.$conditions_product_group;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('channel.id','channel.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('count(orders.id) as total_quantity'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
									DB::raw('SUM(IF(orders.order_status = 3, 1, 0)) AS total_quantity_success'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
									DB::raw('SUM(IF(orders.order_status = 4, 1, 0)) AS total_quantity_cancel'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
									DB::raw('SUM(IF(orders.order_status = 2, 1, 0)) AS total_quantity_delivery'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
									DB::raw('SUM(IF(orders.order_status = 0, 1, 0)) AS total_quantity_waiting')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('channel.id')
						 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();

		return view('admin.statistic.channel',compact('product_group','channel','users','provinces','statistics_product'));
	}

	public function getCustomer(Request $request){

		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_product 	= $request->conditions_product;
		$conditions_customers 	= $request->conditions_customers;
		$conditions_channel 	= $request->conditions_channel;
		$conditions_staff 		= $request->conditions_staff;
		$conditions_provinces 	= $request->conditions_provinces;

		if($conditions_product != ''){
			$where .= ' AND product.id='.$conditions_product;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('product.id','product.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('sum(order_details.quantity) as total_quantity'),
									DB::raw('sum(if(orders.order_status = 3, "order_details.total_price", 0)) AS total_price_success'),
									DB::raw('sum(if(orders.order_status = 3, "order_details.quantity", 0)) AS total_quantity_success')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->join('product','order_details.product_id','=','product.id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('product.id')
						 			->orderBy(DB::raw('sum(order_details.total_price)'),'DESC')->get();

		return view('admin.statistic.customer',compact('product_group','channel','users','provinces','statistics_product'));
	}	


	public function getStaff(Request $request){

		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_customers 		= $request->conditions_customers;
		$conditions_channel 		= $request->conditions_channel;
		$conditions_staff 			= $request->conditions_staff;
		$conditions_provinces 		= $request->conditions_provinces;
		$conditions_product_group 	= $request->conditions_product_group;	 

		if($conditions_product_group != ''){
			$where .= ' AND product_group.id='.$conditions_product_group;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('users.id','users.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('count(orders.id) as total_quantity'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
									DB::raw('SUM(IF(orders.order_status = 3, 1, 0)) AS total_quantity_success'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
									DB::raw('SUM(IF(orders.order_status = 4, 1, 0)) AS total_quantity_cancel'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
									DB::raw('SUM(IF(orders.order_status = 2, 1, 0)) AS total_quantity_delivery'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
									DB::raw('SUM(IF(orders.order_status = 0, 1, 0)) AS total_quantity_waiting')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('users.id')
						 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();

		return view('admin.statistic.staff',compact('product_group','channel','users','provinces','statistics_product'));
	}		


	public function getRegions(Request $request){

		$where = '';
		$product_group = ProductGroup::select('id','name')->get();
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_customers 		= $request->conditions_customers;
		$conditions_channel 		= $request->conditions_channel;
		$conditions_staff 			= $request->conditions_staff;
		$conditions_provinces 		= $request->conditions_provinces;
		$conditions_product_group 	= $request->conditions_product_group;	 

		if($conditions_product_group != ''){
			$where .= ' AND product_group.id='.$conditions_product_group;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $statistics_product = new OrderDetails();
	    	$statistics_product = $statistics_product->select('provinces.id','provinces.name',
									DB::raw('sum(order_details.total_price) as total_price'),
									DB::raw('count(orders.id) as total_quantity'),
									DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
									DB::raw('SUM(IF(orders.order_status = 3, 1, 0)) AS total_quantity_success'),
									DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
									DB::raw('SUM(IF(orders.order_status = 4, 1, 0)) AS total_quantity_cancel'),
									DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
									DB::raw('SUM(IF(orders.order_status = 2, 1, 0)) AS total_quantity_delivery'),
									DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
									DB::raw('SUM(IF(orders.order_status = 0, 1, 0)) AS total_quantity_waiting')
									)
	    							->join('orders','orders.id','=','order_details.order_id')
									->leftJoin('customers','orders.customer_id','=','customers.id')
									->leftJoin('channel','orders.channel_id','=','channel.id')
									->leftJoin('users','orders.user_id','=','users.id')
									->leftJoin('provinces','customers.province_id','=','provinces.id')
									->whereRaw('1'.$where)
									->groupBy('provinces.id')
						 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();

		return view('admin.statistic.regions',compact('product_group','channel','users','provinces','statistics_product'));
	}

	public function getStatistic(Request $request){
		return view('admin.statistic.dashboard');
	}

	public function getSynthetic(Request $request){
		$where = '';
		$channel = Channel::select('id','name')->get();
		$users = User::select('id','name')->get();
		$provinces = Provinces::select('id','name')->get();

		$conditions_customers 		= $request->conditions_customers;
		$conditions_channel 		= $request->conditions_channel;
		$conditions_staff 			= $request->conditions_staff;
		$conditions_provinces 		= $request->conditions_provinces; 
		$conditions_product 		= $request->conditions_product; 
		$conditions_customer 		= $request->conditions_customer; 

		$product = Product::select('id','name')->where('id',$request->conditions_product)->get();
		$customer = Customers::select('id','name')->where('id',$request->conditions_customer)->get();

		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customers;
		}
		if($conditions_channel != ''){
			$where .= ' AND orders.channel_id='.$conditions_channel;
		}
		if($conditions_staff != ''){
			$where .= ' AND orders.user_id='.$conditions_staff;
		}
		if($conditions_provinces != ''){
			$where .= ' AND orders.receiver_provinces='.$conditions_provinces;
		}
		if($conditions_product != ''){
			$where .= ' AND order_details.product_id='.$conditions_product;
		}
		if($conditions_customers != ''){
			$where .= ' AND orders.customer_id='.$conditions_customer;
		}

		if($request->has('filter-date-start') && $request->has('filter-date-end')){
           	$where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            
        }else{
            if($request->has('filter-date-start')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-start").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-start").' 00:00:00')->addDay()).'"';
            }elseif($request->has('filter-date-end')){
                $where .= ' AND orders.created_at > "'.$request->GET("filter-date-end").'" AND orders.created_at < "'.(Carbon::createFromFormat("Y-m-d h:i:s",$request->GET("filter-date-end").' 00:00:00')->addDay()).'"';
            }
        }

        $filter_by = $request->filter_by;
        // Nếu là Đơn hàng
		if($filter_by == 'order'){
			$statistics = DB::table('orders')->select(
							DB::raw('sum(order_details.total_price) as total_price'),
							DB::raw('count(orders.id) as total_quantity'),
							DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
							DB::raw('SUM(IF(orders.order_status = 3, 1, 0)) AS total_quantity_success'),
							DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
							DB::raw('SUM(IF(orders.order_status = 4, 1, 0)) AS total_quantity_cancel'),
							DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
							DB::raw('SUM(IF(orders.order_status = 2, 1, 0)) AS total_quantity_delivery'),
							DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
							DB::raw('SUM(IF(orders.order_status = 0, 1, 0)) AS total_quantity_waiting'),
							DB::raw('SUM(IF(orders.order_status = 6, order_details.total_price, 0)) AS total_price_return'),
							DB::raw('SUM(IF(orders.order_status = 6, 1, 0)) AS total_quantity_return')
							)
							->leftJoin('order_details','order_details.order_id','=','orders.id')
							->leftJoin('customers','orders.customer_id','=','customers.id')
							->leftJoin('channel','orders.channel_id','=','channel.id')
							->leftJoin('users','orders.user_id','=','users.id')
							->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
							->whereRaw('1'.$where)
				 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();
		}else{
			$statistics = DB::table('orders')->select(
							DB::raw('sum(order_details.total_price) as total_price'),
							DB::raw('sum(order_details.quantity) as total_quantity'),
							DB::raw('SUM(IF(orders.order_status = 3, order_details.total_price, 0)) AS total_price_success'),
							DB::raw('SUM(IF(orders.order_status = 3, 1, 0)) AS total_quantity_success'),
							DB::raw('SUM(IF(orders.order_status = 4, order_details.total_price, 0)) AS total_price_cancel'),
							DB::raw('SUM(IF(orders.order_status = 4, 1, 0)) AS total_quantity_cancel'),
							DB::raw('SUM(IF(orders.order_status = 2, order_details.total_price, 0)) AS total_price_delivery'),
							DB::raw('SUM(IF(orders.order_status = 2, 1, 0)) AS total_quantity_delivery'),
							DB::raw('SUM(IF(orders.order_status = 0, order_details.total_price, 0)) AS total_price_waiting'),
							DB::raw('SUM(IF(orders.order_status = 0, 1, 0)) AS total_quantity_waiting'),
							DB::raw('SUM(IF(orders.order_status = 6, order_details.total_price, 0)) AS total_price_return'),
							DB::raw('SUM(IF(orders.order_status = 6, 1, 0)) AS total_quantity_return')
							)
							->leftJoin('order_details','order_details.order_id','=','orders.id')
							->leftJoin('customers','orders.customer_id','=','customers.id')
							->leftJoin('channel','orders.channel_id','=','channel.id')
							->leftJoin('users','orders.user_id','=','users.id')
							->leftJoin('provinces','orders.receiver_provinces','=','provinces.id')
							->whereRaw('1'.$where)
				 			->orderBy(DB::raw('SUM(IF(orders.order_status = 3, order_details.quantity, 0))'),'DESC')->get();
		}

		return view('admin.statistic.synthetic',compact('channel','users','provinces','statistics','product','customer'));
	}

}
