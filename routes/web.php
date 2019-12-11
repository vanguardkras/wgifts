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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/gift_choose', 'HomeController@giftChoose');

/** Admin-panel */
Route::get('admin', 'Admin\AdminController@admin');
Route::get('admin/settings', 'Admin\AdminController@settings');
Route::post('admin/store_background', 'Admin\AdminController@storeBackground');
Route::patch('admin/edit_background/{background}', 'Admin\AdminController@editBackground');
Route::patch('admin/update_price', 'Admin\AdminController@updatePrice');
Route::patch('admin/update_payment', 'Admin\AdminController@updatePayment');
Route::delete('admin/delete_background/{background}', 'Admin\AdminController@deleteBackground');
Route::resource('admin/suggestions', 'SuggestionController');
Route::get('suggestion', 'SuggestionController@random');

/** Authentication */
Auth::routes();

/** GiftLists */
Route::get('lists', 'GiftListController@index');
Route::get('lists/{gift_list}/edit', 'GiftListController@edit');
Route::get('lists/{gift_list}', 'GiftListController@giftsIndex');
Route::patch('lists/{gift_list}', 'GiftListController@update');
Route::get('list/create', 'GiftListController@create');
Route::post('lists', 'GiftListController@store');
Route::delete('lists/{gift_list}', 'GiftListController@destroy');

/** Gifts */
Route::post('{gift_list}/gift', 'GiftController@store');
Route::patch('gift/{gift}', 'GiftController@update');
Route::delete('gift/{gift}', 'GiftController@destroy');

/** Public routes */
Route::get('{gift_list_domain}', 'HomeController@showList');
