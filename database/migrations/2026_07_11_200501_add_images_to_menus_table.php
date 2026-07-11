<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image');
        });

        DB::table('menus')->whereNotNull('image')->update([
            'images' => DB::raw("JSON_ARRAY(image)")
        ]);

        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('image')->nullable()->after('images');
        });

        DB::table('menus')->whereNotNull('images')->update([
            'image' => DB::raw("JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]'))")
        ]);

        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};