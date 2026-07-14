<?php

namespace Database\Seeders;

use App\Models\MenuOrganizationalCategory;
use App\Models\MenuOrganizational;
use Illuminate\Database\Seeder;

class MenuOrganizationalSeeder extends Seeder
{
    public function run(): void
    {
        // دسته‌بندی‌های سازمانی
        $lunch = MenuOrganizationalCategory::create([
            'name_fa' => 'ناهار سازمانی',
            'name_en' => 'Organizational Lunch',
            'name_ar' => 'غداء تنظيمي',
        ]);

        $dinner = MenuOrganizationalCategory::create([
            'name_fa' => 'شام سازمانی',
            'name_en' => 'Organizational Dinner',
            'name_ar' => 'عشاء تنظيمي',
        ]);

        // غذاهای سازمانی
        MenuOrganizational::create([
            'menu_organizational_category_id' => $lunch->id,
            'name' => ['fa' => 'کباب برگ', 'en' => 'Barg Kebab', 'ar' => 'كباب برغ'],
            'description' => [
                'fa' => 'یک سیخ کباب برگ با برنج',
                'en' => 'One skewer of barg kebab with rice',
                'ar' => 'سيخ واحد من كباب البرغ مع الأرز'
            ],
            'price' => 180000,
            'images' => ['menu/1.webp'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        MenuOrganizational::create([
            'menu_organizational_category_id' => $dinner->id,
            'name' => ['fa' => 'ماهی قزل‌آلا', 'en' => 'Grilled Trout', 'ar' => 'سمك السلمون المشوي'],
            'description' => [
                'fa' => 'ماهی قزل‌آلا با سبزیجات و برنج',
                'en' => 'Grilled trout with vegetables and rice',
                'ar' => 'سمك السلمون المشوي مع الخضار والأرز'
            ],
            'price' => 220000,
            'images' => ['menu/2.webp'],
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}