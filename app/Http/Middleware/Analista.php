<?php

namespace App\Http\Middleware;

use Closure;

class Analista
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
        //return $next($request);
        if ($request->user()->rol_id == 2) {
            return $next($request);
        }

		return abort(403);
    }
}
