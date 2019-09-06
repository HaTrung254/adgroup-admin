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

/** san-pham start **/
Route::match(['get', 'post'], '/san-pham', 'FrontendController@productSearch')->name('vn_product_list');
Route::match(['get', 'post'], '/products', 'FrontendController@productSearch')->name('en_product_list');
Route::get('/san-pham/{cate_url}', 'FrontendController@productCateList')->name('vn_product_cate_list');
Route::get('/products/{cate_url}', 'FrontendController@productCateList')->name('en_product_cate_list');
Route::get('/san-pham/{cate_url}/{product_url}', 'FrontendController@productDetail')->name('vn_product_detail');
Route::get('/products/{cate_url}/{product_url}', 'FrontendController@productDetail')->name('en_product_detail');

Route::get('/san-pham-noi-bat', 'FrontendController@productOutStanding')->name('vn_product_out_standing');
Route::get('/featured-products', 'FrontendController@productOutStanding')->name('en_product_out_standing');

Route::get('/san-pham-san-co', 'FrontendController@productAvailable')->name('vn_product_available');
Route::get('/available-products', 'FrontendController@productAvailable')->name('en_product_available');
/** san-pham end **/

/** tin-tuc start **/
Route::match(['get', 'post'], '/tin-tuc', 'FrontendController@newList')->name('vn_new_list');
Route::match(['get', 'post'], '/news', 'FrontendController@newList')->name('en_new_list');
Route::get('/tin-tuc/{url}', 'FrontendController@newCategoryList')->name('vn_new_category_list');
Route::get('/news/{url}', 'FrontendController@newCategoryList')->name('en_new_category_list');
Route::get('/tin-tuc/{url}', 'FrontendController@newDetail')->name('new_detail');
Route::get('/new/{id}', 'FrontendController@newDetail')->name('new_detail');
/** tin-tuc end **/

Route::get('/lang/{lang}', 'FrontendController@changeLanguage')->name('change_language');

/*static pages*/

Route::get('/about.html', 'PagesController@about')->name('about');
Route::post('/mail-contact', 'PagesController@mailContact')->name('mail_contact');
Route::post('/checkout-post', 'PagesController@checkoutPost')->name('checkout_post');
Route::get('/checkout/{product_id}', 'PagesController@checkout')->name('checkout');

/*end static pages*/