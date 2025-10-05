<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RateController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [VerificationController::class, 'verifyEmail']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::post('/calculate-rate', [RateController::class, 'calculate']);
    Route::post('/face-id', [VerificationController::class, 'toggleFaceId']);
});