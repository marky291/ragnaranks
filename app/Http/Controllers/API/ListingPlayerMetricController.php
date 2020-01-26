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
    public function averages(Listing $listing)
    {
        /** @var Collection $collection */
        $collection = $listing->heartbeats()->last48Hours()->get();

        $collection = $collection->groupBy(static function($heartbeat) {
            if ($heartbeat->created_at->isToday()) {
                return 'today';
            }
            return 'yesterday';
        });

        foreach ($collection as $key => $item) {
            $collection[$key] = $item->mapWithKeys(static function($item) {
                return [$item->created_at->format('ga') => $item->players];
            });
        }

        return $collection;
    }
}
