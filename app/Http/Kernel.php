<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Middleware\ValidatePostSize;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use App\Http\Middleware\RedirectIfAuthenticated;
use \App\Http\Middleware\RoleMiddleware;

class Kernel extends HttpKernel
{
    /**
     * Middleware global para todas las solicitudes.
     */
    protected $middleware = [
        TrustProxies::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        EncryptCookies::class, // 🔹 Asegurar que las cookies se encripten
        AddQueuedCookiesToResponse::class, // 🔹 Manejar cookies antes de la sesión
        StartSession::class, // 🔥 Asegurar que la sesión se inicie globalmente
    ];

    /**
     * Middleware de grupo.
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware de rutas.
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'role' => RoleMiddleware::class,
        'bindings' => SubstituteBindings::class,
        'throttle' => ThrottleRequests::class,
        'signed' => ValidateSignature::class,
        'guest' => RedirectIfAuthenticated::class,
    ];
}
