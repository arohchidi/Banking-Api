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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customer/sign-up', 'Auth\RegisterController@createAccount');
Route::post('/customer/sign-in', 'Auth\LoginController@authenticateUser');
Route::post('/customer/logout', 'Auth\LoginController@logout');
Route::post('/customer/deposit', 'DepositController@fundAccount');
Route::post('/customer/withdraw_fund', 'WithdrawalController@processWithdrawal');
