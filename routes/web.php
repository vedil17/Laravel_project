<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// Client controller
Route::get('/', 'ClientController@index');

Route::get('/shop', 'ClientController@shop');


//admin controller
Route::get('/admin', 'ProductController@orders');

Route::get('/add_category', 'AdminController@add_category');

Route::get('/add_product', 'AdminController@add_product');

Route::get('/add_slider', 'AdminController@add_slider');

Route::get('/categories', 'AdminController@categories');

Route::get('/products', 'AdminController@products');

Route::get('/sliders', 'AdminController@sliders');


//Product Controller
Route::post('/save_product', 'ProductController@save_product');

Route::get('/select_product_by_category/{category_name}', 'ProductController@select_product_by_category');

Route::get('/unactivate_product/{id}', 'ProductController@unactivate_product');

Route::get('/activate_product/{id}', 'ProductController@activate_product');

Route::get('/delete_product/{id}', 'ProductController@delete_product');

Route::get('/edit_product/{id}', 'ProductController@edit_product');

Route::post('/update_product', 'ProductController@update_product');

Route::get('/addToCart/{id}', 'ProductController@addToCart');

Route::get('/cart', 'ProductController@cart');

Route::post('/updateQty', 'ProductController@updateQty');

Route::get('/removeItem/{id}', 'ProductController@removeItem');

Route::get('/checkout', 'ProductController@checkout');

Route::post('/postCheckout', 'ProductController@postCheckout');

Route::get('/orders', 'ProductController@orders');

//Category Controller
Route::post('/save_category', 'CategoryController@save_category');

Route::get('/delete_category/{id}', 'CategoryController@delete_category');

Route::get('/edit_category/{id}', 'CategoryController@edit_category');

Route::post('/update_category', 'CategoryController@update_category');

//Slider Controller
Route::post('/save_slider', 'SliderController@save_slider');

Route::get('/unactivate_slider/{id}', 'SliderController@unactivate_slider');

Route::get('/activate_slider/{id}', 'SliderController@activate_slider');

Route::get('/delete_slider/{id}', 'SliderController@delete_slider');

Route::get('/edit_slider/{id}', 'SliderController@edit_slider');

Route::post('/update_slider', 'SliderController@update_slider');

//PDF Controller
Route::get('/view_pdf/{id}', 'PdfController@view_pdf');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
