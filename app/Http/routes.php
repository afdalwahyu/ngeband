<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//routes API for json data transfer
Route::group(['prefix' => 'api'], function () {

  //send request with email & password using method POST
  Route::post('authenticate', 'AuthenticateController@authenticate');

  //routes for authenticated user only
  Route::group(['middleware' => 'auth'], function () {
    Route::get('user/profile', 'UserController@showProfile');
  });

});
