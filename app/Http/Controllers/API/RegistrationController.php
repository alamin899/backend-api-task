<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function __invoke(RegistrationRequest $request)
    {
        // TODO: Implement __invoke() method.
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
