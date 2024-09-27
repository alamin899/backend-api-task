<?php

namespace App\Domains\Product\Jobs;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

readonly class ProductsBySlugsJob
{
    public function __construct(private array $productSlugs = [])
    {
    }

    public function handle(): Collection
    {
        return Product::query()
            ->whereIn('slug', $this->productSlugs)
            ->get();
    }

}
