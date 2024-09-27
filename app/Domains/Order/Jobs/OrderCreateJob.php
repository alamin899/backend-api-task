<?php

namespace App\Domains\Order\Jobs;

use App\Models\Order;

readonly class OrderCreateJob
{
    public function __construct(
        private string $user_id,
        private float $total_amount=0,
    )
    {
    }

    public function handle()
    {
        return Order::query()->create([
            'user_id' => $this->user_id,
            'total_amount' => $this->total_amount,
        ]);
    }

}
