<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['admin' => \App\Http\Middleware\admin::class]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['employee' => \App\Http\Middleware\pegawai::class]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['noback' => \App\Http\Middleware\noBack::class]);
    })->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/testingAPI123',
        ]);
    })->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['verifypls' => \App\Http\Middleware\verifypls::class]);
    })->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['edited' => \App\Http\Middleware\editedLogout::class]);
    })->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['greateradmin' => \App\Http\Middleware\rootadmin::class]);
    })->withMiddleware(function (Middleware $middleware) {
        $cfCidrs = [
            '103.21.244.0/22',
            '103.22.200.0/22',
            '103.31.4.0/22',
            '104.16.0.0/13',
            '104.24.0.0/14',
            '108.162.192.0/18',
            '131.0.72.0/22',
            '141.101.64.0/18',
            '162.158.0.0/15',
            '172.64.0.0/13',
            '173.245.48.0/20',
            '188.114.96.0/20',
            '190.93.240.0/20',
            '197.234.240.0/22',
            '198.41.128.0/17',
        ];

        $middleware->trustProxies(
            at: $cfCidrs,
            headers: Request::HEADER_X_FORWARDED_FOR
                | Request::HEADER_X_FORWARDED_HOST
                | Request::HEADER_X_FORWARDED_PORT
                | Request::HEADER_X_FORWARDED_PROTO
        );
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
