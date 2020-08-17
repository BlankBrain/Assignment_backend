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
//get list of user
Route::get('user/list', 'loginController@getListOfUsers');

// login by email
Route::POST('user/login', 'loginController@loginByEmail');

// get list of codes
Route::get('code/list', 'loginController@getListOfCodes');


Route::POST('user/signup', 'loginController@newUser');

Route::POST('code/new', 'loginController@newCode');
