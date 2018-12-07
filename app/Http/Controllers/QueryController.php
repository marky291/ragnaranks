<?php

namespace App\Http\Controllers;

use App\Server;

/**
 * Class QueryController
 *
 * @package App\Http\Controllers
 */
class QueryController extends Controller
{
    /**
     * Form Controller search as part of our "Im Looking for" selects.
     *
     * @param string $exp_group
     * @param string $mode
     * @param string $sort
     * @param string $orderBy
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($exp_group = "all", $mode = "all", $sort = "any", $orderBy = 'desc')
    {
        $builder = Server::filter($exp_group, $mode, $sort, $orderBy);

        return view('server.index')->with('servers', $builder->simplePaginate(7));

    }
}
