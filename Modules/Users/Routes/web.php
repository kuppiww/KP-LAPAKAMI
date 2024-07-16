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

Route::prefix('sysusers')->group(function() {
    Route::get('/', 'UsersController@index');
    Route::get('/create', 'UsersController@create');
    Route::get('/show/{id}', 'UsersController@show');
    Route::get('/edit/{id}', 'UsersController@edit');
    Route::post('/store', 'UsersController@store');
    Route::post('/update/{id}', 'UsersController@update');
    Route::get('/delete/{id}', 'UsersController@destroy');
    Route::get('/getdata/{id}', 'UsersController@getdata');
});
