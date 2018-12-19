<?php

namespace App\Http\Controllers;

use App\Listing;
use Illuminate\Http\Request;

/**
 * Class ServerController
 *
 * @package App\Http\Controllers
 */
class ServerController extends Controller
{
    /**
     * The default index page of server listings.
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $builder = Listing::filter('all', 'all', 'rank', 'asc');

        return view('server.index')->with('servers', $builder->simplePaginate(7));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Listing  $server
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $server)
    {
        return view('server.show', ['server' => $server]);
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
