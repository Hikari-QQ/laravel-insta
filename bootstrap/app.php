<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        //appendToGroup - add middleware to an existing middleware group

        // 'web' グループに SetLocale ミドルウェアを追加
        // appendToGroup の代わりに web() メソッドを使っている場合もありますが、
        // ここでは append() を使って安全に追加します。
        $middleware->web(append: [SetLocale::class, ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
