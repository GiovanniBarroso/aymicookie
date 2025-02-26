<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->roles_id != $role) {
            return redirect('/shop')->with('error', 'No tienes permisos para acceder a esta página.');
        }
        return $next($request);
    }
}
