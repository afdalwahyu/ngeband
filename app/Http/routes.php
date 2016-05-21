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

  //Register
  Route::post('register','UserController@store')

  //routes for authenticated user only
  Route::group(['middleware' => 'auth'], function () {

    //show user profile
    Route::get('user/profile', 'UserController@showProfile');

    //update user profile
    Route::post('user/update', 'UserController@updateProfile');

    //-------band------//
    //create band
    //show band member list
    //join band
    //edit band member (only creator)
    //accept/decline pending member
    //-----------------//

    //-------friend------//
    //show friend
    //add friend
    //approve friend
    //decline friend
    //unfriend
    //-------------------//

  });

});
