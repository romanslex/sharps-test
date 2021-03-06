<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/data/transactions', 'TransactionController@create')->name('create-transaction');

Route::put('/data/users/{id}', 'Admin\UserController@update')->name('update-user');

Route::get('/admin{any}', 'Admin\HomeController@index')->name('admin')->where('any', '.*');
