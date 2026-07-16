<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PhoneLoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // صفحه لاگین (نمایش)
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // ورود با رمز عبور (برای کاربران موجود)
    Route::post('login/phone', [PhoneLoginController::class, 'login'])
        ->name('login.phone');

    // بررسی وجود کاربر با شماره موبایل
    Route::post('/check-phone', [SmsController::class, 'checkPhone'])
        ->name('check.phone');

    // ارسال کد تأیید (ثبت‌نام یا بازیابی رمز)
    Route::post('/send-otp', [SmsController::class, 'sendVerificationCode'])
        ->name('send.otp');

    // تأیید کد و ثبت‌نام کاربر جدید
    Route::post('/verify-otp', [SmsController::class, 'verifyCode'])
        ->name('verify.otp');

    // تأیید کد برای بازیابی رمز عبور
    Route::post('/verify-reset-otp', [SmsController::class, 'verifyResetOtp'])
        ->name('verify.reset.otp');

    // ثبت رمز عبور جدید (بازیابی رمز با SMS)
    Route::post('/reset-password-sms', [SmsController::class, 'resetPassword'])
        ->name('reset.password.sms');

    // روت‌های فراموشی رمز عبور (روش ایمیلی - اختیاری)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
