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

// authentication routes (login & logout)
Illuminate\Support\Facades\Auth::routes();

// default index page.
Route::get('/')->uses('ListingController@index')->name('index');

// listing controllers.
Route::resource('listing', 'ListingController');

// listing reviews controllers.
Route::resource('listing.reviews', 'ReviewController')->only(['store', 'update', 'destroy']);

// card filtering system.
Route::get('/servers/{exp_group}/{mode}/{sort}/{orderBy}')->uses('QueryController@index')->name('filter.query');
