<?php

// Shop
Route::group(['domain' => 'shop.'.env('APP_DOMAIN'), 'namespace' => 'Shop'], function () {
    Route::get('/', 'HomeController@getIndex');

    // Danh mục sản phẩm
    Route::get('/category/{id}-{slug}', ['as' => 'shop.category.products', 'uses' => 'CategoryController@getProducts']);

    // Chi tiết sản phẩm
    Route::get('product/{id}-{slug}', ['as' => 'shop.product.detail', 'uses' => 'ProductController@getDetail']);
    // Lấy cửa hàng theo thành phố
    Route::get('/ajax/product/html-stock-item', ['as' => 'shop.product.detail.ajax.get_html_stock', 'uses' => 'ProductController@ajaxHtmlStockItem']);

    // Trang tĩnh
    Route::get('page/{id}-{slug}', ['as' => 'shop.page.detail', 'uses' => 'PageController@getDetail']);

    // Tin tức
    Route::get('/tin-tuc', ['as' => 'shop.post.index', 'uses' => 'PostController@getIndex']);

    // Tin tức chi tiết
    Route::get('/tin-tuc/{id}-{slug}', ['as' => 'shop.post.detail', 'uses' => 'PostController@getDetail']);

    // Danh mục tin tức
    Route::get('/danh-muc/tin-tuc/{id}-{slug}', ['as' => 'shop.post_category.posts', 'uses' => 'PostCategoryController@getPosts']);

    // Giỏ hàng
    Route::group(['prefix' => 'cart'], function() {
        Route::get('/', ['as' => 'shop.cart.index', 'uses' => 'CartController@getIndex']);
        Route::get('/add-to-cart', ['as' => 'shop.cart.add', 'uses' => 'CartController@addToCart']);
        Route::get('/delete/{rowId}', ['as' => 'shop.cart.delete', 'uses' => 'CartController@delete']);
        Route::post('/ajax/update-cart', ['as' => 'shop.cart.ajax.update', 'uses' => 'CartController@ajaxUpdate']);
        Route::get('/clear', ['as' => 'shop.cart.clear', 'uses' => 'CartController@clear']);
    });

    // Thanh toán
    Route::get('/gui-don-hang', ['as' => 'shop.submitOrder', 'uses' => 'OrderController@getIndex']);
    Route::post('/gui-don-hang', 'OrderController@postIndex');

    // Gửi đơn hàng thành công, cảm ơn
    Route::get('/thank.html', 'OrderController@getThank');

    // Ajax
    Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function() {
        Route::get('/product/quick-view', 'ProductController@getQuickView');
        Route::get('/product/get-variant', 'ProductController@getVariant');
    });
});