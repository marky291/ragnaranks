<?php

namespace App\Http\Controllers\API;

use App\Listings\Listing;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ListingResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ListingFilteringController.
 */
class ListingFilteringController extends Controller
{
    /**
     * Form Controller search as part of our "Im Looking for" selects.
     *
     * @param string $expTitle
     * @param string $modeType
     * @param string $tagName
     * @param string $orderBy
     * @param int $paginate
     * @return AnonymousResourceCollection
     */
    public function filters($expTitle = 'all', $modeType = 'all', $tagName = 'all', $orderBy = 'all', $paginate = 5)
    {
        // get the current page request, otherwise get the first.
        $currentPage = $_REQUEST['page'] ?? 1;

        // generate a cache tag from the request query parameters and return a result of generated sql
        return Cache::remember("filter::{$expTitle}:{$modeType}:{$tagName}:{$orderBy}:5:{$currentPage}", now()->addMinutes(10), static function () use ($expTitle,$modeType,$tagName,$orderBy,$paginate) {
            /**
             * All listings need a ranking, that can be sortable.
             */
            $builder = Listing::query()->join('listing_rankings', 'listings.id', '=', 'listing_rankings.listing_id');
            /*
             * Filter the query to exp-title after we validate its a valid input
             */
            if (($expTitle !== 'all') && array_key_exists($expTitle, trans('homepage.rate'))) {
                $builder->with('configuration')
                    ->whereHas('configuration', static function ($query) use ($expTitle) {
                        $query->where('exp_title', $expTitle);
                    });
            }
            /*
             * Filter the query to mode types after we validate its a valid input
             */
            if (($modeType !== 'all') && array_key_exists($modeType, trans('homepage.mode'))) {
                $builder->where('mode', $modeType);
            }
            /*
             * Filter the query to where a tag matches this value.
             */
            if (($tagName !== 'all') && array_key_exists($tagName, trans('homepage.tag'))) {
                $builder->with('tags')->whereHas('tags', static function ($query) use ($tagName) {
                    $query->where('name', $tagName);
                });
            }
            /*
             * Ordering of the listings.
             */
            switch ($orderBy) {
                case 'name':
                    $builder->orderBy('name');
                    break;
                case 'rank':
                    $builder->orderBy('rank');
                    break;
                case 'created':
                    $builder->orderBy('created_at');
                    break;
            }
            /*
             * Return a json response resource.
             */
            return ListingResource::collection($builder->with(['configuration', 'tags', 'ranking', 'language', 'heartbeat'])->paginate(5));
        });
    }
}
