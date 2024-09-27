<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
           'order_products' => (OrderItemResource::collection($this->whenLoaded('orderItems'))),
           'user' => (new UserResource($this->whenLoaded('user'))),
           'order_total_amount' => $this->total_amount
       ];
    }
}
