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


Route::get('/get_info_room/{id}/{type}', 'HomeController@getInfoRoom');

Route::get('/get_list_message_room/{id}/{lastIdMessage}/{mode}', 'HomeController@getListMessageRoom');

Route::get('/logout', function(){
   Auth::logout();
   return Redirect::to('login');
});

Route::get('/mark_seen_message/{idRoom}', 'HomeController@markSeenMessage');
Route::get('/get_user_in_room/{idRoom}', 'HomeController@getUserInRoom');

Route::get('/pin_message/{mode}/{id}', 'HomeController@pinMessage');


Route::get('/get_pinned_message/{id}', 'HomeController@getPinnedMessage');


Route::post('/find_user_add_group', 'HomeController@findUserAddGroup');

Route::post('/add_group', 'HomeController@addGroup');





