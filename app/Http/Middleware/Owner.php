<?php

namespace App\Http\Middleware;

use Closure;

class Owner
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
        // Owner:: magdymostafa726@gmail.com
        if(strtolower( auth()->user()->email)=="magdymostafa726@gmail.com"){
            return $next($request);
        }
        return abort(404);

    }
}
