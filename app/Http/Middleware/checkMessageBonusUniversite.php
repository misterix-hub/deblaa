<?php

namespace App\Http\Middleware;

use Closure;

class checkMessageBonusUniversite
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
        if(session()->get('message_bonus') == 0) {
            return redirect()->route('indexUniversite');
        }
        return $next($request);
    }
}
