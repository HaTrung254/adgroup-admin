<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'HomeController@sliders')->name('sliders');
    Route::match(['get', 'post'], '/slider-edit/{id}', 'HomeController@sliderEdit')->name('slider_edit');

    Route::get('/categories', 'HomeController@categories')->name('categories');
    Route::match(['get', 'post'], '/category-edit/{id}', 'HomeController@categoryEdit')->name('category_edit');
    Route::match(['get', 'post'], '/category-create', 'HomeController@categoryCreate')->name('category_create');
    Route::get('/category-delete/{id}', 'HomeController@categoryDelete')->name('category_delete');

    Route::get('/products', 'HomeController@products')->name('products');
    Route::match(['get', 'post'], '/product-edit/{id}', 'HomeController@productEdit')->name('product_edit');
    Route::match(['get', 'post'], '/product-create', 'HomeController@productCreate')->name('product_create');
    Route::get('/product-delete/{id}', 'HomeController@productDelete')->name('product_delete');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
