<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessLevel1Middleware
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
        if (Auth::user() && $request->user()->access_level != 1)
        {
            abort(401);
        }
        elseif(Auth::guest())
        {
            abort(401);
        }
        return $next($request);
    }
}
