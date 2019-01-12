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

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','ProductController@index');
Route::get('/homeprod/{cat}','ProductController@getNewProdsByCategory');

Auth::routes();
Route::get('/admin','Admin\AdminController@index');
Route::get('/createProduct','Admin\AdminController@createProduct');
Route::get('/home', 'HomeController@index')->name('home');
