<?php

// ------------------------------------------------------------------------

if ( ! function_exists('write_file'))
{
	/**
	 * Write File
	 *
	 * Writes data to the file specified in the path.
	 * Creates a new file if non-existent.
	 *
	 * @param	string	$path	File path
	 * @param	string	$data	Data to write
	 * @param	string	$mode	fopen() mode (default: 'wb')
	 * @return	bool
	 */
	function write_file($path, $data, $mode = 'wb')
	{
		if ( ! $fp = @fopen($path, $mode))
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);

		for ($result = $written = 0, $length = strlen($data); $written < $length; $written += $result)
		{
			if (($result = fwrite($fp, substr($data, $written))) === FALSE)
			{
				break;
			}
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		return is_int($result);
	}
}

// ------------------------------------------------------------------------
//
// ------------------------------------------------------------------------

if ( ! function_exists('directory_map'))
{
	/**
	 * Create a Directory Map
	 *
	 * Reads the specified directory and builds an array
	 * representation of it. Sub-folders contained with the
	 * directory will be mapped as well.
	 *
	 * @param	string	$source_dir		Path to source
	 * @param	int	$directory_depth	Depth of directories to traverse
	 *						(0 = fully recursive, 1 = current dir, etc)
	 * @param	bool	$hidden			Whether to show hidden files
	 * @return	array
	 */
	function directory_map($source_dir, $directory_depth = 0, $hidden = FALSE)
	{
		if ($fp = @opendir($source_dir))
		{
			$filedata	= array();
			$new_depth	= $directory_depth - 1;
			$source_dir	= rtrim($source_dir, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

			while (FALSE !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ($file === '.' OR $file === '..' OR ($hidden === FALSE && $file[0] === '.'))
				{
					continue;
				}

				is_dir($source_dir.$file) && $file .= DIRECTORY_SEPARATOR;

				if (($directory_depth < 1 OR $new_depth > 0) && is_dir($source_dir.$file))
				{
					$filedata[$file] = directory_map($source_dir.$file, $new_depth, $hidden);
				}
				else
				{
					$filedata[] = $file;
				}
			}

			closedir($fp);
			return $filedata;
		}

		return FALSE;
	}
}

// Load categories
function cat_parent($data,$parent = 0,$str="--",$select=0){
	foreach($data as $val){
		$id = $val["id"];
		$name = $val['name'];

		if($val["parent_id"] == $parent){
			if($select != 0 && $id == $select){
				echo "<option value='$id' selected='selected'>$str $name</option>";
			}else{
				echo "<option value='$id'>$str $name</option>";
			}
			cat_parent($data,$id,$str."--",$select);
		}
	}
}

function list_cate($data, $parent = 0, $str=""){
	$i = 0;
	foreach ($data as $val){
		$i++;
		$id = $val['id'];
		$name = $val['name'];
		$parent_id = $val['parent_id'];

		if($val['parent_id'] == $parent) {
			echo '
			<tr class="footable-even" style="display: table-row;">
			    <td class="hasinput"><span class="footable-toggle"></span>
			      	#
			    </td>
			    <td>
			       '.$str.$name.'
			    </td>
			    <td class="text-right footable-visible footable-last-column">
                    <div class="btn-group">
                        <a href="'.URL::route('admin.product-group.getUpdate',$id).'" class="btn-white btn btn-xs">
                            <i class="fa fa-edit "></i> Sửa
                        </a>
                        <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.URL::route('admin.product-group.getDelete',$id).'"  class="btn-white btn btn-xs">
                            <i class="fa fa-trash "></i> Xoá
                        </a>
                    </div>
			    </td>
			</tr>';
			list_cate($data, $id, $str."-----| ");
		}
	}
}

function list_permissions($data, $parent = 0, $str=""){
	$i = 0;
	foreach ($data as $val){
		$i++;
		$id = $val['id'];
		$name = $val['name'];
		$slug = $val['slug'];
		$order = $val['order'];
		$parent_id = $val['parent_id'];

		if($val['parent_id'] == $parent) {
			echo '
			<tr class="footable-even" style="display: table-row;">
				<td class="text-center text-danger" style="font-weight:bold;">
			       '.$id.'
			    </td>
			    <td>
			       '.$str.$name.'
			    </td>
			    <td>
			       '.$str.$slug.'
			    </td>
			    <td>
			       '.$str.$order.'
			    </td>
			    <td class="text-right footable-visible footable-last-column">
			        <div class="btn-group">
			            <a href="'.URL::route('admin.permissions.getUpdate',$id).'" class="btn-warning btn btn-xs">
			                <i class="fa fa-edit "></i>
			                Sửa
			            </a>
			        </div>
			        <div class="btn-group">
			            <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.URL::route('admin.permissions.getDelete',$id).'" class="btn-danger btn btn-xs btn-delete">
			                <i class="fa fa-trash "></i>
			                Xoá
			            </a>
			        </div>
			    </td>
			</tr>';
			list_permissions($data, $id, $str."-----| ");
		}
	}
}

function list_post_categories($data, $parent = 0, $str=""){
	$i = 0;
	foreach ($data as $val){
		$i++;
		$id = $val['id'];
		$name = $val['name'];
		$parent_id = $val['parent_id'];

		if($val['parent_id'] == $parent) {
			echo '
			<tr class="footable-even" style="display: table-row;">
			    <td class="hasinput"><span class="footable-toggle"></span>
			      	#
			    </td>
			    <td>
			       '.$str.$name.'
			    </td>
			    <td class="text-right footable-visible footable-last-column">
                    <div class="btn-group">
                        <a href="'.URL::route('admin.post-categories.getUpdate',$id).'" class="btn-white btn btn-xs">
                            <i class="fa fa-edit "></i> Sửa
                        </a>
                        <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.URL::route('admin.post-categories.getDelete',$id).'"  class="btn-white btn btn-xs">
                            <i class="fa fa-trash "></i> Xoá
                        </a>
                    </div>
			    </td>
			</tr>';
			list_post_categories_loop($data, $id, $str."-----| ");
		}
	}
}

function list_post_categories_loop($data, $parent = 0, $str=""){
	$i = 0;
	foreach ($data as $val){
		$i++;
		$id = $val['id'];
		$name = $val['name'];
		$parent_id = $val['parent_id'];

		if($val['parent_id'] == $parent) {
			echo '
			<tr class="footable-even" style="display: table-row;">
			    <td class="hasinput"><span class="footable-toggle"></span>
			      	#
			    </td>
			    <td>
			       '.$str.$name.'
			    </td>
			    <td class="text-right footable-visible footable-last-column">
                    <div class="btn-group">
                        <a href="'.URL::route('admin.post-categories.getUpdate',$id).'" class="btn-white btn btn-xs">
                            <i class="fa fa-edit "></i> Sửa
                        </a>
                        <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="'.URL::route('admin.post-categories.getDelete',$id).'"  class="btn-white btn btn-xs">
                            <i class="fa fa-trash "></i> Xoá
                        </a>
                    </div>
			    </td>
			</tr>';
			list_cate($data, $id, $str."-----| ");
		}
	}
}

function list_permissions_checkbox($data, $parent = 0, $str="",$arr_check=array()){
	$i = 1;
	foreach ($data as $val){
		$i++;
		$id = $val['id'];
		$name = $val['name'];
		$slug = $val['slug'];
		$order = $val['order'];
		$parent_id = $val['parent_id'];
		$colortext = '';
		$style = '';
		$checked = '';
		if(count($arr_check) > 0){
			if(in_array($val['id'], $arr_check)){
				$checked = 'checked';
			}
		}

		if($val['parent_id'] == $parent) {
			if($val['parent_id'] == 0){
				$colortext = "style='font-weight:600;'";
				$style= "style='margin-left:0px;margin-right:0px;background: #f3f1f1;padding-bottom: 7px;margin-bottom: 0px;border-bottom: solid 1px #e4e4e4;'";
			}else{
				$style="style='margin-left:0px;margin-right:0px;margin-bottom: 0px;padding-bottom: 7px;background: #f9f9f9;'";
			}
			echo '<div class="form-group" '.$style.'>
                    <div class="col-sm-12">
                        <label class="checkbox-inline" '.$colortext.'>
                        <input style="margin-top: 2px;" '.$checked.' name="permissions_check[]" type="checkbox" value="'.$id.'" id="inlineCheckbox"> '.$str.$name.' </label>
                    </div>
                </div>';
			list_permissions_checkbox($data, $id, $str."-----| ",$arr_check);
		}
	$i++;}
}

// Trạng thái đơn hàng

	//	Status: 0 - Đang tạo đơn hàng -> Có thể chỉnh sửa
	// 	Status: 1 - Đã tạo đơn hàng -> Không thể chỉnh sửa -> Chuyển sang trạng thái Đang chờ duyệt
		//	Order_status: 0 ->	Đang chờ chuyệt
		//	Order_status: 1 ->	Đơn hàng đã duyệt
		//	Order_status: 2 ->	Đơn hàng đã duyệt - Đợi xử lý vận đơn
			//	Lading_status: 0 ->	Đợi lấy hàng
			//	Lading_status: 1 ->	Đang giao hàng
			//	Lading_status: 2 ->	Đã giao hàng
			//	Lading_status: 3 ->	Hoàn thành - Bàn giao
		//	Order_status: 3 ->	Đơn hàng thành công
		//	Order_status: 4 ->	Đơn hàng huỷ

function getUrlOrderDetails($order_id ,$status = 0, $order_status = 0, $lading_status = 0, $call_status = 0){

	$status_call = '';
	if($call_status == 1){
		$status_call.= '<small class="label" style="background-color: #e5f2ce!important;color:black;border: solid 1px #cddeb5;"><i class="fa fa-phone"></i></small>';
	}elseif($call_status == 2){
		$status_call.= '<small class="label" style="background-color: #ffced3!important;color:black;border: solid 1px #f7b9c0;"><i class="fa fa-phone"></i></small>';
	}

	if($status == 0){
		return '<a style="background: #b3b3b3;border: #b3b3b3;" class="btn-success btn btn-xs">
                    Đang tạo..
                </a>';
	}
	if($status == 1 && $order_status == 0){

		return '<small class="label lb-sm-waiting"><i class="fa fa-clock-o"></i> Chờ duyệt</small> '.$status_call;
	}
	if($status == 1 && $order_status == 1){
		return '<a class="btn-info btn btn-xs">
                    Đã duyệt đơn
                </a>';
	}

	if($status == 1 && $order_status == 2){
		return '<small class="label lb-sm-delivery"><i class="fa fa-truck"></i> Vận chuyển</small>';
	}

	if($status == 1 && $order_status == 3){
		return '<small class="label lb-sm-success"><i class="fa fa-check"></i> Thành công</small>';
	}

	if($status == 1 && $order_status == 4){
		return '<small class="label lb-sm-cancel"><i class="fa fa-times"></i> Huỷ đơn</small>';
	}

	if($status == 1 && $order_status == 5){
		return '<small class="label lb-sm-refresh"><i class="fa fa-times"></i> Đơn hàng ảo</small>';
	}

	if($status == 1 && $order_status == 6){
		return '<small class="label lb-sm-return"><i class="fa fa-retweet"></i> Trả hàng</small>';
	}
}


function getUrlOrderDetailsStatus($order_id ,$status = 0, $order_status = 0, $lading_status = 0){
	if($status == 0){
		return '<a style="background: #b3b3b3;border: #b3b3b3;" class="btn-success btn btn-xs">
                    <i class="fa fa-clock-o "></i> Đang tạo..
                </a>';
	}
	if($status == 1 && $order_status == 0){
		return '<a class="btn-warning btn btn-xs">
                    <i class="fa fa-hand-o-up "></i> Chờ duyệt..
                </a>';
	}
	if($status == 1 && $order_status == 1){
		return '<a class="btn-info btn btn-xs">
                    <i class="fa fa-truck "></i> Đã duyệt..
                </a>';
	}

	if($status == 1 && $order_status == 2){
		return '<a class="btn-success btn btn-xs">
                    <i class="fa fa-truck "></i> Vận chuyển..
                </a>';
	}

	if($status == 1 && $order_status == 3){
		return '<a class="btn-primary btn btn-xs">
                    <i class="fa fa-check "></i> Thành công
                </a>';
	}

	if($status == 1 && $order_status == 4){
		return '<a class="btn-danger btn btn-xs">
                    <i class="fa fa-times "></i> Huỷ đơn
                </a>';
	}
}

function getLadingStatus($order_status = 0, $lading_status = 0){
	if($order_status == 3){
		return '<small class="label lb-sm-success">Đã giao hàng</small>';
	}else{
		if($lading_status == 0){
			return '<small class="label lb-sm-waiting">Chờ xử lý</small>';
		}elseif($lading_status == 1){
			return '<small class="label lb-sm-waiting">Đợi lấy hàng</small>';
		}elseif($lading_status == 2){
			return '<small class="label lb-sm-delivery">Đang giao hàng</small>';
		}elseif($lading_status == 3){
			return '<small class="label lb-sm-success">Đã giao hàng</small>';
		}
	}
}

function getPaymentStatus($order_status = 0, $payment_status = 0){
	if($order_status == 3){
		return '<small class="label lb-sm-success">Đã thanh toán</small>';
	}else{
		if($payment_status == 0){
			return '<small class="label lb-sm-waiting">Chờ xử lý</small>';
		}elseif($payment_status == 1){
			return '<small class="label lb-sm-success">Đã thanh toán</small>';
		}elseif($payment_status == 2){
			return '<small class="label lb-sm-cancel">Chưa thanh toán</small>';
		}
	}
}

function countOrderByStatus($order_status){
	if($order_status == 0){
		$count_orders  = App\Orders::where('order_status','=',0)->where('status','=',1)->count();
	}elseif($order_status == 2){
		$count_orders = App\Orders::where('order_status','=',2)->where('status','=',1)->count();
	}else{
		$count_orders = 0;
	}
    return $count_orders;
}

function update_inventory($order_id, $product_id, $quantity, $warehouse){

	// Lấy sản phẩm trong kho
	$warehouse_inventory = App\WarehouseInventory::where('product_id','=',$product_id)->where('warehouse_id','=',$warehouse)->get();
	if($warehouse_inventory[0]->quantity > $quantity){
		$quantity_sub = $quantity;
		$data = new App\WarehouseInventory();
        $data = App\WarehouseInventory::findOrFail($warehouse_inventory[0]->id);
    	$data->quantity = ($warehouse_inventory[0]->quantity) - $quantity;
    	$data->save();
	}elseif($warehouse_inventory[0]->quantity == $quantity){
		$quantity_sub = $quantity;
		$data = App\WarehouseInventory::findOrFail($warehouse_inventory[0]->id);
    	$data->delete($warehouse_inventory[0]->id);
	}else{
		$quantity_sub = $warehouse_inventory[0]->quantity;
		$balances = $quantity - $warehouse_inventory[0]->quantity;
		$data = App\WarehouseInventory::findOrFail($warehouse_inventory[0]->id);
    	$data->delete($warehouse_inventory[0]->id);
    	update_inventory($order_id,$product_id, $balances, $warehouse);
	}

	// Update vào order_details_product_in_stock
	$temporary = new App\OrderDetailsProductInStock();
	$temporary->order_id = $order_id;
    $temporary->product_id = $product_id;
    $temporary->quantity_sub = $quantity_sub;
    $temporary->price_in = $warehouse_inventory[0]->price;
    $temporary->save();
}

function update_inventory_return_product($arr_product_id,$order_id,$warehouse_id){
	$dataInsert = array();
	foreach($arr_product_id as $key => $value){

		// Check bản ghi đầu tiên trong stock tạm
        $order_details_product_in_stock = App\OrderDetailsProductInStock::where('product_id','=',$key)->where('order_id','=',$order_id)->get();
        // Kiểm tra xem khách hàng trả lại bao nhiêu sản phẩm
        if($order_details_product_in_stock[0]->quantity_sub > $value){

        	// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;
        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->quantity_sub = ($order_details_product_in_stock[0]->quantity_sub) - $quantity_return_product;
	    	$temporary->save();
	    	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $quantity_return_product;
	    	$data->price = $price_in;
	    	$data->save();

		}elseif($order_details_product_in_stock[0]->quantity_sub == $value){

			// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;
        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->delete($order_details_product_in_stock[0]->id);
	    	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $quantity_return_product;
	    	$data->price = $price_in;
	    	$data->save();

		}else{

			$arr_product_id_sub = array();
			// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;

        	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $order_details_product_in_stock[0]->quantity_sub;
	    	$data->price = $price_in;
	    	$data->save();

        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
        	$balances = $quantity_return_product - $order_details_product_in_stock[0]->quantity_sub;
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->delete($order_details_product_in_stock[0]->id);

	    	// Trừ tiêp các rows tiếp theo
	    	$arr_product_id_sub[$key] = $balances;
	    	update_inventory_return_product_sub($arr_product_id_sub,$order_id,$warehouse_id);

		}
    }
}

function update_inventory_return_product_sub($arr_product_id,$order_id,$warehouse_id){

	foreach($arr_product_id as $key => $value){
        $order_details_product_in_stock = App\OrderDetailsProductInStock::where('product_id','=',$key)->where('order_id','=',$order_id)->get();
        // Kiểm tra xem khách hàng trả lại bao nhiêu sản phẩm
        if($order_details_product_in_stock[0]->quantity_sub > $value){

        	// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;
        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->quantity_sub = ($order_details_product_in_stock[0]->quantity_sub) - $quantity_return_product;
	    	$temporary->save();
	    	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $quantity_return_product;
	    	$data->price = $price_in;
	    	$data->save();

		}elseif($order_details_product_in_stock[0]->quantity_sub == $value){

			// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;
        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->delete($order_details_product_in_stock[0]->id);
	    	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $quantity_return_product;
	    	$data->price = $price_in;
	    	$data->save();

		}else{

			$arr_product_id_sub = array();
			// Sản phẩm và số lượng trả về (Update số lượng này vào kho)
        	$product_return = $key;
        	$quantity_return_product = $value;
        	$price_in = $order_details_product_in_stock[0]->price_in;

        	// Insert data vào kho hàng
	    	$data = new App\WarehouseInventory();
	    	$data->warehouse_id = $warehouse_id;
	    	$data->product_id = $product_return;
	    	$data->quantity = $order_details_product_in_stock[0]->quantity_sub;
	    	$data->price = $price_in;
	    	$data->save();

        	// Update lại bảng product_in_stock và lấy giá gốc để nhập lại vào kho
        	$balances = $quantity_return_product - $order_details_product_in_stock[0]->quantity_sub;
			$temporary = new App\OrderDetailsProductInStock();
	        $temporary = App\OrderDetailsProductInStock::findOrFail($order_details_product_in_stock[0]->id);
	    	$temporary->delete($order_details_product_in_stock[0]->id);

	    	// Trừ tiêp các rows tiếp theo
	    	$arr_product_id_sub[$key] = $balances;

	    	update_inventory_return_product_sub($arr_product_id_sub,$order_id,$warehouse_id);

		}
    }
}

function get_user_name_position($user_id){
	$rows = App\User::select('users.*')->where('users.id','=',$user_id)->get()->first();
	if($rows['user_position_id'] == 0){
		echo '<a>'.$rows['name'].'</a><br><span class="font-small-user-position-success">Administrator</span>';
	}else{
		$rows_pos = App\UsersPosition::select('users_position.name')->where('id','=',$rows['user_position_id'])->get()->first();
		echo $rows['name'].'<br><span class="font-small-user-position-primary">'.$rows_pos['name'].'</span>';
	}
}

function active_sidebar($module_permissions_id){
	if(Auth::user()->id == 1 || in_array($module_permissions_id, json_decode(Auth::user()->permissions))){
		return 1;
	}else{
		return 0;
	}
}

?>