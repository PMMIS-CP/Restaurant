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

        // غذاهای ناهار
        $lunchItems = [
            [
                'name' => ['fa' => 'کباب برگ', 'en' => 'Barg Kebab', 'ar' => 'كباب برغ'],
                'description' => [
                    'fa' => 'یک سیخ کباب برگ با برنج',
                    'en' => 'One skewer of barg kebab with rice',
                    'ar' => 'سيخ واحد من كباب البرغ مع الأرز'
                ],
                'price' => 180000,
                'images' => ['menu/1.webp'],
                'sort_order' => 1,
            ],
            [
                'name' => ['fa' => 'چلو مرغ', 'en' => 'Chicken with Rice', 'ar' => 'دجاج مع الأرز'],
                'description' => [
                    'fa' => 'مرغ کامل با برنج زعفرانی',
                    'en' => 'Whole chicken with saffron rice',
                    'ar' => 'دجاجة كاملة مع أرز الزعفران'
                ],
                'price' => 120000,
                'images' => ['menu/3.webp'],
                'sort_order' => 2,
            ],
            [
                'name' => ['fa' => 'خورشت قیمه', 'en' => 'Gheymeh Stew', 'ar' => 'يخنة القيمة'],
                'description' => [
                    'fa' => 'خورشت قیمه با گوشت و لپه',
                    'en' => 'Split pea stew with meat',
                    'ar' => 'يخنة البازلاء المجروشة مع اللحم'
                ],
                'price' => 110000,
                'images' => ['menu/4.webp'],
                'sort_order' => 3,
            ],
            [
                'name' => ['fa' => 'کباب کوبیده', 'en' => 'Koobideh Kebab', 'ar' => 'كباب كوبيده'],
                'description' => [
                    'fa' => 'دو سیخ کباب کوبیده با برنج',
                    'en' => 'Two skewers of koobideh kebab with rice',
                    'ar' => 'سيخين من كباب كوبيده مع الأرز'
                ],
                'price' => 636345,
                'images' => ['menu/5.webp'],
                'sort_order' => 4,
            ],
        ];

        // غذاهای شام
        $dinnerItems = [
            [
                'name' => ['fa' => 'ماهی قزل‌آلا', 'en' => 'Grilled Trout', 'ar' => 'سمك السلمون المشوي'],
                'description' => [
                    'fa' => 'ماهی قزل‌آلا با سبزیجات و برنج',
                    'en' => 'Grilled trout with vegetables and rice',
                    'ar' => 'سمك السلمون المشوي مع الخضار والأرز'
                ],
                'price' => 220000,
                'images' => ['menu/2.webp'],
                'sort_order' => 5,
            ],
            [
                'name' => ['fa' => 'ماهیچه گوسفندی', 'en' => 'Lamb Shank', 'ar' => 'لحم ساق الضأن'],
                'description' => [
                    'fa' => 'ماهیچه گوسفندی با برنج زعفرانی',
                    'en' => 'Lamb shank with saffron rice',
                    'ar' => 'ساق ضأن مع أرز الزعفران'
                ],
                'price' => 250000,
                'images' => ['menu/6.webp'],
                'sort_order' => 6,
            ],
            [
                'name' => ['fa' => 'سالمون با شوید', 'en' => 'Salmon with Dill', 'ar' => 'سلمون مع الشبت'],
                'description' => [
                    'fa' => 'فیله سالمون با سس شوید و لیمو',
                    'en' => 'Salmon fillet with dill and lemon sauce',
                    'ar' => 'فيليه سلمون مع صلصة الشبت والليمون'
                ],
                'price' => 781543,
                'images' => ['menu/7.webp'],
                'sort_order' => 7,
            ],
            [
                'name' => ['fa' => 'خورشت سبزیجات', 'en' => 'Vegetable Stew', 'ar' => 'يخنة الخضار'],
                'description' => [
                    'fa' => 'خورشت سبزیجات فصل با برنج',
                    'en' => 'Seasonal vegetable stew with rice',
                    'ar' => 'يخنة خضار موسمية مع الأرز'
                ],
                'price' => 95000,
                'images' => ['menu/8.webp'],
                'sort_order' => 8,
            ],
        ];

        // ذخیره آیتم‌ها
        foreach ($lunchItems as $item) {
            $item['menu_organizational_category_id'] = $lunch->id;
            $item['is_active'] = true;
            MenuOrganizational::create($item);
        }

        foreach ($dinnerItems as $item) {
            $item['menu_organizational_category_id'] = $dinner->id;
            $item['is_active'] = true;
            MenuOrganizational::create($item);
        }
    }
}