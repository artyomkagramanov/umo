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
    return view('layouts.app');
});

Route::group(['middleware' => ['web'] , 'prefix' => 'api'], function () {
   Route::resource('calculate', 'CalculateController');
   Route::post('pre-register', 'UserController@preRegister');
   Route::post('register-check', 'UserController@registerCheck');
   Route::post('register', 'UserController@register');
   Route::get('get-auth-user', 'UserController@getAuthUser');
   Route::get('logout', 'UserController@logout');
   Route::post('login', 'UserController@doLogin');
   Route::get('linkedin-callback', 'SocialRegisterController@linkedin');
});

Route::group(['middleware' => ['web']], function () {
   Route::get('linkedin-callback', 'SocialRegisterController@linkedin');
   Route::get('google-callback', 'SocialRegisterController@google');
});

