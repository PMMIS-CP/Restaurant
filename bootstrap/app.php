<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\OptimizeResponse\AddCacheHeaders;
use App\Http\Middleware\OptimizeResponse\AddSecurityHeaders;
use App\Http\Middleware\OptimizeResponse\OptimizeHtml;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\Admin\AdminAuth;
use App\Http\Middleware\Admin\AdminGuest;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            SetLocale::class,
            AddCacheHeaders::class,
            AddSecurityHeaders::class,
            OptimizeHtml::class,
        ]);

        // Middleware aliases
        $middleware->alias([
            'admin.auth'  => AdminAuth::class,
            'admin.guest' => AdminGuest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();