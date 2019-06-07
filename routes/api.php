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
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ListingResource;

Route::get('/listings', function () {
    return cache()->remember('listing', 30, function () {
        return ListingResource::collection(Listing::with(['ranking','language'])->paginate(7));
    });
});

Route::get('/listing/tags', function () {
    return App\Http\Resources\TagResource::collection(\App\Tag::all());
});

Route::get('/listing/{listing}', function (Listing $listing) {
    return cache()->remember("listing2:{$listing->name}", 0, function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'tags', 'language'));
    });
});

Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('ListingController@filters')->name('listing.filters');
