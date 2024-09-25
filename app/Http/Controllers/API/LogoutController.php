<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
