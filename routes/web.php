<?php

use Illuminate\Support\Facades\Route;

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

Route::view('dashboard', 'dashboard')
	->name('dashboard')
	->middleware(['auth', 'verified']);

Route::resource('/user', 'UserController');
Route::resource('/product', 'ProductController');
Route::resource('/transaction', 'TransactionController');

Route::get('/transaction/cancel/{id}', 'TransactionController@cancel')->name('cancelTransaction');
Route::get('/transaction/confirm/{id}', 'TransactionController@confirm')->name('confirmTransaction');
Route::get('/transaction/deliver/{id}', 'TransactionController@deliver')->name('deliverTransaction');
Route::get('/transaction/complete/{id}', 'TransactionController@complete')->name('completeTransaction');


Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
	Route::view('profile', 'profile.show');

});