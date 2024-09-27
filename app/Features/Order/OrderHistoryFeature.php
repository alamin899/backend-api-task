<?php

namespace App\Features\Order;

use App\Domains\Order\OrderHistoryJob;
use App\Http\Resources\OrderResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

readonly class OrderHistoryFeature
{
    public function __construct(private User $user)
    {
    }

    public function handle(): array
    {
        $orderHistory = (new OrderHistoryJob(user: $this->user))->handle();

        return [
            'message' => 'Success',
            'data' => [
                'orders' => OrderResource::collection($orderHistory),
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }

}
