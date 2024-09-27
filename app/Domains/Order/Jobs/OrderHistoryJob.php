<?php

namespace App\Domains\Order\Jobs;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

readonly class OrderHistoryJob
{
    public function __construct(private User $user)
    {
    }

    public function handle(): Collection
    {
        return Order::query()
            ->with(['user:id,name,email,user_type','orderItems:id,order_id,product_id,quantity,price','orderItems.product'])
            ->where('user_id', $this->user->id)
            ->get();
    }

}
