<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

// Public routes (không cần authentication)
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected routes (cần authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    // Các routes khác của ứng dụng sẽ được thêm vào đây
    // Route::apiResource('products', ProductController::class);
});

// Test route để kiểm tra API hoạt động
Route::get('/test', function () {
    return response()->json([
        'message' => 'API đang hoạt động',
        'timestamp' => now()
    ]);
});
