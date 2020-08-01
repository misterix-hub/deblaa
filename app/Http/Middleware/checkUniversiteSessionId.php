<?php

namespace App\Http\Middleware;

use Closure;

class checkUniversiteSessionId
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
        if (!session()->has('id')) {
            return redirect()->route('uLogin');
        }
        return $next($request);
    }
}
