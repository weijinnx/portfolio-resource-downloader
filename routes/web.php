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

Route::get('/', 'ResourceController@index')->name('resource.list');
Route::get('add', 'ResourceController@add')->name('resource.add');
Route::post('job', 'ResourceController@job')->name('resource.job');
Route::get('download/{id}', 'ResourceController@download')
    ->name('resource.download');
