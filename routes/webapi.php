<?php

use Carbon\Carbon;
use App\Listings\Listing;
use App\Listings\Votes\Vote;
use App\Listings\ListingRanking;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ReviewResource;
use App\Listings\ListingConfiguration;
use App\Http\Resources\NewListingResource;

Route::middleware('api')->get('/{listing}/vote4points')->uses('Vote4PointsController@index')->name('vote4points');

Route::get('/listing/defaults', static function () {
    return cache()->remember('listing:defaults', 600, static function () {
        return NewListingResource::make((new Listing())->setRelation('configuration', new ListingConfiguration)->setRelation('ranking', new ListingRanking));
    });
});

Route::get('/listing/{listing}', static function (Listing $listing) {
    return cache()->remember("listing.{$listing->name}", now()->addMinutes(10), static function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'screenshots', 'tags', 'configuration', 'language', 'reviews', 'heartbeat'));
    });
});

Route::get('/listing/{name}/available', static function (string $name) {
    return json_encode(validator(['name' => $name], ['name' => 'required|unique:listings,name'], ['unique' => 'Server name taken!'])->validate());
});

Route::get('/listing/{listing}/reviews', static function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}:reviews", 1, static function () use ($listing) {
        return ReviewResource::collection($listing->reviews()->with('user')->get());
    });
});

Route::get('/voting/stats', static function () {
    return array_merge(config('action.vote'), [
        'concluded' => (int) Vote::hasInteractedDuring(config('action.vote.spread')),
        'last_vote' => Vote::byCurrentIP()->pluck('created_at')->first(),
        'next_vote' => Carbon::parse(Vote::byCurrentIP()->pluck('created_at')->first())->addHours(config('action.vote.spread')),
    ]);
});
