<?php

namespace App\Http\Controllers;

use App\Server;
use App\ServerConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class FilterController
 *
 * @package App\Http\Controllers
 */
class FilterController extends Controller
{
    // define the count of cards per page.
    const cardCount = 25;

    // the location of the blade the controller will use.
    const bladeView = 'filters';

    /**
     * The default index page of server listings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->votes(30);
    }

    /**
     * Display the votes of a period of time for a server.
     *
     * @param int $periodDays
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function votes(int $periodDays)
    {
        return view(self::bladeView)->with('servers', Server::filterVotes($periodDays, 'desc')->paginate(self::cardCount));
    }

    /**
     * Display the clicks of a period of time for a server.
     *
     * @param int $periodDays
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clicks(int $periodDays)
    {
        return view(self::bladeView)->with('servers', Server::filterClicks($periodDays, 'desc')->paginate(self::cardCount));
    }

    /**
     * Display the creation date in an order.
     *
     * @param string $orderBy
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function creation(string $orderBy)
    {
        return view(self::bladeView)->with('servers', Server::orderedCreation(30, $orderBy)->paginate(self::cardCount));
    }

    /**
     * Display the episode version in an order.
     *
     * @param string $orderBy
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function episode(string $orderBy)
    {
        return view(self::bladeView)->with('servers', Server::orderedEpisode(30, $orderBy)->paginate(self::cardCount));
    }

    /**
     * @param string $exp_group
     * @param string $orderBy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function expGroup(string $exp_group, string $orderBy)
    {
        return view(self::bladeView)->with('servers', Server::filterExpGroup($exp_group, 30, $orderBy)->paginate(self::cardCount));
    }
}
