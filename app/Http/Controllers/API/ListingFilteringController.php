<?php

namespace App\Http\Controllers\API;

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
     * @param string $serverType
     * @param string $serverMode
     * @param string $withTag
     * @param string $sortByAttribute
     * @param int $paginate
     * @return AnonymousResourceCollection
     */
    public function filters($rates = 'all', $serverMode = 'all', $withTag = 'all', $sortByAttribute = 'any', $paginate = 25)
    {
        $listings = Listing::all();

        if ($rates) {
            return Listing::all();
        }

        if ($serverMode) {
            $listings = $listings->filterMode($serverMode);
        }

        if ($withTag) {
            $listings = $listings->filterTag($withTag);
        }

        if ($sortByAttribute) {
            $listings = $listings->filterSort($sortByAttribute);
        }

        return ListingResource::collection($listings->take($paginate));
    }
}
