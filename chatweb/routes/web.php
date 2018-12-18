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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/get_list_user/{query}', 'HomeController@getUserListHtml');
Route::get('/get_list_user', 'HomeController@getUserListHtml');

Route::get('/get_list_message/{userId}/{lastIdMessage}', 'HomeController@getListMessage');
Route::post('/send_message', 'HomeController@sendMessage');


Route::get('/subscribe_topic/{token}/{roomId}/{type}', 'HomeController@subscribeTopic');
Route::get('/get_all_room', 'HomeController@getAllRoom');

Route::get('/remove_data', 'HomeController@removeData');
Route::get('/get_info_user/{id}', 'HomeController@getInfoUser');

Route::get('/test/{token}', 'HomeController@test');


Route::get('/get_info_room/{id}', 'HomeController@getInfoRoom');

Route::get('/get_list_message_room/{id}/{lastIdMessage}', 'HomeController@getListMessageRoom');

Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('login');
});

Route::get('/mark_seen_message/{idRoom}', 'HomeController@markSeenMessage');
