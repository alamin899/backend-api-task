<?php

namespace App\Http\Controllers\API\Product;

use App\Features\Product\ProductCreateFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ProductCreateController extends Controller
{
    public function __invoke(CreateProductRequest $request): JsonResponse
    {
        $response = (new ProductCreateFeature(name: $request->input('name'), slug: Str::slug($request->input('slug')), price:$request->input('price','0'), stock: $request->input('stock','0')))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );
    }
}
