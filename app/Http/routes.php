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

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
  return 'please use /api/ uri';
});

//routes API for json data transfer
Route::group(['prefix' => 'api'], function () {

  //send request with email & password using method POST
  Route::post('authenticate', 'AuthenticateController@authenticate');

  //Register
  Route::post('register','UserController@store');

  //routes for authenticated user only
  Route::group(['middleware' => 'jwt.auth'], function () {

    Route::get('tes',function(){
      return 'tes';
    });

    //group for user
    Route::group(['prefix' => 'user'], function () {
      //show user profile
      Route::get('profile', 'UserController@showProfile');
      //update user profile
      Route::put('update', 'UserController@updateProfile');
      //get list band created by user
      Route::get('band','UserController@showBand');
      //show friend pending list
      Route::get('friend/pending','UserController@pending');
      //accept or decline pending friend request
      Route::put('friend/{id}/{code}','UserController@updateFriend')->where(['id' => '[0-9]+','code' => '[0-2]+']);
      //accept or decline pending band request
      Route::put('band/{id}/{friendid}/{code}','UserController@updateBand')->where(['id' => '[0-9]+','code' => '[0-2]+','friendid' => '[0-9]+']);
    });

    //group for band
    Route::group(['prefix' => 'band'], function () {
      //create
      Route::post('store','BandController@store');
      //show band info
      Route::get('{id}','BandController@show');
      //join list
      Route::post('join/{id}','BandController@join')->where(['id' => '[0-9]+']);
      //show member band list
      Route::get('list/{id}','BandController@lists')->where(['id' => '[0-9]+']);
    });


    //group for friend
    Route::group(['prefix' => 'friend'], function () {
      //show profile based on id
      Route::get('{id}','FriendController@show');
      //show list friend based on id
      Route::get('list/{id}','FriendController@showlist')->where(['id' => '[0-9]+']);
      //add as friend
      Route::post('add/{id}','FriendController@addfriend')->where(['id' => '[0-9]+']);
    });
  });

});
