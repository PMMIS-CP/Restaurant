<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Dashboard\MenuManagementController;
use App\Http\Controllers\Admin\Dashboard\MenuCategoryController;
use App\Http\Controllers\Admin\Dashboard\MenuTakeoutCategoryController;
use App\Http\Controllers\Admin\Dashboard\MenuTakeoutManagementController;
use App\Http\Controllers\Admin\Dashboard\MenuOrganizationalCategoryController;
use App\Http\Controllers\Admin\Dashboard\MenuOrganizationalManagementController;
use App\Http\Controllers\Admin\Dashboard\ReserveManagementController;

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

        // Menu Categories Management
        Route::prefix('menu-categories')->name('menu-categories.')->group(function () {
            Route::get('/', [MenuCategoryController::class, 'index'])->name('index');
            Route::get('/create', [MenuCategoryController::class, 'create'])->name('create');
            Route::post('/', [MenuCategoryController::class, 'store'])->name('store');
            Route::get('/{menuCategory}/edit', [MenuCategoryController::class, 'edit'])->name('edit');
            Route::put('/{menuCategory}', [MenuCategoryController::class, 'update'])->name('update');
            Route::delete('/{menuCategory}', [MenuCategoryController::class, 'destroy'])->name('destroy');
        });

        // Takeout Menu Management
        Route::prefix('takeout')->name('takeout.')->group(function () {
            Route::get('/', [MenuTakeoutManagementController::class, 'index'])->name('index');
            Route::get('/create', [MenuTakeoutManagementController::class, 'create'])->name('create');
            Route::post('/', [MenuTakeoutManagementController::class, 'store'])->name('store');
            Route::get('/{takeout}/edit', [MenuTakeoutManagementController::class, 'edit'])->name('edit');
            Route::put('/{takeout}', [MenuTakeoutManagementController::class, 'update'])->name('update');
            Route::delete('/{takeout}', [MenuTakeoutManagementController::class, 'destroy'])->name('destroy');
            Route::patch('/{takeout}/toggle-active', [MenuTakeoutManagementController::class, 'toggleActive'])
                ->name('toggle-active');
        });

        // Takeout Categories Management
        Route::prefix('takeout-categories')->name('takeout-categories.')->group(function () {
            Route::get('/', [MenuTakeoutCategoryController::class, 'index'])->name('index');
            Route::get('/create', [MenuTakeoutCategoryController::class, 'create'])->name('create');
            Route::post('/', [MenuTakeoutCategoryController::class, 'store'])->name('store');
            Route::get('/{takeoutCategory}/edit', [MenuTakeoutCategoryController::class, 'edit'])->name('edit');
            Route::put('/{takeoutCategory}', [MenuTakeoutCategoryController::class, 'update'])->name('update');
            Route::delete('/{takeoutCategory}', [MenuTakeoutCategoryController::class, 'destroy'])->name('destroy');
        });

        // Organizational Menu Management
        Route::prefix('organizational')->name('organizational.')->group(function () {
            Route::get('/', [MenuOrganizationalManagementController::class, 'index'])->name('index');
            Route::get('/create', [MenuOrganizationalManagementController::class, 'create'])->name('create');
            Route::post('/', [MenuOrganizationalManagementController::class, 'store'])->name('store');
            Route::get('/{organizational}/edit', [MenuOrganizationalManagementController::class, 'edit'])->name('edit');
            Route::put('/{organizational}', [MenuOrganizationalManagementController::class, 'update'])->name('update');
            Route::delete('/{organizational}', [MenuOrganizationalManagementController::class, 'destroy'])->name('destroy');
            Route::patch('/{organizational}/toggle-active', [MenuOrganizationalManagementController::class, 'toggleActive'])
                ->name('toggle-active');
        });

        // Organizational Categories Management
        Route::prefix('organizational-categories')->name('organizational-categories.')->group(function () {
            Route::get('/', [MenuOrganizationalCategoryController::class, 'index'])->name('index');
            Route::get('/create', [MenuOrganizationalCategoryController::class, 'create'])->name('create');
            Route::post('/', [MenuOrganizationalCategoryController::class, 'store'])->name('store');
            Route::get('/{organizationalCategory}/edit', [MenuOrganizationalCategoryController::class, 'edit'])->name('edit');
            Route::put('/{organizationalCategory}', [MenuOrganizationalCategoryController::class, 'update'])->name('update');
            Route::delete('/{organizationalCategory}', [MenuOrganizationalCategoryController::class, 'destroy'])->name('destroy');
        });
        
        // Reserve Management
        Route::prefix('reserves')->name('reserves.')->group(function () {
            Route::get('/', [ReserveManagementController::class, 'index'])->name('index');
            Route::get('/{reserve}', [ReserveManagementController::class, 'show'])->name('show');
            Route::delete('/{reserve}', [ReserveManagementController::class, 'destroy'])->name('destroy');
        });

        Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});