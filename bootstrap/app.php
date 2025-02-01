<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Console\Commands\SendEmail;
use App\Exceptions\CustomException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )->withCommands([
        SendEmail::class,
    ])
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            // 'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json([
                'message' => 'Method is not true'
            ], 405);
        });  
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        });
        
    })->create();
    
     
    