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



Route::group(['prefix' => 'v1'], function () {
    
    Route::get('/users', ['uses' => 'UserController@getUsers', 'as' => 'home'])->middleware('google.check');
    
    Route::get('/users/{a}', 'UsersCustom@get2');
    
    Route::get('/auth_g','UserController@getGoogle');

    Route::get('/auth',['uses' => 'UserController@getLogin', 'as' => 'auth'])->middleware('google.check');

});