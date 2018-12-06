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
Route::get('/')->uses('HomeController@index')->name('home');

// card filtering system.
Route::get('/servers/{exp_group}/{mode}/{sort}/{orderBy}')->uses('HomeController@query')->name('filter.query');

// authentication routes (login & logout)
Illuminate\Support\Facades\Auth::routes();
