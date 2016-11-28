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


Route::group(['prefix' => 'v1', 'middleware' => ['cors','google.check']], function () {

    Route::resource('users','UserController', ['only' => ['store','destroy','update']]);

    Route::post('users/create','UserController@create');

    Route::get('users/{id?}','UserController@show');

    Route::get('roles','RoleController@getRoles');

    Route::resource('positions','PositionController', ['only' => ['store','index','destroy','update']]);

    Route::resource('technologies','TechnologyController', ['only' => ['store','index','destroy']]);

    Route::put('technologies/{id}','TechnologyController@updateName');

    Route::post('technologies/{id}/upload','TechnologyController@patchImage');
});

Route::group(['prefix' => 'v1', 'middleware' => ['cors','google.auth']], function () {

    Route::post('/auth',['uses' => 'AuthController@getLogin', 'as' => 'auth'])->middleware('google.auth');

});


Route::group(['prefix' => 'v1', 'middleware' => ['cors']], function () {

    Route::get('test/{id}','UserController@getTest');



    Route::get('/test', function () {

        return view('welcome');
    });

});