<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\RefreshTokenController;
use App\Http\Controllers\API\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->middleware('api')->group(function () {
    Route::post('registration', RegistrationController::class);
    Route::post('login', LoginController::class);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('refresh-token', RefreshTokenController::class);
        Route::get('test', function (){
            return response()->json(["customer"=>auth()->user(),"payload"=>auth()->payload()]);
        });
    });
});
