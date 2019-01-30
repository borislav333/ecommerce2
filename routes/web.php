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
Route::get('/product/{category}/{product}','ProductController@getCurrentProduct')->name('getCurrentProduct');
Route::post('/addbrand','Admin\AdminController@addNewBrand')->name('newBrand');
/*Admin panel */
Route::post('/createProduct/add','Admin\AdminController@addNewProduct')->name('addNewProduct');
Route::get('/createProduct','Admin\AdminController@createProductView')->name('createProductView');
Route::get('/admin','Admin\AdminController@index')->name('adminIndex');

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
//Admin categories
Route::get('/admin/categories','Admin\AdminCategoryController@index')->name('categoryIndex');
Route::post('/admin/category/create','Admin\AdminCategoryController@create')->name('createCategory');
Route::patch('/admin/category/edit/{categorySlug}','Admin\AdminCategoryController@edit')->name('editCategory');
Route::delete('/admin/category/remove/{categorySlug}','Admin\AdminCategoryController@destroy')->name('deleteCategory');

/* End admin panel */

Route::post('/cartadd/{prodId}','ProductController@addToCart')->name('addToCart');
Route::post('/cartremove/{prodId}','ProductController@removeFromCart')->name('removeFromCart');
Route::get('/viewcart','ProductController@viewCart')->name('viewCart');
//Orders
Route::get('/checkout/view','OrderController@checkoutView')->name('checkoutView');
Route::post('/checkout/view','OrderController@index')->name('orderIndex');
Route::post('/checkout/process','OrderController@validateOrder')->name('orderValidate');
Route::post('/checkout/removeCart','OrderController@removeCartItems')->name('removeCart');
//Filter products
/*Route::get('/search','FilterProductsController@index')->name('filterIndex');*/
Route::get('/get/products','FilterProductsController@getProducts')->name('getProducts');
Route::post('/search','FilterProductsController@liveSearch')->name('liveSearch');
Route::get('/search','FilterProductsController@liveSearchAll')->name('liveSearchAll');
Route::get('/search/{categorySlug}','FilterProductsController@liveSearchCategory')->name('liveSearchCategory');
Route::get('/search/product/{productSlug}','FilterProductsController@liveSearchProduct')->name('liveSearchProduct');
Route::get('/search/catprod/{categorySlug}/{productSlug}','FilterProductsController@liveSearchCategoryProduct')->name('liveSearchCategoryProduct');

Route::post('/filter','FilterProductsController@filterProducts')->name('filterProducts');


Route::get('/home', 'HomeController@index')->name('home');

