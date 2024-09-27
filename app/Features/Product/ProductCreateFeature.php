<?php

namespace App\Features\Product;

use App\Domains\Product\Jobs\ProductCreateJob;
use App\Http\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;

readonly class ProductCreateFeature
{
    public function __construct(
        private array $orderProducts,
    )
    {
    }

    public function handle(): array
    {


        return [
            'message' => 'Product created successfully',
            'data' => [
                'product' => new ProductResource($product),
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_CREATED,
        ];
    }

}
