<?php

namespace App\Domains\Order\Operations;

use App\Domains\Product\Jobs\ProductsBySlugsJob;
use App\Models\User;

readonly class PrepareOrderOperation
{
    public function __construct(
        private User  $user,
        private array $orderProducts,
    )
    {
        //
    }

    /**
     * Execute the operation.
     */
    public function handle(): array
    {
        $orderProducts = [];
        $productSlugs = [];
        foreach ($this->orderProducts as $orderProduct) {
            $product = $orderProduct['product'];
            $productSlugs[] = $product;
            $orderProducts[$product] = [
                'product' => $product,
                'quantity' => isset($orderProducts[$product]) ? $orderProduct['quantity'] + $orderProducts[$product]['quantity'] : $orderProduct['quantity'],
            ];
        }

        $totalOrderAmount = 0;
        $orderProductData = [];
        (new ProductsBySlugsJob($productSlugs))->handle()
            ->each(function ($product) use (&$orderProductData, &$totalOrderAmount, $orderProducts) {
                $quantity = $orderProducts[$product->slug]['quantity'];
                $price = $product->price * $orderProducts[$product->slug]['quantity'];
                $orderProductData[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price
                ];
                $totalOrderAmount += $price;
            });

        $orderData = [
            'user_id' => $this->user->id,
            'total_amount' => $totalOrderAmount,
        ];

        return [
            'orderData' => $orderData,
            'orderProducts' => $orderProductData,
        ];
    }
}
