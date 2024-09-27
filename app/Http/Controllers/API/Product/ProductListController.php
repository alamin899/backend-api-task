<?php

namespace App\Http\Controllers\API\Product;

use App\Features\Product\ProductListFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ProductListController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $response = (new ProductListFeature())->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
