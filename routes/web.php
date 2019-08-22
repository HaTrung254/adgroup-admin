<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
Route::get('/', 'HomeController@sliders')->name('sliders');
Route::match(['get', 'post'], '/slider-edit/{id}', 'HomeController@sliderEdit')->name('slider_edit');
Route::get('/categories', 'HomeController@categories')->name('categories');
Route::get('/products', 'HomeController@products')->name('products');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
