<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * تغییرات لازم در جدول users برای پشتیبانی از OTP
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ۱. شماره موبایل را الزامی (NOT NULL) می‌کنیم
            $table->string('phone')->nullable(false)->change();

            // ۲. فیلد password را nullable می‌کنیم تا کاربران OTP بدون رمز عبور ذخیره شوند
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * بازگردانی به حالت قبلی
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // توجه: اگر کاربرانی با password=null داشته باشید، بازگشت به NOT NULL خطا می‌دهد.
            // در پروژه‌های توسعه‌ای بهتر است پیش از اجرای down ابتدا فیلدهای null را پر کنید.
            $table->string('phone')->nullable()->change();
            $table->string('password')->nullable(false)->change();
        });
    }
};