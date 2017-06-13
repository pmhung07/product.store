<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mbarwick83\Shorty\Facades\Shorty;

use App\Http\Requests;

use App\ProductGroup;
use App\Product;

use App\AffiliateGroup;
use App\AffiliateGroupUser;
use App\AffiliateUserProduct;
use App\AffiliateUserOrderLogs;
use App\AffiliateUserProductLogs;
use App\AffiliateProduct;

use App\User;

use Carbon\Carbon;

use Auth;
use DB;

class AffiliateController extends Controller
{
    public function getManagerProduct(Request $request){
    	$sort = 'updated_at';
        $orderby = 'desc';

        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = AffiliateProduct::select('affiliate_product.*','product.id as product_id','product.sku as product_sku','product.image as product_image','product.name as product_name','product.price as product_price','product.promotion_price as product_promotion_price','product_group.id as product_group_id','product_group.name as product_group_name')
                        ->leftjoin('product','product.id' ,'=', 'affiliate_product.product_id')
                        ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                        ->where('product.parent_id', '=', 0);

        if ($request->has('filter-product-sku') && $request->GET('filter-product-sku') != ""){
            $rows = $rows->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
        }

        if ($request->has('filter-product-name') && $request->GET('filter-product-name') != ""){
            $rows = $rows->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
        }

        if ($request->has('filter-product-groupt-id') && $request->GET('filter-product-groupt-id') != -1){
            $rows = $rows->where('product_group.id',$request->GET("filter-product-groupt-id"));
        }

        $data = $rows->groupBy('product.id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.manager-product', ['rows' => $data, 'total_row' => $total_row, 'product_group' => $product_group]);
    }

    public function getMyProduct(Request $request){
        $sort = 'updated_at';
        $orderby = 'desc';

        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = AffiliateUserProduct::select('affiliate_user_product.*','affiliate_product.product_id as my_affiliate_product_id','affiliate_product.profit as my_affiliate_profit','product.name as product_name','product.id as product_id','product.sku as product_sku','product.image as product_image','product.name as product_name','product.price as product_price','product.promotion_price as product_promotion_price','product_group.id as product_group_id','product_group.name as product_group_name')
                        ->leftjoin('affiliate_product','affiliate_product.id','=','affiliate_user_product.affiliate_product_id')
                        ->leftjoin('product','product.id' ,'=', 'affiliate_product.product_id')
                        ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                        ->where('product.parent_id', '=', 0)
                        ->where('affiliate_user_product.user_id','=',Auth::user()->id);

        if ($request->has('filter-product-sku') && $request->GET('filter-product-sku') != ""){
            $rows = $rows->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
        }

        if ($request->has('filter-product-name') && $request->GET('filter-product-name') != ""){
            $rows = $rows->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
        }

        if ($request->has('filter-product-groupt-id') && $request->GET('filter-product-groupt-id') != -1){
            $rows = $rows->where('product_group.id',$request->GET("filter-product-groupt-id"));
        }

        $data = $rows->groupBy('affiliate_user_product.id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.collaborators-product', ['rows' => $data, 'total_row' => $total_row, 'product_group' => $product_group]);
    }

    public function addManagerProduct(Request $request){
        $this->validate($request,
            [
                'product_id' => 'required|unique:affiliate_product,product_id',
                'profit' => 'required',
            ],
            [
                'product_id.required' => 'Vui lòng chọn sản phẩm!',
                'product_id.unique' => 'Sản phẩm này đã tồn tại trong hệ thống !',
                'profit.required' => 'Vui lòng nhập % lợi nhuận cho cộng tác viên!',
            ]
        );
        $affiliate_product = new AffiliateProduct();
        $affiliate_product->product_id = $request->product_id;
        $affiliate_product->profit = $request->profit;
        $affiliate_product->save();
        return redirect()->route('admin.affiliate.manager-product')->with(['flash_message' => 'Thêm sản phẩm thành công!']);
    }

    public function getCollaboratorsGroup(Request $request){
        $sort = 'updated_at';
        $orderby = 'desc';

        $rows = AffiliateGroup::select('affiliate_group.*',
                DB::raw('SUM(IFNULL(affiliate_user_product_logs.current_price * affiliate_user_product_logs.product_quantity, 0)) as total_price'),
                DB::raw('SUM(IFNULL(affiliate_user_product_logs.product_quantity, 0)) AS total_quantity'),
                DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as profit_price'))
                ->leftjoin('affiliate_group_user','affiliate_group_user.affiliate_group_id' ,'=', 'affiliate_group.id')
                ->leftjoin('affiliate_user_product_logs', 'affiliate_user_product_logs.user_id', '=', 'affiliate_group_user.user_id');
                //->where('affiliate_group_user.leader', '=', 1);


        if ($request->has('group-name') && $request->GET('group-name') != ""){
            $rows = $rows->where('affiliate_group.name','LIKE','%'.$request->GET("group-name").'%');
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data = $rows->groupBy('affiliate_group.id')->groupBy('affiliate_group.id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.manager-collaborators-group', ['rows' => $data, 'total_row' => $total_row]);
    }

    public function addCollaboratorsGroup(Request $request){
        $this->validate($request,
            [
                'group_name' => 'required',
            ],
            [
                'group_name.required' => 'Vui lòng nhập tên nhóm cộng tác viên!',
            ]
        );
        $affiliate_group = new AffiliateGroup();
        $affiliate_group->name = date('dmyhis').' / '.$request->group_name;
        $affiliate_group->save();
        return redirect()->route('admin.affiliate.collaborators-group')->with(['flash_message' => 'Thêm nhóm cộng tác viên thành công!']);
    }

    public function getUsersCollaboratorsGroup(Request $request, $group_id){
        $sort = 'affiliate_group_user.leader';
        $orderby = 'desc';

        $affiliate_group = AffiliateGroup::select('affiliate_group.*')
                        ->where('id', '=', $group_id)->get()->toArray();

        $rows = AffiliateGroupUser::select('affiliate_group_user.*','users.name as user_name','users.id as user_id',
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.current_price * affiliate_user_product_logs.product_quantity, 0)) as total_price'),
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.product_quantity, 0)) AS total_quantity'),
                        DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as total_profit'))
                        ->leftjoin('users','users.id' ,'=', 'affiliate_group_user.user_id')
                        ->leftjoin('affiliate_user_product_logs','affiliate_user_product_logs.user_id' ,'=', 'affiliate_group_user.user_id')
                        ->where('affiliate_group_user.affiliate_group_id', '=', $group_id);


        if ($request->has('user-name') && $request->GET('user-name') != ""){
            $rows = $rows->where('users.name','LIKE','%'.$request->GET("user-name").'%');
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data = $rows->orderBy($sort,$orderby)->groupBy('affiliate_group_user.id')->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.manager-users-collaborators-group', ['rows' => $data, 'total_row' => $total_row, 'affiliate_group' => $affiliate_group]);
    }

    public function addUsersCollaboratorsGroup(Request $request, $group_id){
        $this->validate($request,
            ['user_id' => 'required'],
            ['user_id.required' => 'Vui lòng tìm kiếm và chọn cộng tác viên!']
        );

        $count = AffiliateGroupUser::select('id')
                ->where('user_id', '=', $request->user_id)
                ->where('affiliate_group_id', '=', $group_id)->get()->toArray();


        if(count($count) <= 0){
            $affiliate_group_user = new AffiliateGroupUser();
            $affiliate_group_user->user_id = $request->user_id;
            $affiliate_group_user->affiliate_group_id = $group_id;
            $affiliate_group_user->leader = $request->user_leader;
            $affiliate_group_user->save();
            return redirect()->route('admin.affiliate.users-collaborators-group',$group_id)->with(['flash_message' => 'Thêm cộng tác viên thành công!']);
        }else{
            return redirect()->route('admin.affiliate.users-collaborators-group',$group_id)->with(['error_message' => 'Cộng tác viên này đã tồn tại trong nhóm!']);
        }
    }

    public function getUsersProduct(Request $request, $user_id){
        $sort = 'created_at';
        $orderby = 'desc';

        $user = User::select('id','name')->where('id',$user_id)->get()->toArray();
        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = AffiliateUserProductLogs::select('affiliate_user_product_logs.*','affiliate_product.profit as affiliate_product_profit','product.name as product_name','product.id as product_id','product.sku as product_sku','product.image as product_image','product.name as product_name','product.price as product_price','product.promotion_price as product_promotion_price','product_group.id as product_group_id','product_group.name as product_group_name',
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.current_price * affiliate_user_product_logs.product_quantity, 0)) as total_price'),
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.product_quantity, 0)) AS total_quantity'),
                        DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as total_profit'))
                        ->leftjoin('affiliate_product','affiliate_product.product_id','=','affiliate_user_product_logs.product_id')
                        ->leftjoin('product','product.id' ,'=', 'affiliate_user_product_logs.product_id')
                        ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                        ->where('product.parent_id', '=', 0)
                        ->where('user_id','=',$user_id);

        if ($request->has('filter-product-sku') && $request->GET('filter-product-sku') != ""){
            $rows = $rows->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
        }

        if ($request->has('filter-product-name') && $request->GET('filter-product-name') != ""){
            $rows = $rows->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
        }

        if ($request->has('filter-product-groupt-id') && $request->GET('filter-product-groupt-id') != -1){
            $rows = $rows->where('product_group.id',$request->GET("filter-product-groupt-id"));
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data = $rows->groupBy('affiliate_user_product_logs.product_id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.manager-users-product', ['rows' => $data, 'total_row' => $total_row, 'user_id' => $user_id, 'product_group' => $product_group, 'user' => $user]);
    }

    public function getUsers(Request $request){
        $sort = 'updated_at';
        $orderby = 'desc';


        $rows = User::select('users.*',
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.current_price * affiliate_user_product_logs.product_quantity, 0)) as total_price'),
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.product_quantity, 0)) AS total_quantity'),
                        DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as total_profit'))
                        ->leftjoin('affiliate_user_product_logs','affiliate_user_product_logs.user_id' ,'=', 'users.id')
                        ->where('users.user_position_id', '=', 4);


        if ($request->has('user-name') && $request->GET('user-name') != ""){
            $rows = $rows->where('users.name','LIKE','%'.$request->GET("user-name").'%');
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data = $rows->groupBy('users.id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.manager-users', ['rows' => $data, 'total_row' => $total_row]);
    }

    public function updateProfit(Request $request){
        $affiliate_product = new AffiliateProduct();
        $affiliate_product = AffiliateProduct::find($request->product_id);
        $affiliate_product->profit = $request->profit;
        $affiliate_product->save();
        return response()->json(['msg' => 'Bạn đã cập nhật hoa hồng cho sản phẩm này thành công!']);
    }

    public function getMyProductStatistics(Request $request){
        $sort = 'created_at';
        $orderby = 'desc';

        $product_group = ProductGroup::select('id','name','parent_id')->get()->toArray();

        $rows = AffiliateUserProductLogs::select('affiliate_user_product_logs.*','affiliate_product.profit as affiliate_product_profit','product.name as product_name','product.id as product_id','product.sku as product_sku','product.image as product_image','product.name as product_name','product.price as product_price','product.promotion_price as product_promotion_price','product_group.id as product_group_id','product_group.name as product_group_name',
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.current_price * affiliate_user_product_logs.product_quantity, 0)) as total_price'),
                        DB::raw('SUM(IFNULL(affiliate_user_product_logs.product_quantity, 0)) AS total_quantity'),
                        DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as total_profit'))
                        ->leftjoin('affiliate_product','affiliate_product.product_id','=','affiliate_user_product_logs.product_id')
                        ->leftjoin('product','product.id' ,'=', 'affiliate_user_product_logs.product_id')
                        ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                        ->where('product.parent_id', '=', 0)
                        ->where('user_id','=',Auth::user()->id);

        $sum_total_profit = AffiliateUserProductLogs::select(
                            DB::raw('SUM(IFNULL(((affiliate_user_product_logs.current_price /100) * affiliate_user_product_logs.current_profit) * affiliate_user_product_logs.product_quantity, 0)) as total_profit'))
                            ->leftjoin('product','product.id' ,'=', 'affiliate_user_product_logs.product_id')
                            ->leftjoin('product_group', 'product.product_group_id', '=', 'product_group.id')
                            ->where('product.parent_id', '=', 0)
                            ->where('user_id','=',Auth::user()->id);

        if ($request->has('filter-product-sku') && $request->GET('filter-product-sku') != ""){
            $rows = $rows->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
            $sum_total_profit = $sum_total_profit->where('product.sku','LIKE','%'.$request->GET("filter-product-sku").'%');
        }

        if ($request->has('filter-product-name') && $request->GET('filter-product-name') != ""){
            $rows = $rows->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
            $sum_total_profit = $sum_total_profit->where('product.name','LIKE','%'.$request->GET("filter-product-name").'%');
        }

        if ($request->has('filter-product-groupt-id') && $request->GET('filter-product-groupt-id') != -1){
            $rows = $rows->where('product_group.id',$request->GET("filter-product-groupt-id"));
            $sum_total_profit = $sum_total_profit->where('product_group.id',$request->GET("filter-product-groupt-id"));
        }

        if($request->has('filter-date-start') && $request->has('filter-date-end')){
            $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            $sum_total_profit = $sum_total_profit->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                         ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));

        }else{
            if($request->has('filter-date-start')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));
                $sum_total_profit = $sum_total_profit->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-start')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-start').' 00:00:00')->addDay()));

            }elseif($request->has('filter-date-end')){
                $rows = $rows->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
                $sum_total_profit = $sum_total_profit->where('affiliate_user_product_logs.created_at','>',($request->GET('filter-date-end')))
                             ->where('affiliate_user_product_logs.created_at','<',(Carbon::createFromFormat('Y-m-d h:i:s',$request->GET('filter-date-end').' 00:00:00')->addDay()));
            }
        }

        $data_total_profit = $sum_total_profit->get();
        $data = $rows->groupBy('affiliate_user_product_logs.product_id')->orderBy($sort,$orderby)->paginate(20);
        $total_row = count($data);
        return view('admin.affiliate.collaborators-product-statistics', ['rows' => $data, 'data_total_profit' => $data_total_profit, 'total_row' => $total_row, 'product_group' => $product_group]);
    }

    public function updateAffiliateUserProduct(Request $request){
        $check_affiliate_user_product = AffiliateUserProduct::select('id')->where('affiliate_product_id',$request->product_id)->where('user_id',Auth::user()->id)->get()->toArray();
        if(count($check_affiliate_user_product) > 0){
            return response()->json(['msg' => 'Bạn đã chọn sản phẩm này!']);
        }else{
            $affiliate_user_product = new AffiliateUserProduct();
            $affiliate_user_product->affiliate_product_id = $request->product_id;
            $affiliate_user_product->user_id = Auth::user()->id;
            $affiliate_user_product->save();
            return response()->json(['msg' => 'Chọn sản phẩm thành công!']);
        }
    }

    public function getDeleteProductAffiliate($id){
        $data = AffiliateProduct::find($id);
        $data->delete($id);
        return redirect()->route('admin.affiliate.manager-product')->with(['flash_message' => 'Sản phẩm này đã được xoá thành công trong hệ thống Affiliate!']);    
    }

    public function getDeleteCollaboratorsGroup($id){
        $data = AffiliateGroup::find($id);
        $data->delete($id);
        return redirect()->route('admin.affiliate.collaborators-group')->with(['flash_message' => 'Nhóm này đã được xoá thành công trong hệ thống Affiliate!']);    
    }

    public function getDeleteCollaboratorsGroupUser($id){
        $data = AffiliateGroupUser::find($id);
        $data->delete($id);
        return back()->with(['flash_message' => 'Xoá thành viên trong nhóm thành công!']);    
    }
}
