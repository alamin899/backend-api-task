<?php

use App\Helpers\JsonResponder;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (ValidationException $exception) {
            return JsonResponder::response(message: 'Validation Failed', errors: $exception->errors(), statusCode: Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $exceptions->render(function (NotFoundHttpException $exception) {
            return JsonResponder::response(message: 'Route Not Found', statusCode: Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (MethodNotAllowedHttpException $exception) {
            return JsonResponder::response(message: $exception->getMessage(), statusCode: Response::HTTP_METHOD_NOT_ALLOWED);
        });
        $exceptions->render(function (ModelNotFoundException $exception) {
            return JsonResponder::response(message: 'The resource is not found', statusCode: Response::HTTP_NOT_FOUND);
        });
        $exceptions->render(function (UnauthorizedException $exception) {
            return JsonResponder::response(message: $exception->getMessage(), statusCode: Response::HTTP_FORBIDDEN);
        });
        $exceptions->render(function (AuthenticationException $exception) {
           return JsonResponder::response(message: 'Unauthenticated', errors: ['auth' => ['Unauthenticated request']], statusCode: Response::HTTP_UNAUTHORIZED);
        });

        $exceptions->render(function (Exceptions $exception)  {
        return JsonResponder::response(message: "Something went wrong", errors: ['message' => ["Something went wrong"]], statusCode: Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    })
->create();
