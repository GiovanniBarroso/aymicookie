<?php

namespace Laravel\Fortify\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Maneja la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isStateful($request)) {
            Config::set('session.driver', config('fortify.session', 'cookie'));
        }

        return $next($request);
    }

    /**
     * Determina si la solicitud debe ser tratada como stateful.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isStateful(Request $request)
    {
        $domains = config('sanctum.stateful', []);

        return collect($domains)->contains(function ($domain) use ($request) {
            return str_ends_with($request->header('origin') ?? '', $domain) ||
                str_ends_with($request->header('referer') ?? '', $domain);
        });
    }
}
