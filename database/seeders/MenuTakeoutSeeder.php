<?php

namespace Database\Seeders;

use App\Models\MenuTakeoutCategory;
use App\Models\MenuTakeout;
use Illuminate\Database\Seeder;

class MenuTakeoutSeeder extends Seeder
{
    public function run(): void
    {
        // دسته‌بندی بیرون‌بر
        $fastFood = MenuTakeoutCategory::create([
            'name_fa' => 'فست فود',
            'name_en' => 'Fast Food',
            'name_ar' => 'وجبات سريعة',
        ]);

        $drinks = MenuTakeoutCategory::create([
            'name_fa' => 'نوشیدنی',
            'name_en' => 'Beverages',
            'name_ar' => 'مشروبات',
        ]);

        // آیتم‌های بیرون‌بر
        MenuTakeout::create([
            'menu_takeout_category_id' => $fastFood->id,
            'name' => ['fa' => 'همبرگر مخصوص', 'en' => 'Special Burger', 'ar' => 'برغر خاص'],
            'description' => [
                'fa' => 'همبرگر با گوشت گوساله، پنیر و قارچ',
                'en' => 'Burger with beef patty, cheese and mushrooms',
                'ar' => 'برغر مع لحم بقري، جبنة و مشروم'
            ],
            'price' => 95000,
            'images' => ['menu/3.webp'],
            'is_active' => true,
            'sort_order' => 1,
        ]);

        MenuTakeout::create([
            'menu_takeout_category_id' => $drinks->id,
            'name' => ['fa' => 'شربت بهار نارنج', 'en' => 'Orange Blossom Syrup', 'ar' => 'شراب زهر البرتقال'],
            'description' => [
                'fa' => 'شربت طبیعی بهار نارنج',
                'en' => 'Natural orange blossom syrup',
                'ar' => 'شراب زهر البرتقال الطبيعي'
            ],
            'price' => 40000,
            'images' => ['menu/4.webp'],
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}