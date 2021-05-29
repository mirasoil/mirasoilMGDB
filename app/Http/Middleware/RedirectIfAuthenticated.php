<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null) {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return response("Admin can't perform this action.", 401);
        }
        if ($guard == "user" && Auth::guard($guard)->check()) {
            return redirect('/ro/user')->with('forbiddenmsg', 'Acces interzis utilizatorilor!');
            // return response('Unauthorized.', 401);
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
