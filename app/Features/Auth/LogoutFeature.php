<?php

namespace App\Features\Auth;

use Symfony\Component\HttpFoundation\Response;

class LogoutFeature
{
    public function __construct()
    {
    }

    public function handle(): array
    {
        auth('api')->logout();
        return [
            'message' => 'Successfully logged out.',
            'data' => [
                'access_token' => "",
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }
}
