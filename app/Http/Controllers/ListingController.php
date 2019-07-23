<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Listings\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\AssignRoleToUser;
use Illuminate\Support\Facades\DB;
use App\Listings\ListingConfiguration;
use App\Http\Requests\StoreListingRequest;

/**
 * Class ListingController.
 */
class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('listing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Listing $listing
     * @return View
     */
    public function create(Listing $listing) : View
    {
        return view('listing.profile')->with([
            'listing' => $listing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreListingRequest $request
     * @return void
     */
    public function store(StoreListingRequest $request)
    {
        AssignRoleToUser::dispatch(auth()->user(), 'creator');

        DB::transaction(static function () use ($request) {
            /** @var Listing $listing */
            // Create the listing.
            $listing = user()->listings()->save(Listing::make($request->validated()));

            // grab the configuration that has been validated and assign to the model.
            $validatedConfig = ListingConfiguration::make($request->validated()['config']);

            /** @var ListingConfiguration $configs */
            // save the configurations to the listing.
            $configs = $listing->configuration()->save($validatedConfig);

            // attach all the tags passed from the request.
            foreach ($request->get('tags') as $tagName) {
                $listing->tags()->attach(Tag::where('name', $tagName)->first());
            }
        }, 5);

        // return a response and a redirect link to next page.
        return response()->json(['success' => true, 'redirect' => route('listing.index')]);
    }

    /**
     * Display the specified resource.
     *
     * Only the string is passed as we use VUE JSON.
     *
     * @param string $listing
     * @return Response
     */
    public function show(string $listing)
    {
        return view('listing.profile')->with([
            'slug' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
