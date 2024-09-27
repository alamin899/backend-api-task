<?php

namespace App\Features\Product;

use App\Domains\Product\Jobs\ProductUpdateJob;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

readonly class ProductUpdateFeature
{
    public function __construct(
        private Product $product,
        private array $attributes=[],
    )
    {
    }

    public function handle(): array
    {
        (new ProductUpdateJob(product: $this->product,attributes: $this->attributes))->handle();

        return [
            'message' => 'Product successfully updated',
            'data' => [
                'product' => new ProductResource($this->product->refresh()),
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }

}
