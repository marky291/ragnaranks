<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

/**
 * Class QueryController.
 */
class QueryController extends Controller
{
    /**
     * Form Controller search as part of our "Im Looking for" selects.
     *
     * @param string $serverType
     * @param string $serverMode
     * @param string $withTag
     * @param string $sortByAttribute
     * @param int $paginate
     * @return Factory|View
     */
    public function index($serverType = 'all', $serverMode = 'all', $withTag = 'all', $sortByAttribute = 'any', $paginate = 25)
    {
        $listings = app('listings');

        if ($serverType) {
            $listings = $listings->filterGroup($serverType);
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

        $listings = $listings->take($paginate);

        return response()->json(array_values($listings->toArray()));
    }
}
