<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Listings\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Jobs\AssignRoleToUser;
use App\Listings\ListingLanguage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Listings\ListingConfiguration;
use App\Http\Requests\StoreListingRequest;

/**
 * Class ListingController.
 */
class ListingController extends Controller
{
    /**
     * ListingController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show']);

        $this->authorizeResource(Listing::class, 'listing');
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
        return view('listing.profile')->with(['slug' => 'defaults']);
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
            $listing->tags()->attach(Tag::query()->select('id')->whereIn('name', $request->get('tags'))->pluck('id'));
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
    public function show(Listing $listing)
    {
        return view('listing.profile')->with(['slug' => $listing->slug]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreListingRequest $request
     * @param Listing $listing
     * @return JsonResponse
     */
    public function update(StoreListingRequest $request, Listing $listing): JsonResponse
    {
        DB::transaction(static function () use ($request, $listing) {
            $listing->fill($request->validated())->save();

            $listing->configuration->fill($request->validated()['config'])->save();

            $listing->tags()->sync(Tag::query()->select('id')->whereIn('name', $request->get('tags'))->pluck('id'));

            $listing->language()->associate(ListingLanguage::query()->where('name', $request->get('language'))->first())->save();
        }, 5);

        // should we tell the client to redirect/reload
        $redirect = '';

        // redirect to new slug if that was changed.
        if ($request->get('name') === $listing->getAttribute('name')) {
            $redirect = route('listing.show', $listing);
        }

        // otherwise done.
        return response()->json(['success' => true, 'redirect' => $redirect]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Listing $listing
     * @return void
     * @throws \Exception
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return response()->json(['success' => true, 'redirect' => route('listing.index')]);
    }
}
