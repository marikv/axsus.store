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
Route::get('/articles', 'HomeController@articlesPage')->name('articlesPage');
Route::get('/page/{id}', 'HomeController@pagePage')->where('id', '[0-9]+')->name('pagePage');
Route::post('/send/addContactFromForm', 'HomeController@addContactFromForm')->name('addContactFromForm');

Route::get('/adm', 'AdminController@index')->name('admin');
Route::get('/adm/products', 'AdminController@productsPage')->name('adminProductsGet');
Route::get('/adm/brands', 'AdminController@brandsPage')->name('adminBrandsGet');
Route::get('/adm/pages', 'AdminController@pagesPage')->name('adminPagesGet');
Route::get('/adm/articles', 'AdminController@articlesPage')->name('adminArticlesGet');
Route::get('/adm/faqs', 'AdminController@faqsPage')->name('adminFaqsGet');
Route::get('/adm/contacts', 'AdminController@contactsPage')->name('adminContactsGet');
Route::get('/adm/carousels', 'AdminController@carouselsPage')->name('adminCarouselsGet');
Route::post('/adm/addOrSaveProduct', 'AdminController@addOrSaveProduct')->name('addOrSaveProduct');
Route::post('/adm/addOrSaveBrand', 'AdminController@addOrSaveBrand')->name('addOrSaveBrand');
Route::post('/adm/addOrSavePage', 'AdminController@addOrSavePage')->name('addOrSavePage');
Route::post('/adm/addOrSaveArticle', 'AdminController@addOrSaveArticle')->name('addOrSaveArticle');
Route::post('/adm/addOrSaveFaq', 'AdminController@addOrSaveFaq')->name('addOrSaveFaq');
Route::post('/adm/addOrSaveCarousel', 'AdminController@addOrSaveCarousel')->name('addOrSaveCarousel');
Route::delete('/adm/deleteBrand', 'AdminController@deleteBrand')->name('deleteBrand');
Route::delete('/adm/deleteProduct', 'AdminController@deleteProduct')->name('deleteProduct');
Route::delete('/adm/deletePage', 'AdminController@deletePage')->name('deletePage');
Route::delete('/adm/deleteArticle', 'AdminController@deleteArticle')->name('deleteArticle');
Route::delete('/adm/deleteFaq', 'AdminController@deleteFaq')->name('deleteFaq');
Route::delete('/adm/deleteCarousel', 'AdminController@deleteCarousel')->name('deleteCarousel');
