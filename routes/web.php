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

// Route::view('dashboard', 'dashboard')
// 	->name('dashboard')
// 	->middleware(['auth', 'verified']);

Route::get('/dashboard', 'HomeController@index')
->name('dashboard');

Route::resource('/user', 'UserController');
Route::resource('/product', 'ProductController');
Route::resource('/transaction', 'TransactionController');
Route::resource('/details', 'DetailsController');


Route::get('/transaction/cancel/{id}', 'TransactionController@cancel')->name('cancelTransaction');
Route::get('/transaction/confirm/{id}', 'TransactionController@confirm')->name('confirmTransaction');
Route::get('/transaction/deliver/{id}', 'TransactionController@deliver')->name('deliverTransaction');
Route::get('/transaction/complete/{id}', 'TransactionController@complete')->name('completeTransaction');

//delete data
Route::get('/delete-records','UserController@index');
Route::get('/delete/{id}','UserController@destroy');

// Route::get('/product/delete-products','ProductController@index');
Route::get('/product/delete/{id}','ProductController@destroy');


// Route::get('view-records','DetailsController@index');
// Route::get('view/{id}','DetailsController@index');

//image
Route::get('/download/{file}','TransactionController@download');
Route::get('/view/{is}','TransactionController@view');



//retrive data
// Route::get('show/{id}','DetailsController@show');

// Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
// 	Route::view('profile', 'profile.show');

// });