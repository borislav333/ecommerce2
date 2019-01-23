<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','ProductController@index')->name('index');
Route::get('/homeprod/{cat}','ProductController@getNewProdsByCategory')->name('getNewProdsByCategory');

Auth::routes();

/*Admin panel */
Route::post('/createProduct/add','Admin\AdminController@addNewProduct')->name('addNewProduct');
Route::get('/createProduct','Admin\AdminController@createProductView')->name('createProductView');
Route::get('/admin','Admin\AdminController@index')->name('adminIndex');
Route::get('/admin/product/{category}/{product}','ProductController@getCurrentProduct')->name('getCurrentProduct');
Route::get('/admin/product/{category}/{product}/edit','Admin\AdminController@editProductView')->name('editProduct');
Route::post('/{category}/{product}/update','Admin\AdminController@updateProduct')->name('updateProduct');
Route::post('/removeimg/{imgid}','Admin\AdminController@removeCurrentImage')->name('removeCurrentImage');
Route::post('/positionupdate/{imgid}/{position}','Admin\AdminController@updatePosition')->name('updatePosition');
Route::delete('/deleteproduct/{productslug}','Admin\AdminController@deleteProduct')->name('deleteProduct');
//Admin Orders
Route::get('/admin/orders','Admin\AdminOrdersController@index')->name('getOrders');
Route::get('/admin/orders/search','Admin\AdminOrdersController@searchUserOrders')->name('getOrdersByUser');
Route::post('/admin/orders/dispatch','Admin\AdminOrdersController@dispatchOrder')->name('dispatchOrder');
Route::get('/admin/orders/view/{orderId}','Admin\AdminOrdersController@viewOrder')->name('viewOrder');

/* End admin panel */

Route::post('/cartadd/{prodId}','ProductController@addToCart')->name('addToCart');
Route::post('/cartremove/{prodId}','ProductController@removeFromCart')->name('removeFromCart');
Route::get('/viewcart','ProductController@viewCart')->name('viewCart');
//Orders
Route::get('/checkout/view','OrderController@index2')->name('checkoutView');
Route::post('/checkout/view','OrderController@index')->name('orderIndex');
Route::post('/checkout/process','OrderController@validateOrder')->name('orderValidate');
Route::post('/checkout/removeCart','OrderController@removeCartItems')->name('removeCart');

Route::get('/home', 'HomeController@index')->name('home');
