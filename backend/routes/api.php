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
    Route::post('/login', [AuthController::class, 'login']); // User login (role_id = 3)
    Route::post('/admin/login', [AuthController::class, 'loginAdmin']); // Admin login (role_id = 1)
    Route::post('/hotel-manager/login', [AuthController::class, 'loginHotelManager']); // Hotel Manager login (role_id = 2)
});

// Protected routes (cần authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    // Admin only routes
    Route::middleware('ability:admin')->prefix('admin')->group(function () {
        // Thêm các routes chỉ admin mới truy cập được
        // Route::get('/users', [AdminController::class, 'getAllUsers']);
        // Route::get('/hotels', [AdminController::class, 'getAllHotels']);
        // Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
        // Route::get('/dashboard', [AdminController::class, 'getDashboard']);
    });

    // Hotel Manager only routes
    Route::middleware('ability:hotel-manager')->prefix('hotel-manager')->group(function () {
        // Thêm các routes chỉ hotel manager mới truy cập được
        // Route::get('/hotel', [HotelManagerController::class, 'getMyHotel']);
        // Route::put('/hotel', [HotelManagerController::class, 'updateHotel']);
        // Route::get('/bookings', [HotelManagerController::class, 'getBookings']);
        // Route::get('/rooms', [HotelManagerController::class, 'getRooms']);
    });

    // User routes (accessible by all authenticated users)
    // Route::get('/hotels', [HotelController::class, 'index']);
    // Route::post('/bookings', [BookingController::class, 'store']);
    // Route::get('/my-bookings', [BookingController::class, 'myBookings']);

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
