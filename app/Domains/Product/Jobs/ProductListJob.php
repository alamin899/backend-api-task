<?php

namespace App\Domains\Product\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class ProductListJob
{
    public function __construct(private int $perPage = 10)
    {
    }

    public function handle(): LengthAwarePaginator
    {
        return Product::query()->paginate($this->perPage);
    }

}
