<?php

namespace App\Domains\Order\Jobs;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

readonly class OrderProductCreateJob
{
    public function __construct(
        private Order $order,
        private array $orderProduct,
    )
    {
    }

    public function handle(): Collection
    {
        return $this->order->orderItems()->createMany($this->orderProduct);
    }

}
