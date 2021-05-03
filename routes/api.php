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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'developers'
], function () {

    Route::post('/signup', 'UserController@signup');
    Route::post('/login', 'UserController@login');
    Route::post('/update', 'UserController@update');
    Route::get('/delete/{id}', 'UserController@delete');
    Route::get('/getalluser', 'UserController@getAllUser');
    Route::get('/getuserbyid/{id}', 'UserController@getUserById');
    Route::post('/deletemultipleuser', 'UserController@deleteMultiple');
    Route::post('/forgotpassword', 'UserController@forgotPassword');
    
});