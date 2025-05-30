<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/newuser', [UserController::class, 'registerUser']); // Use POST for registration

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
