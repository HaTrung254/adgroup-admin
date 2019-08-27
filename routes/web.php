<?php

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', 'HomeController@sliders')->name('sliders');
    Route::match(['get', 'post'], '/slider-edit/{id}', 'HomeController@sliderEdit')->name('slider_edit');
   
    /** categories - start */
    Route::get('/categories', 'HomeController@categories')->name('categories');
    Route::match(['get', 'post'], '/category-edit/{id}', 'HomeController@categoryEdit')->name('category_edit');
    Route::match(['get', 'post'], '/category-create', 'HomeController@categoryCreate')->name('category_create');
    Route::get('/category-delete/{id}', 'HomeController@categoryDelete')->name('category_delete');
    /** categories - end **/

    /** products - start **/
    Route::get('/products', 'HomeController@products')->name('products');
    Route::match(['get', 'post'], '/product-edit/{id}', 'HomeController@productEdit')->name('product_edit');
    Route::match(['get', 'post'], '/product-create', 'HomeController@productCreate')->name('product_create');
    Route::get('/product-delete/{id}', 'HomeController@productDelete')->name('product_delete');
    /** products - end **/

    /** new_categories - start */
    Route::get('/new-categories', 'HomeController@newCategories')->name('new_categories');
    Route::match(['get', 'post'], '/new-category-edit/{id}', 'HomeController@newCategoryEdit')->name('new_category_edit');
    Route::match(['get', 'post'], '/new-category-create', 'HomeController@newCategoryCreate')->name('new_category_create');
    Route::get('/new-category-delete/{id}', 'HomeController@newCategoryDelete')->name('new_category_delete');
    /** new_categories - end **/

    /** news - start **/
    Route::get('/news', 'HomeController@news')->name('news');
    Route::match(['get', 'post'], '/new-edit/{id}', 'HomeController@newEdit')->name('new_edit');
    Route::match(['get', 'post'], '/new-create', 'HomeController@newCreate')->name('new_create');
    Route::get('/new-delete/{id}', 'HomeController@newDelete')->name('new_delete');
    /** news - end **/

    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});

Route::get('/', 'FrontendController@index')->name('homepage');
Route::get('/lang/{lang}', 'FrontendController@changeLanguage')->name('change_language');
