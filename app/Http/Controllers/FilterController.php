<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterController
 *
 * @package App\Http\Controllers
 */
class FilterController extends Controller
{

    /**
     * @var \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private $view;

    /**
     * FilterController constructor.
     */
    public function __construct()
    {
        $this->view = view('filters');
    }

    /**
     * The build method returns a result for the page.
     *
     * @param Builder $builder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function build(Builder $builder)
    {
        return $this->view->with('servers', $builder->paginate(25));
    }

    /**
     * The default index page of server listings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        return $this->build(Server::filter(30, 'all', 'all', 'votes_count', 'desc'));

    }

    /**
     * Advanced Query Route Filtering Method.
     *
     * @param string $exp_group
     * @param string $mode
     * @param string $sort
     * @param string $orderBy
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Exception
     */
    public function query($exp_group = "all", $mode = "all", $sort = "any", $orderBy = 'desc')
    {
        return $this->build(Server::filter(30, $exp_group, $mode, $sort, $orderBy));
    }
}
