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

Route::get('/listings', function () {
    return cache()->remember('listing', now()->addSeconds(30), function() {
        return ListingResource::collection(App\Listings\Listing::relations()->whereIn('id', app('rankings')->take(7)->keys())->paginate(7)->sortBy('rank'));
    });
});

Route::get('/listing/tags', function () {
    return App\Http\Resources\TagResource::collection(\App\Tag::all());
});

Route::get('/listing/{listing}', function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}", 1, function() use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('tags'));
    });
});