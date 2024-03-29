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
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/articles', 'HomeController@articlesPage')->name('articlesPage');
Route::get('/page/{id}', 'HomeController@pagePage')->where('id', '[0-9]+')->name('pagePage');
Route::post('/send/addContactFromForm', 'HomeController@addContactFromForm')->name('addContactFromForm');
Route::get('/brand/{id}', 'HomeController@brandPage')->where('id', '[0-9]+')->name('brandPage');
Route::get('/product-group/{id}', 'HomeController@productGroupPage')->where('id', '[0-9]+')->name('productGroupPage');
Route::get('/category/{id}', 'HomeController@categoryPage')->where('id', '[0-9]+')->name('categoryPage');
Route::get('/article/{id}', 'HomeController@articlePage')->where('id', '[0-9]+')->name('articlePage');
Route::get('/magazin', 'HomeController@magazinPage')->name('magazinPage');
Route::get('/orders', 'HomeController@ordersPage')->name('ordersPage');
Route::get('/profile', 'HomeController@profilePage')->name('profilePage');
Route::post('/profile/save', 'HomeController@profileSave')->name('profileSave');
Route::post('/profile/savePassword', 'HomeController@profileSavePassword')->name('profileSavePassword');


Route::post('/cart/{id}', 'CartController@addItem');
Route::post('/cart/checkout/{id}', 'CartController@addOrder');
Route::get('/cart/{id}', 'CartController@getItems');
Route::delete('/cart/{id}', 'CartController@deleteItem');
Route::get('/cart-checkout', 'HomeController@cartPage')->name('cartPage');

Route::get('/invoice/{id}.pdf', 'CartController@getInvoicePdf')->where('id', '[0-9]+')->name('getInvoicePdf');


Route::get('/adm', 'AdminController@index')->name('admin');
Route::get('/adm/products', 'AdminController@productsPage')->name('adminProductsGet');
Route::get('/adm/brands', 'AdminController@brandsPage')->name('adminBrandsGet');
Route::get('/adm/product-groups', 'AdminController@productGroupsPage')->name('adminProductGroupsGet');
Route::get('/adm/categories', 'AdminController@categoriesPage')->name('adminCategoriesGet');
Route::get('/adm/pages', 'AdminController@pagesPage')->name('adminPagesGet');
Route::get('/adm/articles', 'AdminController@articlesPage')->name('adminArticlesGet');
Route::get('/adm/faqs', 'AdminController@faqsPage')->name('adminFaqsGet');
Route::get('/adm/contacts', 'AdminController@contactsPage')->name('adminContactsGet');
Route::get('/adm/users', 'AdminController@usersPage')->name('adminUsersGet');
Route::get('/adm/orders', 'AdminController@ordersPage')->name('adminOrdersGet');
Route::get('/adm/carousels', 'AdminController@carouselsPage')->name('adminCarouselsGet');
Route::get('/adm/settings', 'AdminController@settingsPage')->name('adminSettingsGet');
Route::post('/adm/addOrSaveProduct', 'AdminController@addOrSaveProduct')->name('addOrSaveProduct');
Route::post('/adm/addOrSaveBrand', 'AdminController@addOrSaveBrand')->name('addOrSaveBrand');
Route::post('/adm/addOrSaveProductGroup', 'AdminController@addOrSaveProductGroup')->name('addOrSaveProductGroup');
Route::post('/adm/addOrSaveCategory', 'AdminController@addOrSaveCategory')->name('addOrSaveCategory');
Route::post('/adm/addOrSavePage', 'AdminController@addOrSavePage')->name('addOrSavePage');
Route::post('/adm/addOrSaveArticle', 'AdminController@addOrSaveArticle')->name('addOrSaveArticle');
Route::post('/adm/addOrSaveUser', 'AdminController@addOrSaveUser')->name('addOrSaveUser');
Route::post('/adm/addOrSaveOrder', 'AdminController@addOrSaveOrder')->name('addOrSaveOrder');
Route::post('/adm/addOrSaveFaq', 'AdminController@addOrSaveFaq')->name('addOrSaveFaq');
Route::post('/adm/addOrSaveCarousel', 'AdminController@addOrSaveCarousel')->name('addOrSaveCarousel');
Route::post('/adm/addOrSaveSetting', 'AdminController@addOrSaveSetting')->name('addOrSaveSetting');
Route::delete('/adm/deleteBrand', 'AdminController@deleteBrand')->name('deleteBrand');
Route::delete('/adm/deleteProductGroup', 'AdminController@deleteProductGroup')->name('deleteProductGroup');
Route::delete('/adm/deleteCategory', 'AdminController@deleteCategory')->name('deleteCategory');
Route::delete('/adm/deleteProduct', 'AdminController@deleteProduct')->name('deleteProduct');
Route::delete('/adm/deletePage', 'AdminController@deletePage')->name('deletePage');
Route::delete('/adm/deleteArticle', 'AdminController@deleteArticle')->name('deleteArticle');
Route::delete('/adm/deleteUser', 'AdminController@deleteUser')->name('deleteUser');
Route::delete('/adm/deleteOrder', 'AdminController@deleteOrder')->name('deleteOrder');
Route::delete('/adm/deleteFaq', 'AdminController@deleteFaq')->name('deleteFaq');
Route::delete('/adm/deleteCarousel', 'AdminController@deleteCarousel')->name('deleteCarousel');
