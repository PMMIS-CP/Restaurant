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
            // ========== دسته‌بندی ایرانی ==========
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو کباب کوبیده', 'en' => 'Koobideh Kebab', 'ar' => 'كباب كوبيده'],
                'description' => [
                    'fa' => 'دو سیخ کباب کوبیده با برنج زعفرانی',
                    'en' => 'Two skewers of minced meat kebab with saffron rice',
                    'ar' => 'سيخين من كباب اللحم المفروم مع أرز الزعفران'
                ],
                'price' => 185000,
                'images' => ['menu/1.webp'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو کباب برگ', 'en' => 'Barg Kebab', 'ar' => 'كباب برگ'],
                'description' => [
                    'fa' => 'یک سیخ کباب برگ اعلا با برنج زعفرانی و گوجه کبابی',
                    'en' => 'One skewer of premium Barg kebab with saffron rice and grilled tomato',
                    'ar' => 'سيخ واحد من كباب برگ الفاخر مع أرز الزعفران وطماطم مشوية'
                ],
                'price' => 636345,
                'images' => ['menu/2.webp'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو مرغ', 'en' => 'Chicken with Rice', 'ar' => 'دجاج مع الأرز'],
                'description' => [
                    'fa' => 'یک تکه مرغ کامل با برنج زعفرانی',
                    'en' => 'A whole chicken piece with saffron rice',
                    'ar' => 'قطعة دجاج كاملة مع أرز الزعفران'
                ],
                'price' => 145000,
                'images' => ['menu/3.webp'],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'چلو جوجه کباب', 'en' => 'Joojeh Kebab', 'ar' => 'كباب الدجاج'],
                'description' => [
                    'fa' => 'جوجه کباب زعفرانی بدون استخوان با برنج',
                    'en' => 'Boneless saffron chicken kebab with rice',
                    'ar' => 'كباب دجاج بالزعفران بدون عظم مع الأرز'
                ],
                'price' => 174500,
                'images' => ['menu/4.webp'],
                'is_active' => true,
                'sort_order' => 4,
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
                'images' => ['menu/5.webp'],
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'خورشت قورمه سبزی', 'en' => 'Ghormeh Sabzi', 'ar' => 'قورمة سبزي'],
                'description' => [
                    'fa' => 'خورشت قورمه سبزی با گوشت گوسفندی و لوبیا قرمز',
                    'en' => 'Herb stew with lamb meat and kidney beans',
                    'ar' => 'يخنة الأعشاب مع لحم الضأن والفاصوليا الحمراء'
                ],
                'price' => 125000,
                'images' => ['menu/6.webp'],
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'زرشک پلو با مرغ', 'en' => 'Barberry Rice with Chicken', 'ar' => 'أرز البرباريس مع الدجاج'],
                'description' => [
                    'fa' => 'زرشک پلو زعفرانی با مرغ گریل شده',
                    'en' => 'Saffron barberry rice with grilled chicken',
                    'ar' => 'أرز الزعفران بالبرباريس مع دجاج مشوي'
                ],
                'price' => 693847,
                'images' => ['menu/7.webp'],
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'باقالی پلو با ماهیچه', 'en' => 'Fava Bean Rice with Lamb Shank', 'ar' => 'أرز الفول مع لحم الساق'],
                'description' => [
                    'fa' => 'باقالی پلو با شوید و ماهیچه گوسفندی',
                    'en' => 'Fava bean and dill rice with lamb shank',
                    'ar' => 'أرز الفول والشبت مع لحم ساق الضأن'
                ],
                'price' => 220000,
                'images' => ['menu/8.webp'],
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'menu_category_id' => $iranian->id,
                'name' => ['fa' => 'ته‌چین مرغ', 'en' => 'Tahchin with Chicken', 'ar' => 'التاهتشين بالدجاج'],
                'description' => [
                    'fa' => 'ته‌چین زعفرانی با مرغ و زرشک',
                    'en' => 'Saffron baked rice cake with chicken and barberries',
                    'ar' => 'قالب الأرز بالزعفران مع الدجاج والبرباريس'
                ],
                'price' => 130000,
                'images' => ['menu/9.webp'],
                'is_active' => true,
                'sort_order' => 9,
            ],

            // ========== دسته‌بندی سالاد ==========
            [
                'menu_category_id' => $salad->id,
                'name' => ['fa' => 'سالاد سزار', 'en' => 'Caesar Salad', 'ar' => 'سلطة سيزر'],
                'description' => [
                    'fa' => 'سالاد سزار با مرغ گریل شده و سس مخصوص',
                    'en' => 'Caesar salad with grilled chicken and special dressing',
                    'ar' => 'سلطة سيزر مع دجاج مشوي وصلصة خاصة'
                ],
                'price' => 80000,
                'images' => ['menu/10.webp'],
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'menu_category_id' => $salad->id,
                'name' => ['fa' => 'سالاد شیرازی', 'en' => 'Shirazi Salad', 'ar' => 'سلطة شيرازي'],
                'description' => [
                    'fa' => 'خیار، گوجه، پیاز با آبلیمو و نعناع خشک',
                    'en' => 'Cucumber, tomato, onion with lemon juice and dried mint',
                    'ar' => 'خيار، طماطم، بصل مع عصير الليمون والنعناع المجفف'
                ],
                'price' => 45000,
                'images' => ['menu/11.webp'],
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'menu_category_id' => $salad->id,
                'name' => ['fa' => 'سالاد یونانی', 'en' => 'Greek Salad', 'ar' => 'سلطة يونانية'],
                'description' => [
                    'fa' => 'پنیر فتا، زیتون، خیار و گوجه با سس ایتالیایی',
                    'en' => 'Feta cheese, olives, cucumber and tomato with Italian dressing',
                    'ar' => 'جبنة فيتا، زيتون، خيار وطماطم مع صلصة إيطالية'
                ],
                'price' => 67432,
                'images' => ['menu/12.webp'],
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'menu_category_id' => $salad->id,
                'name' => ['fa' => 'سالاد کینوا', 'en' => 'Quinoa Salad', 'ar' => 'سلطة الكينوا'],
                'description' => [
                    'fa' => 'کینوا با سبزیجات تازه و سس لیمو',
                    'en' => 'Quinoa with fresh vegetables and lemon dressing',
                    'ar' => 'كينوا مع خضروات طازجة وصلصة الليمون'
                ],
                'price' => 95000,
                'images' => ['menu/13.webp'],
                'is_active' => true,
                'sort_order' => 13,
            ],

            // ========== دسته‌بندی مخصوص ==========
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'غذای مخصوص رستوران', 'en' => 'Chef Special', 'ar' => 'طبق الشيف الخاص'],
                'description' => [
                    'fa' => 'ترکیبی از بهترین غذاهای رستوران با ارائه خاص',
                    'en' => 'A combination of our best dishes with a special presentation',
                    'ar' => 'مزيج من أفضل أطباق المطعم مع تقديم خاص'
                ],
                'price' => 200000,
                'images' => ['menu/14.webp'],
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'استیک ریبلایس', 'en' => 'Ribeye Steak', 'ar' => 'ستيك ريب آي'],
                'description' => [
                    'fa' => 'استیک ریبلایس ۳۰۰ گرمی با سس قارچ و سیب‌زمینی',
                    'en' => '300g ribeye steak with mushroom sauce and potatoes',
                    'ar' => 'ستيك ريب آي ٣٠٠ غرام مع صلصة الفطر والبطاطس'
                ],
                'price' => 781543,
                'images' => ['menu/15.webp'],
                'is_active' => true,
                'sort_order' => 15,
            ],
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'ماهی سالمون گریل', 'en' => 'Grilled Salmon', 'ar' => 'سلمون مشوي'],
                'description' => [
                    'fa' => 'فیله سالمون نروژی با سس لیمو و شوید',
                    'en' => 'Norwegian salmon fillet with lemon and dill sauce',
                    'ar' => 'فيليه سلمون نرويجي مع صلصة الليمون والشبت'
                ],
                'price' => 350000,
                'images' => ['menu/16.webp'],
                'is_active' => true,
                'sort_order' => 16,
            ],
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'پاستا آلفردو', 'en' => 'Alfredo Pasta', 'ar' => 'باستا ألفريدو'],
                'description' => [
                    'fa' => 'پاستا با سس آلفردوی خامه‌ای و مرغ گریل شده',
                    'en' => 'Pasta with creamy Alfredo sauce and grilled chicken',
                    'ar' => 'باستا مع صلصة ألفريدو الكريمية ودجاج مشوي'
                ],
                'price' => 519823,
                'images' => ['menu/17.webp'],
                'is_active' => true,
                'sort_order' => 17,
            ],
            [
                'menu_category_id' => $special->id,
                'name' => ['fa' => 'میگو سوخاری', 'en' => 'Fried Shrimp', 'ar' => 'روبيان مقلي'],
                'description' => [
                    'fa' => 'میگوی سوخاری با سس تارتار و لیمو',
                    'en' => 'Crispy fried shrimp with tartar sauce and lemon',
                    'ar' => 'روبيان مقلي مقرمش مع صلصة التارتار والليمون'
                ],
                'price' => 265000,
                'images' => ['menu/18.webp'],
                'is_active' => true,
                'sort_order' => 18,
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