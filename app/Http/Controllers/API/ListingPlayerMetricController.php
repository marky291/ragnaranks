<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Listings\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Class ListingMetricController
 *
 * @package App\Http\Controllers\API
 */
class ListingPlayerMetricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Listing $listing
     * @return Collection
     */
    public function today(Listing $listing)
    {
        return Cache::remember("player:metric:today:{$listing->id}", now()->addMinutes(10), static function() use ($listing) {
            /** @var Collection $collection */
            $collection = $listing->heartbeats()->fromStartOfDay()->groupPlayersHourly()->get();

            return $collection->mapWithKeys(static function($item) {
                /** @var Carbon $time */
                $time = Carbon::createFromFormat('H', $item->hour);
                return [$time->format('ga') => $item->players];
            });
        });
    }
}
