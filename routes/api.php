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

// search for a listing.
Route::get('/servers/search')->middleware(['throttle:500,1'])->uses('ListingSearchController@index');
// return metrics about the listing.
Route::get('/listing/{listing}/player/metrics/averages', 'ListingPlayerMetricController@averages')->name('metric.players.averages');
// return the votes in the last 30 days.
Route::get('/listing/{listing}/vote/metrics/monthly', 'ListingVoteMetricController@monthly')->name('metric.votes.monthly');
// filter servers based on conditional inputs.
Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}', 'ListingFilteringController@filters');
