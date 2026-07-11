<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // حذف ستون category قدیمی
            $table->dropColumn('category');

            // اضافه کردن ستون کلید خارجی
            $table->foreignId('menu_category_id')
                ->after('price')
                ->constrained('menu_categories')
                ->cascadeOnDelete(); // با حذف دسته، تمام غذاهای آن هم حذف می‌شود
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['menu_category_id']);
            $table->dropColumn('menu_category_id');

            // برگرداندن ستون category به حالت قبل (اختیاری)
            $table->string('category')->nullable();
        });
    }
};