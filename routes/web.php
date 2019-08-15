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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//user
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/users', 'UsersController@index')->name('index');
Route::get('/users/update/{user}', 'UsersController@update_page')->name('update');
Route::post('/users/update/{user}', 'UsersController@update_save')->name('update');
// Route::get('/users/history/{user}', 'UsersController@history_Order');
//categories
Route::get('/categories', 'CategoriesController@index')->name('index');
Route::get('/categories/create-new', 'CategoriesController@create_page')->name('create_page');
Route::post('/categories/create-new', 'CategoriesController@save_page')->name('create');
Route::get('/categories/update/{categories}', 'CategoriesController@update_page')->name('edit');
Route::post('/categories/update/{categories}', 'CategoriesController@update_save')->name('update');
Route::delete('/categories/delete/{categories}', 'CategoriesController@delete')->name('index');
Route::get('/categories/trash', 'CategoriesController@restore')->name('restore');
//Items
Route::get('/items', 'ItemsController@index')->name('index');
Route::get('/items/create-new', 'ItemsController@create_page')->name('create');
Route::post('/items/create-new', 'ItemsController@create_save')->name('create');
Route::get('/items/update/{item}', 'ItemsController@update_page')->name('edit');
Route::post('/items/update/{item}', 'ItemsController@save_update')->name('update');
Route::delete('/items/delete/{item}', 'ItemsController@delete')->name('delete');
//orders
Route::get('/orders', 'OrdersController@index')->name('index');
Route::get('/orders/create-new', 'OrdersController@create_page')->name('create');
Route::post('/orders/create-new', 'OrdersController@save_create')->name('save_create');
Route::get('/orders/update/{order}', 'OrdersController@update_page')->middleware('admin');
Route::post('/orders/update/{order}', 'OrdersController@save_update')->middleware('admin');
Route::get('/orders/view/{order}', 'OrdersController@view_orders')->name('view_orders');
//order status 
Route::get('/orders/action/{order}/{action}', 'OrdersController@action_update_status')->middleware('admin');
//report
Route::get('/report', 'ReportController@report')->middleware('admin');
Route::get('/report/print-pdf/{order}', 'ReportController@print_pdf')->middleware('admin');
Route::get('/report/failed', 'ReportController@failed')->middleware('admin');

//history
Route::get('/history/{user}', 'HomeController@history')->name('history');
Route::get('/history/update/status/{order}','HomeController@history_status')->name('history status');
Route::get('/history/report/{order}','HomeController@history_report')->name('history report');
Route::get('/history/update/{order}', 'HomeController@update_history')->name('history update');
Route::post('/history/update/{order}', 'HomeController@update_history_save')->name('history update');
//Notifications
Route::get('/notifications', 'NotificationsController@index')->name('notifications');
Route::get('/notifications/{notif}/{seen}', 'NotificationsController@read')->name('notifications');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
