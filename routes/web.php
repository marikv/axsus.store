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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('homeIndex');

Route::get('/adm', 'AdminController@index')->name('admin');
Route::get('/adm/products', 'AdminController@productsPage')->name('adminProductsGet');
Route::get('/adm/brands', 'AdminController@brandsPage')->name('adminBrandsGet');
Route::post('/adm/addOrSaveProduct', 'AdminController@addOrSaveProduct')->name('addOrSaveProduct');
Route::post('/adm/addOrSaveBrand', 'AdminController@addOrSaveBrand')->name('addOrSaveBrand');
Route::delete('/adm/deleteBrand', 'AdminController@deleteBrand')->name('deleteBrand');
Route::delete('/adm/deleteProduct', 'AdminController@deleteProduct')->name('deleteProduct');
