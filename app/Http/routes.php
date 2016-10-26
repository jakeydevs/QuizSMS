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

Route::any('quiz',				'API\NexmoController@webhook');

Route::any('dashboard',			'DisplayController@showDashboard');
Route::any('users',				'DisplayController@showUsers');
Route::any('correct',			'DisplayController@showCorrect');
Route::any('user/{number}',		'DisplayController@showUser');