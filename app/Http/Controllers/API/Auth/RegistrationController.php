<?php

namespace App\Http\Controllers\API\Auth;

use App\Features\Auth\RegistrationFeature;
use App\Helpers\JsonResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function __invoke(RegistrationRequest $request): JsonResponse
    {
        $response = (new RegistrationFeature(name: $request->input('name'),email: $request->input('email'),password: $request->input('password')))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? 200,
        );

    }

}
