<?php

namespace App\Domains\Product\Jobs;

use App\Models\Product;
readonly class ProductUpdateJob
{
    public function __construct(
        private Product $product,
        private array $attributes=[],
    )
    {
    }

    public function handle(): int
    {
        return $this->product->query()->update($this->attributes);
    }

}
