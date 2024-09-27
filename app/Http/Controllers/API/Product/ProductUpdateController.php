<?php

namespace App\Http\Controllers\API\Product;

use App\Features\Product\ProductUpdateFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductUpdateController extends Controller
{
    public function __invoke(UpdateProductRequest $request,Product $product): JsonResponse
    {
        $response = (new ProductUpdateFeature(product:$product,attributes:$request->validated()))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
