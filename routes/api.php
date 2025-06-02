<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CouponScanController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    Route::post('/scan', [CouponScanController::class, 'store']);
    Route::get('/scan-history', [CouponScanController::class, 'getScanHistory']);
    Route::get('/details', [UserController::class, 'index']);
    Route::post('/bank-details', [UserController::class, 'updateBankDetails']);
});
