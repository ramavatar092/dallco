<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard'); // your admin dashboard view
        });
    });
});
