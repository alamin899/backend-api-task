<?php

namespace App\Http\Controllers\API\Auth;

use App\Features\Auth\LogoutFeature;
use App\Features\Auth\RefreshTokenFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $response = (new LogoutFeature())->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );    }
}
