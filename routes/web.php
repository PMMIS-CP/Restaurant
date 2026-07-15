<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Front\MenuController;
use App\Http\Controllers\Front\MenuTakeoutController;
use App\Http\Controllers\Front\MenuOrganizationalController;
use App\Http\Controllers\Front\ReserveController;
use App\Http\Controllers\Front\SpinController;
use App\Http\Controllers\Front\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store');
Route::get('/menu/takeout', [MenuTakeoutController::class, 'index'])->name('menu.takeout');
Route::get('/menu/organizational', [MenuOrganizationalController::class, 'index'])->name('menu.organizational');
Route::get('/spin', [SpinController::class, 'index'])->name('spin');
Route::post('/spin', [SpinController::class, 'spin'])->name('spin.post');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/data', [CartController::class, 'data'])->name('cart.data');
    Route::post('/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::patch('/update/{cartItem}', [CartController::class, 'updateItem'])->name('cart.update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/merge', [CartController::class, 'merge'])->middleware('auth')->name('cart.merge');
});

require __DIR__.'/auth.php';
