<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::post('app_login', 'APIController@app_login');

// private chat
Route::post('app_get_chat_user', 'APIAuthController@app_get_chat_user');
Route::post('app_get_chat_message', 'APIAuthController@app_get_chat_message');
Route::post('app_update_message_count', 'APIAuthController@app_update_message_count');

// group
Route::post('app_get_group_user_list', 'APIAuthController@app_get_group_user_list');
Route::post('app_get_group_message_list', 'APIAuthController@app_get_group_message_list');
Route::post('app_get_member_group', 'APIAuthController@app_get_member_group');
Route::post('app_get_member_group_list', 'APIAuthController@app_get_member_group_list');
Route::post('app_update_group_message_count', 'APIAuthController@app_update_group_message_count');


Route::post('app_chat_block_user', 'APIAuthController@app_chat_block_user');








