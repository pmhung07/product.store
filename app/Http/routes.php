<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

require_once __DIR__ . '/shop_routes.php';


// Load ajax
Route::post('update-price','OrdersController@loadPrice');
Route::post('post-order',array('uses'=>'OrdersController@postCreate'));
Route::post('update-customer',array('uses'=>'OrdersController@updateCustomer'));
Route::post('update-order',array('uses'=>'OrdersController@updateOrder'));
Route::post('update-call-status',array('uses'=>'OrdersController@updateCallStatus'));
Route::post('update-lading-status',array('uses'=>'OrdersController@updateLadingStatus'));
Route::post('update-payment-status',array('uses'=>'OrdersController@updatePaymentStatus'));
Route::post('update-receiver-order',array('uses'=>'OrdersController@updateReceiverOrder'));
Route::post('update-note-order',array('uses'=>'OrdersController@updateNoteOrder'));
Route::post('load-districts',array('uses'=>'OrdersController@loadDistricts'));
Route::post('post-return-product',array('uses'=>'WarehouseReturnProductPhController@postReturnProduct'));
Route::post('update-profit',array('uses'=>'AffiliateController@updateProfit'));
Route::post('update-properties/{id}', ['as'=>'admin.properties.update','uses'=>'ProductController@updateProperties']);
Route::post('update-affiliate-user-product','AffiliateController@updateAffiliateUserProduct');
// Tìm kiếm khách hàng
Route::get('get-customer-auto-complete', ['as'=>'admin.orders.getCustomer','uses'=>'OrdersController@getCustomerAutoComplete']);

// Tìm kiếm sản phẩm
Route::get('get-product-auto-complete', ['as'=>'admin.orders.getProduct','uses'=>'OrdersController@getProductAutoComplete']);

// Tìm kiếm nhân viên
Route::get('get-user-auto-complete', ['as'=>'admin.staff.getUser','uses'=>'StaffController@getUserAutoComplete']);

// Tìm kiếm thuộc tính
Route::get('get-properties-auto-complete', ['as'=>'admin.product.getPropertiesProduct','uses'=>'ProductController@getPropertiesAutoComplete']);

// Submit đơn hàng thành công
Route::post('details-success/{order_id}', ['as' => 'admin.orders.getDetailsSuccess' , 'uses' => 'OrdersController@postDetailsSuccess']);

// Submit huỷ đơn hàng
Route::post('details-cancel/{order_id}', ['as' => 'admin.orders.getDetailsCancel' , 'uses' => 'OrdersController@postDetailsCancel']);

// Submit chuyển vận đơn
Route::post('details-delivered/{order_id}', ['as' => 'admin.orders.getDetailsDelivered' , 'uses' => 'OrdersController@postDetailsDelivered']);

// Submit đơn hàng ảo
Route::post('details-virtual/{order_id}', ['as' => 'admin.orders.getDetailsVirtual' , 'uses' => 'OrdersController@postDetailsVirtual']);



// Không có quyền truy cập
Route::get('system/denied',['as' => 'admin.denied',function () { return view('admin.denied'); }]);

// Login hệ thống
Route::get('/', 'LoginController@getLogin');
Route::get('auth/login', 'LoginController@getLogin');
Route::get('auth/logout', 'LoginController@getLogout');
Route::post('auth/login', 'LoginController@postLogin');

// Middleware
Route::group(['middleware' => 'auth'], function(){
	Route::group(['prefix' => 'system'], function(){

		// Tổng quan - thống kê
		Route::get('dashboard', ['as' => 'admin.dashboard' , 'uses' => 'DashboardController@getDashboard']);

		// Quản lý Đơn hàng
		Route::group(['prefix' => 'orders'], function(){

			// Danh sách đơn hàng
			Route::get('index', ['as' => 'admin.orders.index' , 'uses' => 'OrdersController@getIndex']);
			Route::get('trash', ['as' => 'admin.orders.trash' , 'uses' => 'OrdersController@getTrash']);
			Route::get('return', ['as' => 'admin.orders.return' , 'uses' => 'OrdersController@getReturn']);
			Route::get('details/{id}', ['as' => 'admin.orders.details' , 'uses' => 'OrdersController@getDetails']);

			// Chi tiết vận đơn
			Route::get('delivery/details/{id}', ['as' => 'admin.orders.delivery' , 'uses' => 'OrdersController@getDeliveryDetails']);
			Route::post('delivery/details/{id}', ['as' => 'admin.orders.createInfoDelivery' , 'uses' => 'OrdersController@postCreateInfoDelivery']);

			// Tạo đơn hàng
			Route::get('create', ['as' => 'admin.orders.getCreate' , 'uses' => 'OrdersController@getCreate']);
			Route::post('create', ['as' => 'admin.orders.getCreate' , 'uses' => 'OrdersController@postCreate']);

		});

		// Quản lý Nhóm sản phẩm
		Route::group(['prefix' => 'product-group'], function(){

			// Danh sách nhóm sản phẩm
			Route::get('index', ['as' => 'admin.product-group.index' , 'uses' => 'ProductGroupController@getIndex']);

			// Tạo nhóm sản phẩm
			Route::get('create', ['as' => 'admin.product-group.getCreate' , 'uses' => 'ProductGroupController@getCreate']);
			Route::post('create', ['as' => 'admin.product-group.getCreate' , 'uses' => 'ProductGroupController@postCreate']);

			// Sửa nhóm sản phẩm
			Route::get('update/{id}', ['as' => 'admin.product-group.getUpdate' , 'uses' => 'ProductGroupController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.product-group.getUpdate' , 'uses' => 'ProductGroupController@postUpdate']);

			// Xoá nhóm sản phẩm
			Route::get('delete/{id}', ['as' => 'admin.product-group.getDelete' , 'uses' => 'ProductGroupController@getDelete']);
		});

		// Quản lý Sản phẩm
		Route::group(['prefix' => 'product'], function() {

			// Danh sách sản phẩm
			Route::get('index', ['as' => 'admin.product.index' , 'uses' => 'ProductController@getIndex']);

			// Tạo sản phẩm
			Route::get('create', ['as' => 'admin.product.getCreate' , 'uses' => 'ProductController@getCreate']);
			Route::post('create', ['as' => 'admin.product.getCreate' , 'uses' => 'ProductController@postCreate']);

			// Sửa sản phẩm
			Route::get('update/{id}', ['as' => 'admin.product.getUpdate' , 'uses' => 'ProductController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.product.getUpdate' , 'uses' => 'ProductController@postUpdate']);

			// Xoá sản phẩm
			Route::get('delete/{id}', ['as' => 'admin.product.getDelete' , 'uses' => 'ProductController@getDelete']);

			// Variant
			Route::get('variant/{id}/delete', ['as' => 'admin.product.deleteVariant', 'uses' => 'ProductController@getDeleteVariant']);

			// Option
			Route::post('option/update', ['as' => 'admin.product.variant.create', 'uses' => 'ProductController@postUpdateOption']);
			Route::get('option/{id}/delete', ['as' => 'admin.product.deleteOption', 'uses' => 'ProductController@getDeleteOption']);

			// Xóa option value
			Route::post('ajax/delete-option-value', ['as' => 'admin.product.ajax.deleteOptionValue', 'uses' => 'ProductController@getDeleteOptionValue']);

			// Delete image item
			Route::post('ajax/delete-image-item', ['as' => 'admin.product.ajax.deleteImageItem', 'uses' => 'ProductController@ajaxDeleteImageItem']);
		});

		// Quản lý kho hàng
		Route::group(['prefix' => 'stock'], function(){

			// Danh sách kho hàng
			Route::get('index', ['as' => 'admin.stock.index' , 'uses' => 'WarehouseController@getIndex']);

			// Tạo kho hàng
			Route::get('create', ['as' => 'admin.stock.getCreate' , 'uses' => 'WarehouseController@getCreate']);
			Route::post('create', ['as' => 'admin.stock.getCreate' , 'uses' => 'WarehouseController@postCreate']);

			// Sửa kho hàng
			Route::get('update/{id}', ['as' => 'admin.stock.getUpdate' , 'uses' => 'WarehouseController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.stock.getUpdate' , 'uses' => 'WarehouseController@postUpdate']);

			// Xoá kho hàng
			Route::get('delete/{id}', ['as' => 'admin.stock.getDelete' , 'uses' => 'WarehouseController@getDelete']);
		});

		// Quản lý hàng tồn kho
		Route::group(['prefix' => 'inventory'], function(){

			// Danh sách sản phẩm tồn kho
			Route::get('index', ['as' => 'admin.inventory.index' , 'uses' => 'WarehouseInventoryController@getIndex']);
		});

		// Quản lý nhập kho
		Route::group(['prefix' => 'stock-receipt'], function(){

			// Chi tiết sản phẩm đã nhập vào kho
			Route::get('index', ['as' => 'admin.stock-receipt.index' , 'uses' => 'WarehousePhController@getIndex']);
			Route::get('details/{id}', ['as' => 'admin.stock-receipt.details' , 'uses' => 'WarehousePhController@getDetails']);

			// Tạo Phiếu nhập kho
			Route::get('create', ['as' => 'admin.stock-receipt.getCreate' , 'uses' => 'WarehousePhController@getCreate']);
			Route::post('create', ['as' => 'admin.stock-receipt.getCreate' , 'uses' => 'WarehousePhController@postCreate']);

			// Nhập sản phẩm vào phiếu
			Route::get('update/{id}', ['as' => 'admin.stock-receipt.getUpdate' , 'uses' => 'WarehousePhController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.stock-receipt.getUpdate' , 'uses' => 'WarehousePhController@postUpdate']);

			// Sửa xoá phiếu khi chưa nhập kho
			Route::get('edit/{id}', ['as' => 'admin.stock-receipt.getEdit' , 'uses' => 'WarehousePhController@getEdit']);
			Route::post('edit/{id}', ['as' => 'admin.stock-receipt.getEdit' , 'uses' => 'WarehousePhController@postEdit']);

			// Xoá sản phẩm
			Route::get('delete/{id}', ['as' => 'admin.stock-receipt.getDelete' , 'uses' => 'WarehousePhController@getDelete']);

			// Nhập sản phẩm vào kho
			Route::post('details/{id}', ['as' => 'admin.stock-receipt.getWarehousing' , 'uses' => 'WarehousePhController@postWarehousing']);
		});

		// Quản lý chuyển kho
		Route::group(['prefix' => 'transfer-product'], function(){

			// Chi tiết sản phẩm đã nhập vào kho
			Route::get('index', ['as' => 'admin.transfer-product.index' , 'uses' => 'WarehouseTransferPhController@getIndex']);
			Route::get('details/{id}', ['as' => 'admin.transfer-product.details' , 'uses' => 'WarehouseTransferPhController@getDetails']);

			// Tạo Phiếu chuyển kho
			Route::get('create', ['as' => 'admin.transfer-product.getCreate' , 'uses' => 'WarehouseTransferPhController@getCreate']);
			Route::post('create', ['as' => 'admin.transfer-product.getCreate' , 'uses' => 'WarehouseTransferPhController@postCreate']);

			// Nhập sản phẩm vào phiếu
			Route::get('update/{id}', ['as' => 'admin.transfer-product.getUpdate' , 'uses' => 'WarehouseTransferPhController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.transfer-product.getUpdate' , 'uses' => 'WarehouseTransferPhController@postUpdate']);

			// Sửa xoá phiếu khi chưa nhập kho
			Route::get('edit/{id}', ['as' => 'admin.transfer-product.getEdit' , 'uses' => 'WarehouseTransferPhController@getEdit']);
			Route::post('edit/{id}', ['as' => 'admin.transfer-product.getEdit' , 'uses' => 'WarehouseTransferPhController@postEdit']);

			// Xoá sản phẩm
			Route::get('delete/{id}', ['as' => 'admin.transfer-product.getDelete' , 'uses' => 'WarehouseTransferPhController@getDelete']);

			// Nhập sản phẩm vào kho
			Route::post('details/{id}', ['as' => 'admin.transfer-product.getWarehousing' , 'uses' => 'WarehouseTransferPhController@postWarehousing']);
		});

		// Trả hàng
		Route::group(['prefix' => 'return-product'], function(){
			Route::get('index', ['as' => 'admin.return-product.index' , 'uses' => 'WarehouseReturnProductPhController@getIndex']);
			Route::get('details/{id}', ['as' => 'admin.return-product.details' , 'uses' => 'WarehouseReturnProductPhController@getDetails']);
			Route::get('processing', ['as' => 'admin.return-product.processing' , 'uses' => 'WarehouseReturnProductPhController@getProcessing']);
		});

		// Quản lý thống kê doanh số
		Route::group(['prefix' => 'statistic'], function(){
			Route::get('sales/dashboard', ['as' => 'admin.sale-statistic.getDashboard' , 'uses' => 'StatisticController@getStatistic']);
			Route::post('sales/dashboard', ['as' => 'admin.sale-statistic.getDashboard' , 'uses' => 'StatisticController@getStatisticDashboard']);
			Route::get('product', ['as' => 'admin.statistic.getProduct' , 'uses' => 'StatisticController@getProduct']);
			Route::get('product-group', ['as' => 'admin.statistic.getProductGroup' , 'uses' => 'StatisticController@getProductGroup']);
			Route::get('channel', ['as' => 'admin.statistic.getChannel' , 'uses' => 'StatisticController@getChannel']);
			Route::get('regions', ['as' => 'admin.statistic.getRegions'	 , 'uses' => 'StatisticController@getRegions']);
			Route::get('staff', ['as' => 'admin.statistic.getStaff' , 'uses' => 'StatisticController@getStaff']);
		});

		// Quản lý nhân viên
		Route::group(['prefix' => 'staff'], function(){
			Route::get('index', ['as' => 'admin.staff.index' , 'uses' => 'StaffController@getIndex']);
			Route::get('permissions/{id}', ['as' => 'admin.staff.permissions' , 'uses' => 'StaffController@getPermissions']);
			Route::post('permissions/{id}', ['as' => 'admin.staff.permissions' , 'uses' => 'StaffController@postPermissions']);
			Route::get('create', ['as' => 'admin.staff.getCreate' , 'uses' => 'StaffController@getCreate']);
			Route::post('create', ['as' => 'admin.staff.getCreate' , 'uses' => 'StaffController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.staff.getUpdate' , 'uses' => 'StaffController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.staff.getUpdate' , 'uses' => 'StaffController@postUpdate']);
			Route::get('orders/{id}', ['as' => 'admin.staff.getOrders' , 'uses' => 'StaffController@getOrders']);
		});

		// Quản lý khách hàng
		Route::group(['prefix' => 'customer'], function(){
			Route::get('index', ['as' => 'admin.customer.index' , 'uses' => 'CustomersController@getIndex']);
			Route::get('details/{id}', ['as' => 'admin.customer.getDetails' , 'uses' => 'CustomersController@getDetails']);
			Route::get('create', ['as' => 'admin.customer.getCreate' , 'uses' => 'CustomersController@getCreate']);
			Route::post('create', ['as' => 'admin.customer.getCreate' , 'uses' => 'CustomersController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.customer.getUpdate' , 'uses' => 'CustomersController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.customer.getUpdate' , 'uses' => 'CustomersController@postUpdate']);
			Route::get('delete/{id}', ['as' => 'admin.customer.delete' , 'uses' => 'CustomersController@getDelete']);
		});

		// Các kênh bán hàng
		Route::group(['prefix' => 'channel'], function(){
			Route::get('index', ['as' => 'admin.channel.index' , 'uses' => 'ChannelController@getIndex']);
			Route::get('create', ['as' => 'admin.channel.getCreate' , 'uses' => 'ChannelController@getCreate']);
			Route::post('create', ['as' => 'admin.channel.getCreate' , 'uses' => 'ChannelController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.channel.getUpdate' , 'uses' => 'ChannelController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.channel.getUpdate' , 'uses' => 'ChannelController@postUpdate']);
			Route::get('delete/{id}', ['as' => 'admin.channel.getDelete' , 'uses' => 'ChannelController@getDelete']);
		});

		// Các phương thức thanh toán
		Route::group(['prefix' => 'payment-method'], function(){
			Route::get('index', ['as' => 'admin.payment-method.index' , 'uses' => 'PaymentMethodsController@getIndex']);
			Route::get('create', ['as' => 'admin.payment-method.getCreate' , 'uses' => 'PaymentMethodsController@getCreate']);
			Route::post('create', ['as' => 'admin.payment-method.getCreate' , 'uses' => 'PaymentMethodsController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.payment-method.getUpdate' , 'uses' => 'PaymentMethodsController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.payment-method.getUpdate' , 'uses' => 'PaymentMethodsController@postUpdate']);
			Route::get('delete/{id}', ['as' => 'admin.payment-method.getDelete' , 'uses' => 'PaymentMethodsController@getDelete']);
		});

		// Các đơn vị
		Route::group(['prefix' => 'units'], function(){
			Route::get('index', ['as' => 'admin.units.index' , 'uses' => 'UnitsController@getIndex']);
			Route::get('create', ['as' => 'admin.units.getCreate' , 'uses' => 'UnitsController@getCreate']);
			Route::post('create', ['as' => 'admin.units.getCreate' , 'uses' => 'UnitsController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.units.getUpdate' , 'uses' => 'UnitsController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.units.getUpdate' , 'uses' => 'UnitsController@postUpdate']);
			Route::get('delete/{id}', ['as' => 'admin.units.getDelete' , 'uses' => 'UnitsController@getDelete']);
		});

		// Nhà cung cấp
		Route::group(['prefix' => 'supplier'], function(){
			Route::get('index', ['as' => 'admin.supplier.index' , 'uses' => 'SupplierController@getIndex']);
			Route::get('create', ['as' => 'admin.supplier.getCreate' , 'uses' => 'SupplierController@getCreate']);
			Route::post('create', ['as' => 'admin.supplier.getCreate' , 'uses' => 'SupplierController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.supplier.getUpdate' , 'uses' => 'SupplierController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.supplier.getUpdate' , 'uses' => 'SupplierController@postUpdate']);
			Route::get('delete/{id}', ['as' => 'admin.supplier.getDelete' , 'uses' => 'SupplierController@getDelete']);
		});

		// Quản lý Phân quyền
		Route::group(['prefix' => 'permissions'], function(){
			Route::get('index', ['as' => 'admin.permissions.index' , 'uses' => 'PermissionsController@getIndex']);
			Route::get('create', ['as' => 'admin.permissions.getCreate' , 'uses' => 'PermissionsController@getCreate']);
			Route::post('create', ['as' => 'admin.permissions.postCreate' , 'uses' => 'PermissionsController@postCreate']);
			Route::get('delete/{id}', ['as' => 'admin.permissions.getDelete' , 'uses' => 'PermissionsController@getDelete']);
			Route::get('update/{id}', ['as' => 'admin.permissions.getUpdate' , 'uses' => 'PermissionsController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.permissions.postUpdate' , 'uses' => 'PermissionsController@postUpdate']);
		});

		// Quản lý chức vụ nhân viên
		Route::group(['prefix' => 'position'], function(){
			Route::get('index', ['as' => 'admin.position.index' , 'uses' => 'UsersPositionController@getIndex']);
			Route::get('permissions/{id}', ['as' => 'admin.position.permissions' , 'uses' => 'UsersPositionController@getPermissions']);
			Route::post('permissions/{id}', ['as' => 'admin.position.permissions' , 'uses' => 'UsersPositionController@postPermissions']);
			Route::get('create', ['as' => 'admin.position.getCreate' , 'uses' => 'UsersPositionController@getCreate']);
			Route::post('create', ['as' => 'admin.position.getCreate' , 'uses' => 'UsersPositionController@postCreate']);
			Route::get('update/{id}', ['as' => 'admin.position.getUpdate' , 'uses' => 'UsersPositionController@getUpdate']);
			Route::post('update/{id}', ['as' => 'admin.position.getUpdate' , 'uses' => 'UsersPositionController@postUpdate']);
		});

		// Tạo Landing-Page bán hàng
		Route::group(['prefix' => 'landing-page'], function(){
			Route::get('index', ['as' => 'admin.landing-page.index' , 'uses' => 'SiteController@getIndex']);
			Route::get('create_info', ['as' => 'admin.landing-page.create_info' , 'uses' => 'SiteController@getInfoSiteCreate']);
			Route::post('create_info', ['as' => 'admin.landing-page.create_info' , 'uses' => 'SiteController@postInfoSiteCreate']);
			Route::get('create', ['as' => 'admin.landing-page.create' , 'uses' => 'SiteController@getSiteCreate']);
			Route::get('order', ['as' => 'admin.landing-page.order' , 'uses' => 'SiteController@getOrder']);
			Route::post('updatePageData', ['as' => 'updatePageData', 'uses' => 'SiteController@postUpdatePageData']);
			Route::get('site/{site_id}', [ 'as' => 'admin.landing-page.site', 'uses' => 'SiteController@getSite']);
		});

		// Email marketing
		Route::group(['prefix' => 'email-marketing'], function(){
			Route::get('index', ['as' => 'system.emailMarketing.index' , 'uses' => 'System\EmailMarketingController@getIndex']);
		});

		// Shop
		Route::group(['prefix' => 'online-store'], function(){
			Route::group(['prefix' => 'post-categories'], function(){
				Route::get('index', ['as' => 'admin.post-categories.index' , 'uses' => 'ShopPostCategoriesController@getIndex']);
				Route::get('create', ['as' => 'admin.post-categories.create' , 'uses' => 'ShopPostCategoriesController@getCreate']);
				Route::post('create', ['as' => 'admin.post-categories.create' , 'uses' => 'ShopPostCategoriesController@postCreate']);
				Route::get('update/{id}', ['as' => 'admin.post-categories.getUpdate' , 'uses' => 'ShopPostCategoriesController@getUpdate']);
				Route::post('update/{id}', ['as' => 'admin.post-categories.getUpdate' , 'uses' => 'ShopPostCategoriesController@postUpdate']);
				Route::get('delete/{id}', ['as' => 'admin.post-categories.getDelete' , 'uses' => 'ShopPostCategoriesController@getDelete']);
			});

			Route::group(['prefix' => 'post'], function(){
				Route::get('index', ['as' => 'admin.post.index' , 'uses' => 'ShopPostController@getIndex']);
				Route::get('create', ['as' => 'admin.post.getCreate' , 'uses' => 'ShopPostController@getCreate']);
				Route::post('create', ['as' => 'admin.post.getCreate' , 'uses' => 'ShopPostController@postCreate']);
				Route::get('update/{id}', ['as' => 'admin.post.getUpdate' , 'uses' => 'ShopPostController@getUpdate']);
				Route::post('update/{id}', ['as' => 'admin.post.getUpdate' , 'uses' => 'ShopPostController@postUpdate']);
				Route::get('delete/{id}', ['as' => 'admin.post.getDelete' , 'uses' => 'ShopPostController@getDelete']);
			});

			// Trang tĩnh
			Route::group(['prefix' => 'page'], function(){
				Route::get('index', ['as' => 'admin.page.index' , 'uses' => 'ShopPageController@getIndex']);
				Route::get('create', ['as' => 'admin.page.getCreate' , 'uses' => 'ShopPageController@getCreate']);
				Route::post('create', ['as' => 'admin.page.getCreate' , 'uses' => 'ShopPageController@postCreate']);
				Route::get('update/{id}', ['as' => 'admin.page.getUpdate' , 'uses' => 'ShopPageController@getUpdate']);
				Route::post('update/{id}', ['as' => 'admin.page.getUpdate' , 'uses' => 'ShopPageController@postUpdate']);
				Route::get('delete/{id}', ['as' => 'admin.page.getDelete' , 'uses' => 'ShopPageController@getDelete']);
			});

			// Coupon
			Route::group(['prefix' => 'coupon'], function(){
				Route::get('index', ['as' => 'system.coupon.index' , 'uses' => 'System\CouponController@getIndex']);
				Route::get('create', ['as' => 'system.coupon.create' , 'uses' => 'System\CouponController@getCreate']);
				Route::post('create', ['as' => 'system.coupon.store' , 'uses' => 'System\CouponController@postCreate']);
				Route::get('update/{id}', ['as' => 'system.coupon.edit' , 'uses' => 'System\CouponController@getUpdate']);
				Route::post('update/{id}', ['as' => 'system.coupon.update' , 'uses' => 'System\CouponController@postUpdate']);
				Route::get('delete/{id}', ['as' => 'system.coupon.delete' , 'uses' => 'System\CouponController@getDelete']);

				// Ajax search product
				Route::get('/ajax/products', 'System\CouponController@ajaxSearchProduct');

				// Ajax search product group
				Route::get('/ajax/product-group', 'System\CouponController@ajaxSearchProductGroup');
			});

			// Ga
			Route::group(['prefix' => 'ga'], function() {
				Route::get('index', ['as' => 'system.ga.index', 'uses' => 'System\GaController@getIndex']);
			});

			// Setting
			Route::group(['prefix' => 'setting'], function() {
				Route::get('index', ['as' => 'system.setting_website.index', 'uses' => 'System\SettingWebsiteController@getIndex']);
				Route::post('index', ['as' => 'system.setting_website.index', 'uses' => 'System\SettingWebsiteController@postIndex']);
			});

			// Banner
			Route::group(['prefix' => 'banner'], function() {
			    Route::get('/', [
					'as'   => 'system.banner.index',
					'uses' => 'System\BannerController@index',
			    ]);

			    Route::get('/create',  [
					'as'   => 'system.banner.create',
					'uses' => 'System\BannerController@create',
			    ]);

			    Route::post('/create', [
					'as'   => 'system.banner.store',
					'uses' =>'System\BannerController@store',
			    ]);

			    Route::get('{id}/edit',  [
					'as'   => 'system.banner.edit',
					'uses' => 'System\BannerController@edit',
			    ]);

			    Route::post('{id}/edit', [
					'as'   => 'system.banner.update',
					'uses' =>'System\BannerController@update',
			    ]);

			    Route::get('{id}/active', [
					'as'   => 'system.banner.active',
					'uses' => 'System\BannerController@active',
			    ]);

			    Route::get('{id}/delete', [
					'as'   => 'system.banner.destroy',
					'uses' => 'System\BannerController@destroy',
			    ]);


			    // Ajax editable
			    Route::post('/ajax/editable', ['as' => 'system.banner.ajax.editable', 'uses' => 'System\BannerController@ajaxEditAble']);
			});


			// Navigation
			Route::group(['prefix' => 'navigation'], function() {
				Route::get('index', ['as' => 'system.navigation.index', 'uses' => 'System\NavigationController@getIndex']);
				Route::get('create', ['as' => 'system.navigation.create', 'uses' => 'System\NavigationController@getCreate']);
				Route::post('create', ['as' => 'system.navigation.create', 'uses' => 'System\NavigationController@postCreate']);
				Route::get('{id}/edit', ['as' => 'system.navigation.edit', 'uses' => 'System\NavigationController@getEdit']);
				Route::post('{id}/edit', ['as' => 'system.navigation.edit', 'uses' => 'System\NavigationController@postEdit']);
				Route::get('{id}/delete', ['as' => 'system.navigation.delete', 'uses' => 'System\NavigationController@getDelete']);
				Route::get('/{id}/active', ['as' => 'system.navigation.active', 'uses' => 'System\NavigationController@getActive']);
				// Thiết kế menu
			    Route::get('/design', ['as' => 'system.navigation.design', 'uses' => 'System\NavigationController@getDesign']);
			    Route::post('/design', 'System\NavigationController@postDesign');

			    // Ajax editable
			    Route::post('/ajax/editable', ['as' => 'system.navigation.ajax.editable', 'uses' => 'System\NavigationController@ajaxEditable']);

			    // Ajax search post
			    Route::get('/ajax/search-post', ['as' => 'system.navigation.ajax.searchPost', 'uses' => 'System\NavigationController@ajaxSearchPost']);

			    // Ajax search post-category
			    Route::get('/ajax/search-post-category', ['as' => 'system.navigation.ajax.searchPostCategory', 'uses' => 'System\NavigationController@ajaxSearchPostCategory']);

			    // Ajax search page
			    Route::get('/ajax/search-page', ['as' => 'system.navigation.ajax.searchPage', 'uses' => 'System\NavigationController@ajaxSearchPage']);

			    // Ajax search product
			    Route::get('/ajax/search-product', ['as' => 'system.navigation.ajax.searchProduct', 'uses' => 'System\NavigationController@ajaxSearchProduct']);

			    // Ajax search product group
			    Route::get('/ajax/search-product-group', ['as' => 'system.navigation.ajax.searchProductGroup', 'uses' => 'System\NavigationController@ajaxSearchProductGroup']);
			});
		});

		// Affiliate
		Route::group(['prefix' => 'affiliate'], function(){
			// Dành cho Admin & Quản lý
			Route::group(['prefix' => 'manager'], function(){
				Route::get('dashboard', ['as' => 'admin.affiliate.manager-dashboard' , function () { return view('admin.affiliate.manager-dashboard'); }]);
				Route::get('product', ['as' => 'admin.affiliate.manager-product' , 'uses' => 'AffiliateController@getManagerProduct']);
				Route::post('product', ['as' => 'admin.affiliate.manager-product' , 'uses' => 'AffiliateController@addManagerProduct']);
				Route::get('collaborators-group', ['as' => 'admin.affiliate.collaborators-group' , 'uses' => 'AffiliateController@getCollaboratorsGroup']);
				Route::post('collaborators-group', ['as' => 'admin.affiliate.collaborators-group' , 'uses' => 'AffiliateController@addCollaboratorsGroup']);
				Route::get('users-collaborators-group/{group_id}', ['as' => 'admin.affiliate.users-collaborators-group' , 'uses' => 'AffiliateController@getUsersCollaboratorsGroup']);
				Route::post('users-collaborators-group/{group_id}', ['as' => 'admin.affiliate.users-collaborators-group' , 'uses' => 'AffiliateController@addUsersCollaboratorsGroup']);
				Route::get('users', ['as' => 'admin.affiliate.users' , 'uses' => 'AffiliateController@getUsers']);
				Route::get('users-product/{user_id}', ['as' => 'admin.affiliate.users-product' , 'uses' => 'AffiliateController@getUsersProduct']);
			});

			// Dành cho cộng tác viên
			Route::group(['prefix' => 'collaborators'], function(){
				Route::get('product-listing', ['as' => 'admin.affiliate.manage-product.index' , 'uses' => 'AffiliateController@getManagerProduct']);
				Route::get('product-manage', ['as' => 'admin.affiliate.manage-myproduct' , 'uses' => 'AffiliateController@getMyProduct']);
				Route::get('product-statistics', ['as' => 'admin.affiliate.manage-statistics' , 'uses' => 'AffiliateController@getMyProductStatistics']);
			});
		});


		// Store
		Route::group(['prefix' => 'store', 'namespace' => 'System'], function() {
			Route::get('/index', ['as' => 'system.store.index', 'uses' => 'StoreController@getIndex']);
			Route::get('/create', ['as' => 'system.store.create', 'uses' => 'StoreController@getCreate']);
			Route::post('/create', ['as' => 'system.store.create', 'uses' => 'StoreController@postCreate']);
			Route::get('/{id}/edit', ['as' => 'system.store.update', 'uses' => 'StoreController@getUpdate']);
			Route::post('/{id}/edit', ['as' => 'system.store.update', 'uses' => 'StoreController@postUpdate']);
			Route::get('/{id}/delete', ['as' => 'system.store.delete', 'uses' => 'StoreController@getDelete']);
		});

		// Ajax system
		Route::group(['prefix' => 'ajax'], function() {
			// Ajax search product group
			Route::get('/product-group', 'ProductGroupController@ajaxSearchProductGroup');

			// Ajax send sms
			Route::post('/send-sms', ['as' => 'system.ajax.send_sms', 'uses' => 'System\SendSmsController@sendSmsToCustomers']);

			// Ajax send sms
			Route::post('/send-mail', ['as' => 'system.ajax.send_mail', 'uses' => 'System\SendMailController@sendMailToCustomers']);
		});
	});
});

// Get data json landingpage
Route::get('siteData', ['as' => 'siteData', 'uses' => 'SiteController@getSiteData']);

// Revision section route
Route::get('site/getRevisions/{site_id}/{page}', ['uses' => 'SiteController@getRevisions','as' => 'getRevisions']);
Route::get('site/rpreview/{site_id}/{datetime}/{page}', ['uses' => 'SiteController@getRevisionPreview','as' => 'revision.preview']);
Route::get('deleterevision/{site_id}/{datetime}/{page}', ['uses' => 'SiteController@getRevisionDelete','as' => 'revision.delete']);
Route::get('restorerevision/{site_id}/{datetime}/{page}', ['uses' => 'SiteController@getRevisionRestore','as' => 'revision.restore']);

// Save
Route::post('site/save', ['as' => 'site-save', 'uses' => 'SiteController@postSave']);
Route::get('site/getframe/{frame_id}', ['as' => 'getframe', 'uses' => 'SiteController@getFrame']);
Route::get('siteAjax/{site_id}', ['as' => 'siteAjax', 'uses' => 'SiteController@getSiteAjax']);
Route::post('site/live/preview', ['uses' => 'SiteController@postLivePreview','as' => 'live.preview']);

// Image Library section route
Route::get('assets', ['uses' => 'AssetController@getAsset','as' => 'assets']);
Route::post('upload-image', ['uses' => 'AssetController@uploadImage','as' => 'upload.image']);
Route::post('image-upload-ajax', ['uses' => 'AssetController@imageUploadAjax','as' => 'image.upload.ajax']);
Route::post('delImage', ['uses' => 'AssetController@delImage','as' => 'delImage']);
Route::post('siteAjaxUpdate', ['uses' => 'SiteController@postAjaxUpdate','as' => 'siteAjaxUpdate']);
Route::post('updatePageData', ['uses' => 'SiteController@postUpdatePageData','as' => 'updatePageData']);

// Publish
Route::post('site/publish/{type?}', ['uses' => 'SiteController@postPublish','as' => 'site.publish']);

// FTP section route
Route::post('site/connect', ['uses' => 'SiteController@postFTPConnect','as' => 'ftp.connect']);
Route::post('site/ftptest', ['uses' => 'SiteController@postFTPTest','as' => 'ftp.test']);
Route::get('test', ['uses' => 'SiteController@getTest','as' => 'site.test']);

// Settings section route
Route::get('settings', ['uses' => 'SettingController@getSetting','as' => 'settings']);
Route::post('edit-settings', ['uses' => 'SettingController@postSetting','as' => 'edit-settings']);

// Get LandingPage
Route::get('lp{site_id}/{slug}', ['uses' => 'SiteController@getLandingPage','as' => 'viewLandingPage']);
Route::post('lp{site_id}/{slug}', ['uses' => 'SiteController@createOrderLandingPage','as' => 'viewLandingPage']);


// Ajax
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function() {

	// Upload image
	Route::post('/upload-image', 'UploadImageController@postUpload');

    Route::group(['prefix' => 'province'], function() {
        Route::get('/', ['as' => 'ajax.province.index', 'uses' => 'ProvinceController@getIndex']);
        Route::get('/{id}/districts', ['as' => 'ajax.province.district', 'uses' => 'ProvinceController@getDistricts']);
    });

    Route::group(['prefix' => 'district'], function() {
        Route::get('/{id}/wards', ['as' => 'ajax.district.ward', 'uses' => 'DistrictController@getWards']);
    });
});

// Ga
Route::get('/ga/analyze', ['as' => 'ga.analyze', 'uses' => 'GaController@analyze']);

Route::get('/test', 'TestController@index');
