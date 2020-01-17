<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/filepond/process', 'FilepondController@fetch')->name('filepond.fetch');
Route::post('/filepond/process', 'FilepondController@upload')->name('filepond.upload');
Route::delete('/filepond/process', 'FilepondController@delete')->name('filepond.delete');

Route::get('/servers/search')->middleware(['throttle:500,1'])->uses('ListingSearchController@index');
