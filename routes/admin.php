<?php

use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {

    // Routes for guests (not logged in)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AdminAuthenticatedSessionController::class, 'store']);
    });

    // Routes for authenticated admins
    Route::middleware('admin.auth')->group(function () {
        // Dashboard - will be created later
        Route::get('/dashboard', function () {
            return 'Admin Dashboard - Coming Soon';
        })->name('dashboard');

        Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});