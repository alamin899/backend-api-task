<?php

namespace App\Features\Product;

use App\Data\Enums\CacheKey;
use App\Domains\Product\Jobs\ProductListJob;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

readonly class ProductListFeature
{
    public function __construct(private int $perPage = 10)
    {
    }

    public function handle(): array
    {
        $products = Cache::tags(CacheKey::PRODUCT_LIST_TAG->value)
            ->remember(CacheKey::PRODUCT_LIST->value . '_page_' . (Request::get('page', 1)), 60 * 60 * 12, function () {
                return (new ProductListJob(perPage: $this->perPage))->handle();
            });
        return [
            'message' => 'Success',
            'data' => [
                'products' => ProductResource::collection($products),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'total_items' => $products->total(),
                    'per_page' => $products->perPage(),
                    'total_pages' => $products->lastPage(),
                    'next_page_url' => $products->nextPageUrl(),
                    'previous_page_url' => $products->previousPageUrl(),
                ]
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }

}
