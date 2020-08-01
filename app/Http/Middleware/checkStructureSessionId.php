<?php

namespace App\Http\Middleware;

use Closure;

class checkStructureSessionId
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
        if(!session()->has('id')) {
            return redirect()->route('sLogin');
        }
        return $next($request);
    }
}
