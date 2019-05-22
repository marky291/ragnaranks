<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes(['verify' => true]);

Route::resource('review.comment', 'ReviewCommentController', ['middleware'=>['auth']])->only([
    'store'
]);

// default index page.
Route::get('/')->uses('ListingController@index')->name('index');

Route::get('/account')->middleware('auth')->uses('MyAccountController@index')->name('myAccount');
Route::get('/account/servers')->middleware('auth')->uses('MyAccountController@servers')->name('servers');
Route::get('/account/notifications')->middleware('auth')->uses('MyAccountController@notifications')->name('notifications');
Route::post('/account/update')->middleware('auth')->uses('MyAccountController@updateDetails');
Route::post('/notifications/read/{notification}')->middleware('auth')->uses('MyAccountController@markNotificationRead');
Route::post('/notifications/unread/{notification}')->middleware('auth')->uses('MyAccountController@markNotificationUnread');

// listing controllers.
Route::resource('listing', 'ListingController');

// listing reviews controllers.
Route::resource('listing.reviews', 'ReviewController')->only(['store', 'update', 'destroy']);

// listing votes controllers.
Route::resource('listing.votes', 'VoteController')->only(['store']);

Route::resource('listing.clicks', 'ClickController')->only(['store']);

// card filtering system.
Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('QueryController@index')->name('filter.query');
