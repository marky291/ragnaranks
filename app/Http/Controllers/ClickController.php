<?php

namespace App\Http\Controllers;

use App\Interactions\Click;
use App\Listings\Listing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ClickController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Listing $listing)
    {
        if (Click::hasNotInteractedWith(1))
        {
            $listing->clicks()->save(new Click());
        }

        return redirect()->away($listing->website);
    }
}
