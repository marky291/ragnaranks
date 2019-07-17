<?php

namespace App\Http\Controllers;

use App\Jobs\RoleAssignment;
use App\Listings\Listing;
use App\Interactions\Click;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClickController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Listing $listing
     *
     * @return JsonResponse
     */
    public function store(Listing $listing): JsonResponse
    {
        if ($listing->clicks()->hasInteractedDuring(config('action.click.spread')) === false) {
            $listing->clicks()->create(['ip_address' => request()->getClientIp()]);

            return response()->json([
                'success' => true
            ]);
        }


        return response()->json([
            'success' => false,
            'message' => 'Click already concluded within '. config('action.click.spread'.' hours')
        ]);
    }
}
