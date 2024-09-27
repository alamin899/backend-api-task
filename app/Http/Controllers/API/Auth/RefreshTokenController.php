<?php

namespace App\Http\Controllers\API\Auth;

use App\Features\Auth\RefreshTokenFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;

class RefreshTokenController extends Controller
{
    public function __invoke()
    {
        $response = (new RefreshTokenFeature())->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );    }
}
