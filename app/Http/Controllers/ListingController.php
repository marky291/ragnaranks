<?php

namespace App\Http\Controllers;

use App\Emulator\DivineCrawler;
use App\Emulator\DivinePrideItemCollection;
use App\Emulator\Items\ItemLookup;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Listings\Listing;
use App\Listings\ListingRanking;
use App\Listings\ListingScreenshot;
use App\Listings\ReconditionListingSpace;
use Illuminate\Auth\Access\AuthorizationException;
use App\Jobs\AssignRoleToUser;
use App\Listings\ListingLanguage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Listings\ListingConfiguration;
use App\Http\Requests\StoreListingRequest;
use Symfony\Component\Console\Helper\ProgressBar;

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
     * Display the specified resource.
     *
     * Only the string is passed as we use VUE JSON.
     *
     * @param Listing $listing
     * @return View
     */
    public function show(Listing $listing): View
    {
        return view('listing.show')->with([
            'listing' => $listing,
            'breakdown' => json_encode($listing->reviews->countPercentScores())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Listing $listing
     * @return View
     * @throws AuthorizationException
     */
    public function create(Listing $listing) : View
    {
        $this->authorize('create', $listing);

        $listing = (new Listing)
            ->setRelation('configuration', new ListingConfiguration)
            ->setRelation('ranking', new ListingRanking);

        return view('listing.show', ['listing' => $listing]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreListingRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function store(StoreListingRequest $request)
    {
        $this->authorize('create', new Listing);

        DB::transaction(static function () use ($request) {

            /** @var Listing $listing */
            // Create the listing.
            $listing = user()->listings()->save(Listing::make($request->validated()));

            // grab the configuration that has been validated and assign to the model.
            $validatedConfig = ListingConfiguration::make($request->validated()['config']);

            // save all the screenshots
            $screenshotModels = collect($request->get('screenshots'))->map(static function($screenshot) {
                return new ListingScreenshot(['link' => $screenshot]);
            });

            // save all the new screenshots to the model/
           $listing->screenshots()->saveMany($screenshotModels);

            // save the configurations to the listing.
            $listing->configuration()->save($validatedConfig);

            // attach all the tags passed from the request.
            $listing->tags()->attach(Tag::query()->select('id')->whereIn('name', $request->get('tags'))->pluck('id'));

            // update temporary files for permanent storage.
            ReconditionListingSpace::dispatch($listing);

        }, 5);

        // set the user to a creator role.
        AssignRoleToUser::dispatch(auth()->user(), 'creator');

        // return a response and a redirect link to next page.
        return response()->json(['success' => true, 'redirect' => route('listing.index')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreListingRequest $request
     * @param Listing $listing
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(StoreListingRequest $request, Listing $listing): JsonResponse
    {
        $this->authorize('update', $listing);

        DB::transaction(static function () use ($request, $listing) {
            $listing->fill($request->validated())->save();

            // store the configuration.
            $listing->configuration->fill($request->validated()['config'])->save();

            // make a model for each screenshot from the request.
            $screenshotModels = collect($request->get('screenshots'))->map(static function($screenshot) {
                return new ListingScreenshot(['link' => $screenshot]);
            });

            // remove all screenshots to make way for the current request items.
            $listing->screenshots()->delete();

            // store all the screenshots as models.
            $listing->screenshots()->saveMany($screenshotModels);

            // sync all the tags that are used on the listing, removing those that no longer exist.
            $listing->tags()->sync(Tag::query()->select('id')->whereIn('name', $request->get('tags'))->pluck('id'));

            //  associate a language to the listing.
            $listing->language()->associate(ListingLanguage::query()->where('name', $request->get('language'))->first())->save();

            // update temporary files for permanent storage.
            ReconditionListingSpace::dispatch($listing);

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
        $this->authorize('delete', $listing);

        $listing->delete();

        return response()->json(['success' => true, 'redirect' => route('listing.index')]);
    }
}
