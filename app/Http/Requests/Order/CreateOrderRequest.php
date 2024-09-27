<?php

namespace App\Http\Requests\Order;

use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.product' => ['required', 'string', 'exists:products,slug'],
            '*.quantity' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[0];
                    $productSlug = $this->input($index . '.product');
                    $product = Product::query()->where('slug', $productSlug)->first(['id', 'stock', 'stock']);
                    if ($product && $value > $product->stock) {
                        $fail("The quantity for {$product->slug} exceeds available stock of {$product->stock}.");
                    }
                }
            ]
        ];
    }
}
