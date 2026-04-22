<?php

namespace App\Http;

class Kernel extends \Illuminate\Foundation\Http\Kernel
{
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'admin'  => \App\Http\Middleware\AdminMiddleware::class,
        'user'   => \App\Http\Middleware\UserMiddleware::class,
    ];
}