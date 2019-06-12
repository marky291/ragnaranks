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

use App\Http\Resources\ListingResource;
use App\Listings\Listing;
use App\Listings\ListingConfiguration;
use Illuminate\Support\Facades\Route;

Route::get('/listing/defaults', function () {
    return ListingResource::make((new Listing())->setRelation('configuration', new ListingConfiguration)->setRelation('ranking', new \App\Listings\ListingRanking));
});

Route::get('/listing/{listing}', function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}", 1, function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'screenshots', 'tags', 'configuration', 'language'));
    });
});

Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('ListingFilteringController@filters');
