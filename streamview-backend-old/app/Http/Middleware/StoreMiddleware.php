<?php

namespace App\Http\Middleware;

use Closure;

class StoreMiddleware
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
        if ($request->user() && $request->user()->role != STORE) {

            return new Response(view('unauthorized')->with('role', STORE));
        }

        return $next($request);
    }
}
