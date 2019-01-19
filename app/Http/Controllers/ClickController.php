<?php

namespace App\Http\Controllers;

use App\Interactions\Click;
use App\Listings\Listing;
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
        if ($this->authorize('click', $listing))
        {
            $listing->clicks()->save(new Click());
        }

        redirect($listing->website);
    }
}
