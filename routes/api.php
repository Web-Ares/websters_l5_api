<?php

use Illuminate\Http\Request;

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


Route::group(['prefix' => 'v1', 'middleware' => ['cors']], function () {
    
    Route::post('/auth',['uses' => 'AuthController@getLogin', 'as' => 'auth'])->middleware('google.auth');

    Route::resource('users','UserController', ['except' => ['store','show']]);

    Route::get('users/me','UserController@getMe')->middleware('google.check');

});