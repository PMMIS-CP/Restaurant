<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // دریافت دسته‌بندی‌ها برای انتساب
        $iranian = MenuCategory::where('name_fa', 'ایرانی')->first();
        $salad   = MenuCategory::where('name_fa', 'سالاد')->first();
        $special = MenuCategory::where('name_fa', 'مخصوص')->first();

        $items = [
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو کباب کوبیده', 'en' => 'Koobideh Kebab', 'ar' => 'كباب كوبيده'],
                'description' => [
                    'fa' => 'دو سیخ کباب کوبیده با برنج زعفرانی',
                    'en' => 'Two skewers of minced meat kebab with saffron rice',
                    'ar' => 'سيخين من كباب اللحم المفروم مع أرز الزعفران'
                ],
                'price' => 150000,
                'images' => ['menu/1.webp'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو مرغ', 'en' => 'Chicken with Rice', 'ar' => 'دجاج مع الأرز'],
                'description' => [
                    'fa' => 'یک تکه مرغ کامل با برنج زعفرانی',
                    'en' => 'A whole chicken piece with saffron rice',
                    'ar' => 'قطعة دجاج كاملة مع أرز الزعفران'
                ],
                'price' => 120000,
                'images' => ['menu/2.webp'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'خورشت قیمه', 'en' => 'Gheymeh Stew', 'ar' => 'يخنة القيمة'],
                'description' => [
                    'fa' => 'خورشت قیمه با گوشت و لپه و خلال سیب‌زمینی',
                    'en' => 'Split pea stew with meat and potato sticks',
                    'ar' => 'يخنة البازلاء المجروشة مع اللحم وعيدان البطاطس'
                ],
                'price' => 110000,
                'images' => ['menu/3.webp'],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'menu_category_id' => $salad->id,
                'name' => ['fa' => 'سالاد سزار', 'en' => 'Caesar Salad', 'ar' => 'سلطة سيزر'],
                'description' => [
                    'fa' => 'سالاد سزار با مرغ گریل شده و سس مخصوص',
                    'en' => 'Caesar salad with grilled chicken and special dressing',
                    'ar' => 'سلطة سيزر مع دجاج مشوي وصلصة خاصة'
                ],
                'price' => 80000,
                'images' => ['menu/4.webp'],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'غذای مخصوص رستوران', 'en' => 'Chef Special', 'ar' => 'طبق الشيف الخاص'],
                'description' => [
                    'fa' => 'ترکیبی از بهترین غذاهای رستوران با ارائه خاص',
                    'en' => 'A combination of our best dishes with a special presentation',
                    'ar' => 'مزيج من أفضل أطباق المطعم مع تقديم خاص'
                ],
                'price' => 200000,
                'images' => ['menu/5.webp'],
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $item) {
            foreach ($item['images'] as $image) {
                $this->copyImageIfNeeded($image);
            }

            Menu::create($item);
        }
    }

    private function copyImageIfNeeded(string $storagePath): void
    {
        $source = public_path('assets/images/' . $storagePath);
        $destination = storage_path('app/public/' . $storagePath);

        if (File::exists($source) && !File::exists($destination)) {
            File::ensureDirectoryExists(dirname($destination));
            File::copy($source, $destination);
        }
    }
}