<?php

namespace App\Http\Controllers\API\Order;

use App\Features\Order\OrderCreateFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

class OrderCreateController extends Controller
{
    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        $response = (new OrderCreateFeature(user: auth('api')->user(),orderProducts: $request->validated()))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
