<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PayoutController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [LoginController::class, 'login']);
});

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('users/update/stauts', [UserController::class, 'updateStatus'])->name('users.updateStatus');
        Route::resource('users', UserController::class);

        Route::post('/coupons/import', [CouponController::class, 'import'])->name('coupons.import');
        Route::post('/coupons/import/cancel', [CouponController::class, 'bulkImport'])->name('coupons.cancel');
        Route::post('coupons/update/stauts', [CouponController::class, 'updateStatus'])->name('coupons.updateStatus');
        Route::resource('coupons', CouponController::class);

        Route::get('payouts', [PayoutController::class, 'index'])->name('payouts');
        Route::get('previous-payouts', [PayoutController::class, 'paidPayoutList'])->name('previous.payouts');
        Route::post('/payouts-update', [PayoutController::class, 'update'])->name('payouts.update');
        

        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
