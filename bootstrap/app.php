<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Mendefinisikan middleware alias dalam array
        $middleware->alias([
            'pendaftar' => \App\Http\Middleware\PendaftarMiddleware::class,
            'pendaftar.guest' => \App\Http\Middleware\RedirectIfAuthenticatedPendaftar::class,
            'auth.operator' => \App\Http\Middleware\OperatorAuth::class,
            'guest.operator' => \App\Http\Middleware\RedirectIfAuthenticatedOperator::class,
            'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();