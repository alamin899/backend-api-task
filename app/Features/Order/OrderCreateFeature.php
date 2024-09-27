<?php

namespace App\Features\Order;

use App\Domains\Order\Jobs\OrderCreateJob;
use App\Domains\Order\Jobs\OrderProductCreateJob;
use App\Domains\Order\Operations\PrepareOrderOperation;
use App\Domains\Product\Jobs\ProductCreateJob;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

readonly class OrderCreateFeature
{
    public function __construct(
        private User  $user,
        private array $orderProducts,
    )
    {
    }

    public function handle(): array
    {
        $orderProductsData = (new PrepareOrderOperation(user: $this->user, orderProducts: $this->orderProducts))->handle();

        try {
            DB::beginTransaction();

            $order = (new OrderCreateJob(user_id: $orderProductsData['orderData']['user_id'],total_amount: $orderProductsData['orderData']['total_amount']))->handle();
            (new OrderProductCreateJob(order: $order, orderProduct: $orderProductsData['orderProducts']))->handle();
            DB::commit();

            return [
                'message' => 'Order created successfully',
                'data' => [
                    'order' => new OrderResource($order->load(['user:id,name,email,user_type', 'orderItems:id,order_id,product_id,quantity,price', 'orderItems.product'])),
                ],
                'errors' => [],
                'statusCode' => Response::HTTP_CREATED,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'message' => 'Failed to create the order',
                'data' => [],
                'errors' => [$e->getMessage()],
                'statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }

}
