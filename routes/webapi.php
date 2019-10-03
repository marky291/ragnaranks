<?php

use Carbon\Carbon;
use App\Listings\Listing;
use App\Interactions\Vote;
use App\Listings\ListingRanking;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ReviewResource;
use App\Listings\ListingConfiguration;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\NewListingResource;
use App\Http\Controllers\ListingVoteController;

Route::middleware('api')->get('/{listing}/vote4points', static function (Listing $listing) {
    $response = (new ListingVoteController())->processVote($listing);
    if ($response->getData('data')['success'] == true) {
        return '<h3>'.trans('profile.voting.heading.finished', ['name' => $listing->name]).'</h3>';
    }

    return '<h3>'.trans('profile.voting.heading.completed', ['name' => $listing->name]).'</h3>';
})->name('vote4points');

Route::get('/listing/defaults', static function () {
    return cache()->remember('listing:defaults', 600, static function () {
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
    return json_encode(validator(['name' => $name], ['name' => 'required|unique:listings,name'], ['unique' => 'Server name taken!'])->validate());
});

Route::get('/listing/{listing}', static function (Listing $listing) {
    return cache()->remember("listing:{$listing->name}", 3600, static function () use ($listing) {
        return App\Http\Resources\ListingResource::make($listing->load('ranking', 'screenshots', 'tags', 'configuration', 'language', 'reviews', 'heartbeat'));
    });
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

Route::get('/servers/{exp_group}/{mode}/{tag}/{sort}/{limit}')->uses('ListingFilteringController@filters');
