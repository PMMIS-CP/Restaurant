<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // فقط nullable می‌کنیم، unique بودن را حفظ می‌کنیم
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // توجه: اگر رکوردهایی با email=null داشته باشید، این عملیات خطا می‌دهد
            $table->string('email')->nullable(false)->change();
        });
    }
};