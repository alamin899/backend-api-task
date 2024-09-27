<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'product_name' => $this->name??'',
            'product_slug' => $this->slug??'',
            'product_price' => (float) $this->price??0,
            'product_stock' => (int) $this->stock??0,
        ];
    }
}
