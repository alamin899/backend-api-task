<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => (new ProductResource($this->whenLoaded('product'))),
            'quantity' => $this->quantity,
            'total_amount' => $this->price,
        ];
    }
}
