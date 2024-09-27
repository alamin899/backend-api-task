<?php

namespace App\Domains\Order;

use App\Models\Product;

readonly class OrderCreateJob
{
    public function __construct(
        private string $name,
        private string $slug,
        private float $price,
        private int $stock,
    )
    {
    }

    public function handle()
    {
        return Product::query()->create([
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);
    }

}
