<?php

namespace App\Http\Controllers;

use App\Listings\Listing;
use App\Interactions\Click;
use Illuminate\Http\RedirectResponse;

class ClickController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     *
     * @return RedirectResponse
     */
    public function store(Listing $listing)
    {
        $spread = config('interaction.click.spread');

        if (! $listing->clicks()->hasClientInteractedWith($spread)) {
            $listing->clicks()->save(new Click());
        }

        return redirect()->away($listing->website);
    }
}
