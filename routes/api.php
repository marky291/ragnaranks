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

use App\Listings\Listing;
use App\Listings\ListingRanking;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ReviewResource;
use App\Listings\ListingConfiguration;
use App\Http\Resources\ListingResource;

Route::get('/listing/defaults', static function () {
    return cache()->rememberForever('listing:defaults', static function () {
        return ListingResource::make((new Listing())->setRelation('configuration', new ListingConfiguration)->setRelation('ranking', new ListingRanking));
    });
});

Route::get('/listing/{listing}', static function (Listing $listing) {
    return cache()->remember("2listing:{$listing->name}", 120, static function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'screenshots', 'tags', 'configuration', 'language', 'reviews'));
    });
});

Route::get('/listing/{listing}/reviews', static function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}:reviews", 120, static function () use ($listing) {
        return ReviewResource::collection($listing->reviews()->with('user')->get());
    });
});

Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('ListingFilteringController@filters');
