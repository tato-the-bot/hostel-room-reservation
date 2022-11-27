<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class EnsureUserHasRole
{
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->role != $role) {
            return redirect('/');
        }
 
        return $next($request);
    }
}
