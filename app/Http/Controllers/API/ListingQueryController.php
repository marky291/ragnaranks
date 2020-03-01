<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use App\Listings\Listing;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ListingQueryController extends Controller
{
    public function index(Request $request)
    {
        return Cache::remember($this->getCacheKey($request), now()->addMinutes(1), function() use ($request) {
            /**
             * All listings need a ranking, that can be sortable.
             */
            $builder = Listing::query()->join('listing_rankings', 'listings.id', '=', 'listing_rankings.listing_id');

            // allow search for specific servers
            if ($request->has('search') && ($search = $request->get('search')) !== 'all') {
                $builder->where('name', 'like', "%{$search}%");
            }

            // (official-rate, low-rate, mid-rate, high-rate, super-high-rate)
            if ($request->has('rates') && ($rate = $request->get('rates')) !== 'all') {
                $builder->with('rate')->whereHas('rate', function($query) use ($rate) {
                    $query->where('name', $rate);
                });
            }

            // (renewal, pre-renewal, custom)
            if ($request->has('modes') && ($mode = $request->get('modes')) !== 'all') {
                $builder->with('mode')->whereHas('mode', function($query) use ($mode) {
                    $query->where('name', $mode);
                });
            }

            // (various tag assignments to check)
            if ($request->has('tags') && ($tag = $request->get('tags')) !== 'all') {
                $builder->with('tags')->whereHas('tags', static function ($query) use ($tag) {
                    $query->where('name', $tag);
                });
            }

            /*
            * Ordering of the listings.
            */
            switch ($request->get('sort', 'rank')) {
                case 'name':
                    $builder->orderBy('name');
                    break;
                case 'rank':
                    $builder->orderBy('rank');
                    break;
                case 'creation':
                    $builder->orderByDesc('created_at');
                    break;
            }

            /*
            * Return a json response resource.
            */
            return ListingResource::collection($builder->with(['configuration', 'mode', 'tags', 'ranking', 'language', 'heartbeat'])->paginate(7));

        });
    }

    private function getCacheKey(Request $request)
    {
        return 'servers.query.' . implode('.', array_values($request->input()));
    }
}
