<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [];

    /**
     * The IP addresses that are exempt from the maintenance mode.
     *
     * @var array
     */
    protected $exemptIP = [
        '213.202.145.165',
        '45.56.25.157',
        '179.222.187.62',
        '45.111.152.58',
        '85.115.14.194',
        '136.36.6.130',
    ];

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (IpUtils::checkIp($request->ip(), $this->exemptIP)) {
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
