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

// image uploading
Route::get('/filepond/process', 'FilepondController@fetch')->name('filepond.fetch');
Route::post('/filepond/process', 'FilepondController@upload')->name('filepond.upload');
Route::delete('/filepond/process', 'FilepondController@delete')->name('filepond.delete');

// search for a listing.
Route::get('/servers/search')->middleware(['throttle:500,1'])->uses('ListingSearchController@index');
// return metrics about the listing.
Route::middleware('auth:api')->get('{listing}/graph/players', 'ListingGraphController@players')->name('api.graph.players');
// return the votes in the last 30 days.
Route::middleware('auth:api')->get('{listing}/graph/votes', 'ListingGraphController@votes')->name('api.graph.votes');
// return the votes in the last 30 days.
Route::middleware('auth:api')->get('{listing}/graph/clicks', 'ListingGraphController@clicks')->name('api.graph.clicks');
// filter servers based on conditional inputs.
Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}', 'ListingFilteringController@filters');


Route::get('/partials/latest-servers', 'SidebarController@servers');
Route::get('/partials/latest-reviews', 'SidebarController@reviews');

Route::get('/listing/configurations', static function () {
    return cache()->remember('listing:configurations', 120, static function () {
        return array_merge(
            ['tags' => config('filter.tags')],
            ['languages' => config('filter.languages')],
            ['presets' => config('filter.presets')],
            ['accents' => config('filter.accents')],
            ['modes' => config('filter.modes')]
        );
    });
});

Route::get('/database', 'BrowserQueryController@index');
Route::get('/database/item/{item}', 'ItemController@partial');
Route::get('/database/monster/{monster}', 'Partials\MonsterPartialsController@glance');