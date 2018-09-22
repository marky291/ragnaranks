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

Route::get('/')->uses('FilterController@index')->name('filter.index');

Route::get('/filters/votes/period/days/{period}')->uses('FilterController@votes')->name('filter.votes');
Route::get('/filters/clicks/period/days/{period}')->uses('FilterController@clicks')->name('filter.clicks');

Route::get('/filters/creation/{order}')->uses('FilterController@creation')->name('filter.creation');