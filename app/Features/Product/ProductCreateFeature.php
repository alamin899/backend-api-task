<?php

namespace App\Features\Product;

use App\Domains\Product\Jobs\ProductCreateJob;
use App\Http\Resources\ProductResource;
use Symfony\Component\HttpFoundation\Response;

readonly class ProductCreateFeature
{
    public function __construct(
        private string $name,
        private string $slug,
        private float $price,
        private int $stock,
    )
    {
    }

    public function handle(): array
    {
        $product= (new ProductCreateJob(name: $this->name,slug: $this->slug,price: $this->price,stock: $this->stock))->handle();

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
