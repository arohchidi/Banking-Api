<?php
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



 Route::get('/', function () {
        return view('welcome');
    });



Route::get('fund', 'DepositController@fund');
Route::get('login', 'Auth\LoginController@login');
/*
/*
 |-----------------------------------
 | Authentication
 |-----------------------------------
 */
Route::post('api/customer/sign-up', 'Auth\RegisterController@createAccount');
Route::post('api/customer/sign-in', 'Auth\LoginController@authenticateUser');
Route::post('api/customer/logout', 'Auth\LoginController@logout');
Route::post('api/customer/deposit', 'DepositController@fundAccount');
Route::post('api/customer/withdraw_fund', 'WithdrawalController@processWithdrawal');


/*
 |
 |-----------------------------------
 | Customer
 |--------- -------------------------
 */

 