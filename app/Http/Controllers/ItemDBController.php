<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class ItemDBController
 *
 * @package App\Http\Controllers
 */
class ItemDBController extends Controller
{
    /**
     * View the item DB
     */
    public function index()
    {
        return view('items.index');
    }

    /**
     * Scrape requests for data.
     *
     * @param Request $request
     */
    public function scraper(Request $request)
    {
        var_dump($request);
    }
}
