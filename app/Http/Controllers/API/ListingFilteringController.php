<?php

namespace App\Http\Controllers\API;

use App\Tag;
use App\Listings\Listing;
use App\Http\Controllers\Controller;
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
    public function filters($expTitle = 'all', $modeType = 'all', $tagName = 'all', $orderBy = 'all', $paginate = 7)
    {

        /**
         * The query builder.
         */
        $builder = Listing::query();

        /*
         * Filter the query to exp-title after we validate its a valid input
         */
        if (($expTitle !== 'all') && array_key_exists($expTitle, trans('homepage.rate'))) {
            $builder->with('configuration')
                ->whereHas('configuration', function ($query) use ($expTitle) {
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
         * Return a json response resource.
         */
        return ListingResource::collection($builder->with('ranking', 'language')->paginate($paginate));

        // get all with the server mode.

        // get all with the tag

        // order the collection by condition attribute.

        // turn collection into listing resource.

//        return ListingResource::collection($listings->take($paginate));
    }
}
