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

Route::prefix('usergroup')->group(function() {
    Route::get('/', 'UserGroupController@index');
    Route::get('/create', 'UserGroupController@create');
    Route::get('/show/{id}', 'UserGroupController@show');
    Route::get('/edit/{id}', 'UserGroupController@edit');
    Route::post('/store', 'UserGroupController@store');
    Route::post('/update/{id}', 'UserGroupController@update');
    Route::get('/delete/{id}', 'UserGroupController@destroy');
    Route::get('/getdata/{id}', 'UserGroupController@getdata');
});
