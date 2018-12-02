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

// default index page.
Route::get('/')->uses('FilterController@index')->name('filter.index');

// card filtering system.
Route::get('/servers/{exp_group}/{mode}/{sort}/{orderBy}')->uses('FilterController@query')->name('filter.query');

\Illuminate\Support\Facades\Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

