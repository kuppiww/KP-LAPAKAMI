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

use Illuminate\Support\Facades\Route;

Route::prefix('operator')->group(function() {
    Route::get('/', 'OperatorController@index');
    Route::get('/list', 'OperatorController@listpermohonan')->name('permohonan.list');
    Route::get('/detail/{id}/{service_id}', 'OperatorController@show');
});
