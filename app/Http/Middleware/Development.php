<?php

namespace App\Http\Middleware;

use Closure;

class Development
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('production')) {
            return redirect('index');
        }

        return $next($request);
    }
}
