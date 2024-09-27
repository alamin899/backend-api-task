<?php

namespace App\Http\Controllers\API\Order;

use App\Features\Order\OrderHistoryFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class OrderHistoryController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $response = (new OrderHistoryFeature(user: auth('api')->user()))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
