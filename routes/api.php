<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RefreshTokenController;
use App\Http\Controllers\API\Auth\RegistrationController;
use App\Http\Controllers\API\Product\ProductCreateController;
use App\Http\Controllers\API\Product\ProductListController;
use App\Http\Controllers\API\Product\ProductUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->middleware('api')->group(function () {
    Route::post('registration', RegistrationController::class);
    Route::post('login', LoginController::class);

    Route::prefix('/products')->group(function () {
        Route::get('/', ProductListController::class);
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::post('refresh-token', RefreshTokenController::class);
        Route::post('logout', LogoutController::class);

        Route::prefix('/products')->middleware('isadmin')->group(function () {
            Route::post('/create', ProductCreateController::class);
            Route::put('/{product:slug}/update', ProductUpdateController::class);
        });
    });
});
