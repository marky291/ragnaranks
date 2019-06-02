<?php

namespace App\Http\Controllers;

use App\Listings\ListingLanguage;
use App\Tag;
use App\Listings\Listing;
use App\Jobs\RoleAssignment;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listing.index')->with([
            'listings' => app('listings')->take(7),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listing.form')->with(['tags' => Tag::all(), 'languages' => ListingLanguage::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RoleAssignment::dispatch(auth()->user(), 'creator');

        dd('requires implementation');
    }

    /**
     * Display the specified resource.
     *
     * @param Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listing.show')->with('listing', $listing->load(['reviews', 'reviews.comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
