<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use Illuminate\View\View;
use App\Jobs\RoleAssignment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return view('listing.profile')->with([
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
}
