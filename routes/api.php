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
use App\Http\Resources\NewListingResource;

Route::get('/listing/defaults', static function () {
    return cache()->rememberForever('listing:defaults', static function () {
        return NewListingResource::make((new Listing())->setRelation('configuration', new ListingConfiguration)->setRelation('ranking', new ListingRanking));
    });
});

Route::get('/listing/configurations', static function () {
    return cache()->remember('listing:configurations', 120, static function () {
        return json_encode(array_merge(
            ['tags' => config('filter.tags')],
            ['languages' => config('filter.languages')],
            ['presets' => config('filter.presets')],
            ['accents' => config('filter.accents')],
            ['modes' => config('filter.modes')]
        ));
    });
});

Route::get('/listing/{name}/available', static function (string $name) {
    return json_encode(! Listing::whereName($name)->count());
});

Route::get('/listing/{listing}', static function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}", 120, static function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'screenshots', 'tags', 'configuration', 'language', 'reviews', 'reviews.user', 'reviews.comments'));
    });
});

Route::get('/listing/{listing}/reviews', static function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}:reviews", 120, static function () use ($listing) {
        return ReviewResource::collection($listing->reviews()->with('user')->get());
    });
});

Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('ListingFilteringController@filters');
