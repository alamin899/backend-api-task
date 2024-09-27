<?php

namespace App\Features\Auth;

use Symfony\Component\HttpFoundation\Response;

class RefreshTokenFeature
{
    public function __construct()
    {
    }

    public function handle(): array
    {
        $token = auth('api')->refresh();
        return [
            'message' => 'Refresh token generated',
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }
}
