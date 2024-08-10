<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            // 'auth.user' => \App\Http\Middleware\UserAuth::class,
            // 'auth.admin' => \App\Http\Middleware\AdminAuth::class,
            // 'redirect_if_authenticated' => \App\Http\Middleware\Admin\AdminRedirectToLogin::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();