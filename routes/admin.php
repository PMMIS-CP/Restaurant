<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\MenuManagementController;

Route::name('admin.')->group(function () {

    // Routes for guests (not logged in)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])
            ->name('login');
        Route::post('/login', [AdminAuthenticatedSessionController::class, 'store']);
    });

    // Routes for authenticated admins
    Route::middleware('admin.auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Menu Management
        Route::prefix('menu')->name('menu.')->group(function () {
            Route::get('/', [MenuManagementController::class, 'index'])->name('index');
            Route::get('/create', [MenuManagementController::class, 'create'])->name('create');
            Route::post('/', [MenuManagementController::class, 'store'])->name('store');
            Route::get('/{menu}/edit', [MenuManagementController::class, 'edit'])->name('edit');
            Route::put('/{menu}', [MenuManagementController::class, 'update'])->name('update');
            Route::delete('/{menu}', [MenuManagementController::class, 'destroy'])->name('destroy');
            Route::patch('/{menu}/toggle-active', [MenuManagementController::class, 'toggleActive'])
                ->name('toggle-active');
        });

        Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});