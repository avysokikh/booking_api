<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/rooms', [RoomController::class, 'index']);

// Auth routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/bookings', [BookingController::class, 'store']);
}); 