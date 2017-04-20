<?php

// Shop
Route::group(['domain' => 'shop.'.env('APP_DOMAIN'), 'namespace' => 'Shop'], function () {
    Route::get('/', 'HomeController@getIndex');

    // Danh mục sản phẩm
    Route::get('/category/{id}-{slug}', ['as' => 'shop.category.products', 'uses' => 'CategoryController@getProducts']);

    // Chi tiết sản phẩm
    Route::get('product/{id}-{slug}', ['as' => 'shop.product.detail', 'uses' => 'ProductController@getDetail']);

    // Trang tĩnh
    Route::get('page/{id}-{slug}', ['as' => 'shop.page.detail', 'uses' => 'PageController@getDetail']);

    // Tin tức
    Route::get('/tin-tuc', ['as' => 'shop.post.index', 'uses' => 'PostController@getIndex']);

    // Tin tức chi tiết
    Route::get('/tin-tuc/{id}-{slug}', ['as' => 'shop.post.detail', 'uses' => 'PostController@getDetail']);

    // Danh mục tin tức
    Route::get('/danh-muc/tin-tuc/{id}-{slug}', ['as' => 'shop.post_category.posts', 'uses' => 'PostCategoryController@getPosts']);

});