<?php

namespace App\Http\Middleware;

use Closure;
use Flash;
use Illuminate\Support\Facades\Auth;

class checkSuperAdmin
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
        if(Auth::guest()) {
            return redirect(route('login'));
        } else {
            if (Auth::user()->role_id !=1) {
                Flash::error('Vous n\'êtes pas autorisé à effectuer cette action');
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
