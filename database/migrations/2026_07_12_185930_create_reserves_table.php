<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // نام و نام خانوادگی
            $table->string('phone');                    // شماره تماس
            $table->string('email')->nullable();        // ایمیل (اختیاری)
            $table->string('event_type')->nullable();   // نوع مراسم (مقدار data-value)
            $table->string('guest_count')->nullable();  // بازه تعداد مهمان (مثل 1-4)
            $table->string('reservation_date');         // تاریخ شمسی انتخاب‌شده
            $table->string('entry_time');               // ساعت ورود (HH:MM)
            $table->string('exit_time');                // ساعت خروج (HH:MM)
            $table->text('description')->nullable();    // توضیحات
            $table->string('status')->default('pending'); // وضعیت (پیش‌فرض: در انتظار بررسی)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};