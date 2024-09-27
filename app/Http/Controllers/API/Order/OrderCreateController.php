<?php

namespace App\Http\Controllers\API\Order;

use App\Features\Product\ProductCreateFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

class OrderCreateController extends Controller
{
    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        $response = (new ProductCreateFeature(orderProducts: $request->validated()))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
