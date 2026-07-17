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
use App\Http\Controllers\Front\FoodModalController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reserve', [ReserveController::class, 'index'])->name('reserve');
Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store');

Route::post('/reserve/send-otp', [ReserveController::class, 'sendOtp'])->name('reserve.sendOtp');
Route::post('/reserve/verify-otp', [ReserveController::class, 'verifyOtp'])->name('reserve.verifyOtp');

Route::get('/check-phone', [ReserveController::class, 'checkPhone'])->name('check.phone');
Route::post('/reserve/direct-submit', [ReserveController::class, 'directSubmit'])->name('reserve.directSubmit');

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

Route::get('/api/food-modal', [FoodModalController::class, 'show'])->name('food-modal.show');

require __DIR__.'/auth.php';
