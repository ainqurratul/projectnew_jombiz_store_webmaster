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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'Api\UserController@login');

Route::post('register', 'Api\UserController@register');

Route::get('product', 'Api\ProductController@index');

Route::post('checkout', 'Api\TransactionController@store');

Route::get('checkout/user/{id}', 'Api\TransactionController@history');

Route::post('checkout/cancel/{id}', 'Api\TransactionController@cancel');

Route::post('checkout/upload/{id}', 'Api\TransactionController@upload');

Route::post('push', 'Api\TransactionController@pushNotif');

Route::post('download/{id}','TransactionController@download');







