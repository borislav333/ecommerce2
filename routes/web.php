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

/*Admin */
Route::post('/createProduct/add','Admin\AdminController@addNewProduct')->name('addNewProduct');
Route::get('/createProduct','Admin\AdminController@createProductView')->name('createProductView');
Route::get('/admin','Admin\AdminController@index')->name('adminIndex');
Route::get('/{category}/{product}','ProductController@getCurrentProduct')->name('getCurrentProduct');
/*Route::patch('/admin/products/{category}/{productid}','')*/


Route::get('/home', 'HomeController@index')->name('home');
