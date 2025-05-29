<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);
        Route::resource('users', UserController::class);

        Route::post('/coupons/{id}/toggle-status', [CouponController::class, 'toggleStatus']);
        Route::resource('coupons', CouponController::class);
        

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
