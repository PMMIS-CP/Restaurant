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

        // آیتم‌های فست فود
        $fastFoodItems = [
            [
                'name' => ['fa' => 'همبرگر مخصوص', 'en' => 'Special Burger', 'ar' => 'برغر خاص'],
                'description' => [
                    'fa' => 'همبرگر با گوشت گوساله، پنیر و قارچ',
                    'en' => 'Burger with beef patty, cheese and mushrooms',
                    'ar' => 'برغر مع لحم بقري، جبنة و مشروم'
                ],
                'price' => 95000,
                'images' => ['menu/3.webp'],
                'sort_order' => 1,
            ],
            [
                'name' => ['fa' => 'چیزبرگر', 'en' => 'Cheeseburger', 'ar' => 'تشيز برغر'],
                'description' => [
                    'fa' => 'برگر گوشت با پنیر چدار و خیارشور',
                    'en' => 'Beef burger with cheddar cheese and pickles',
                    'ar' => 'برغر لحم مع جبنة شيدر و مخلل'
                ],
                'price' => 78000,
                'images' => ['menu/5.webp'],
                'sort_order' => 2,
            ],
            [
                'name' => ['fa' => 'چیکن برگر', 'en' => 'Chicken Burger', 'ar' => 'برغر دجاج'],
                'description' => [
                    'fa' => 'برگر مرغ سوخاری با کاهو و سس مخصوص',
                    'en' => 'Crispy chicken burger with lettuce and special sauce',
                    'ar' => 'برغر دجاج مقرمش مع خس و صلصة خاصة'
                ],
                'price' => 413567,
                'images' => ['menu/6.webp'],
                'sort_order' => 3,
            ],
            [
                'name' => ['fa' => 'سیب‌زمینی سرخ‌کرده', 'en' => 'French Fries', 'ar' => 'بطاطس مقلية'],
                'description' => [
                    'fa' => 'سیب‌زمینی خلالی طلایی و ترد',
                    'en' => 'Golden crispy french fries',
                    'ar' => 'بطاطس مقلية ذهبية ومقرمشة'
                ],
                'price' => 35000,
                'images' => ['menu/7.webp'],
                'sort_order' => 4,
            ],
            [
                'name' => ['fa' => 'هات داگ', 'en' => 'Hot Dog', 'ar' => 'هوت دوغ'],
                'description' => [
                    'fa' => 'سوسیس گوشت با نان تازه، سس کچاپ و خردل',
                    'en' => 'Meat sausage with fresh bun, ketchup and mustard',
                    'ar' => 'سجق لحم مع خبز طازج، كاتشب و خردل'
                ],
                'price' => 62999,
                'images' => ['menu/8.webp'],
                'sort_order' => 5,
            ],
        ];

        // آیتم‌های نوشیدنی
        $drinkItems = [
            [
                'name' => ['fa' => 'شربت بهار نارنج', 'en' => 'Orange Blossom Syrup', 'ar' => 'شراب زهر البرتقال'],
                'description' => [
                    'fa' => 'شربت طبیعی بهار نارنج',
                    'en' => 'Natural orange blossom syrup',
                    'ar' => 'شراب زهر البرتقال الطبيعي'
                ],
                'price' => 40000,
                'images' => ['menu/4.webp'],
                'sort_order' => 6,
            ],
            [
                'name' => ['fa' => 'لیموناد تازه', 'en' => 'Fresh Lemonade', 'ar' => 'عصير ليمون طازج'],
                'description' => [
                    'fa' => 'لیموناد خانگی با لیموی تازه و نعناع',
                    'en' => 'Homemade lemonade with fresh lemon and mint',
                    'ar' => 'عصير ليمون منزلي مع ليمون طازج و نعناع'
                ],
                'price' => 35000,
                'images' => ['menu/9.webp'],
                'sort_order' => 7,
            ],
            [
                'name' => ['fa' => 'شربت نعناع', 'en' => 'Mint Syrup', 'ar' => 'شراب النعناع'],
                'description' => [
                    'fa' => 'شربت نعناع طبیعی و خنک',
                    'en' => 'Natural and refreshing mint syrup',
                    'ar' => 'شراب النعناع الطبيعي المنعش'
                ],
                'price' => 42500,
                'images' => ['menu/10.webp'],
                'sort_order' => 8,
            ],
            [
                'name' => ['fa' => 'آبمیوه طبیعی', 'en' => 'Natural Fruit Juice', 'ar' => 'عصير فواكه طبيعي'],
                'description' => [
                    'fa' => 'آبمیوه فصل از میوه‌های تازه',
                    'en' => 'Seasonal fruit juice from fresh fruits',
                    'ar' => 'عصير فواكه موسمي من فواكه طازجة'
                ],
                'price' => 67321,
                'images' => ['menu/11.webp'],
                'sort_order' => 9,
            ],
        ];

        // ذخیره همه آیتم‌ها با دسته‌بندی صحیح
        foreach ($fastFoodItems as $item) {
            $item['menu_takeout_category_id'] = $fastFood->id;
            $item['is_active'] = true;
            MenuTakeout::create($item);
        }

        foreach ($drinkItems as $item) {
            $item['menu_takeout_category_id'] = $drinks->id;
            $item['is_active'] = true;
            MenuTakeout::create($item);
        }
    }
}