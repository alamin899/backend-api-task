<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => ['string', 'required', 'min:1', 'max:100'],
            'email' => ['string', 'email:dns,rfc', 'required', 'min:10', 'max:100', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:100'],
        ];
    }
}
