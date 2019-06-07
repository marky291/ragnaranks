<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Listings\Listing;
use App\Jobs\RoleAssignment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * @return Response
     */
    public function index(Listing $listing)
    {
        return view('listing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Listing $listing
     * @return Response
     */
    public function create(Listing $listing): Response
    {
        return view('listing.form')->with([
            'listing' => $listing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        RoleAssignment::dispatch(auth()->user(), 'creator');

        dd('requires implementation');
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
        return view('listing.form')->with([
            'slug' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Form Controller search as part of our "Im Looking for" selects.
     *
     * @param string $serverType
     * @param string $serverMode
     * @param string $withTag
     * @param string $sortByAttribute
     * @param int $paginate
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function filters($serverType = 'all', $serverMode = 'all', $withTag = 'all', $sortByAttribute = 'any', $paginate = 25)
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

        return ListingResource::collection($listings->take($paginate));
    }
}
