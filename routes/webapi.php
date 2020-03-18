<?php

use Carbon\Carbon;
use App\Listings\Listing;
use App\Listings\Votes\Vote;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ReviewResource;

Route::middleware('api')->get('/{listing}/vote4points')->uses('Vote4PointsController@index')->name('vote4points');

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
