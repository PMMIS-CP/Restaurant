<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // دریافت آیتم‌های فعال منو با رابطه دسته‌بندی
        $menuItems = Menu::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        // آماده‌سازی داده‌ها برای ویو
        $menu = $menuItems->map(function ($item, $index) {
            return [
                'ردیف'              => $index + 1,
                'اسم_غذا_فارسی'     => $item->getNameInLocale('fa'),
                'اسم_غذا_لاتین'     => $item->getNameInLocale('en'),
                'نوع'               => $item->category ? $item->category->name_fa : 'بدون دسته‌بندی',
                'قیمت'             => (int) $item->price,
                'جزئیات'           => $item->getDescriptionInLocale('fa'),
                'image_path'       => $this->getItemImage($item, $index),
                'formatted_price'      => self::formatPrice($item->price),
                'formatted_price_full' => self::formatPriceFull($item->price),
            ];
        })->toArray();

        // دریافت دسته‌بندی‌های فعال که حداقل یک آیتم منو دارند
        $categories = MenuCategory::whereHas('menus', function ($query) {
            $query->where('is_active', true);
        })->pluck('name_fa')->toArray();

        // اگر دسته‌بندی از آیتم‌ها استخراج نشد، از دیتابیس بگیر
        if (empty($categories)) {
            $categories = array_values(array_unique(array_column($menu, 'نوع')));
        }

        // محاسبه حداقل و حداکثر قیمت
        $prices = Menu::where('is_active', true)->pluck('price')->toArray();
        $maxPrice = !empty($prices) ? max($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPriceFormatted = self::formatPriceFull($maxPrice);

        // تصاویر متناظر با هر دسته‌بندی
        $categoryImages = $this->getCategoryImages();

        return view('front.pages.menu', [
            'hideHeader'       => true,
            'hideFooter'       => true,
            'menu'             => $menu,
            'categories'       => $categories,
            'maxPrice'         => $maxPrice,
            'minPrice'         => $minPrice,
            'maxPriceFormatted' => $maxPriceFormatted,
            'categoryImages'   => $categoryImages,
        ]);
    }

    /**
     * دریافت تصویر برای هر آیتم منو
     */
    private function getItemImage($item, $index): string
    {
        // اگر آیتم تصویر دارد، از تصویر خودش استفاده کن
        if (!empty($item->images) && isset($item->images[0])) {
            return asset('storage/' . $item->images[0]);
        }
        
        // در غیر این صورت از تصویر پیش‌فرض بر اساس شماره ردیف
        $imageNumber = fmod($index, 12) + 1;
        return asset("assets/images/menu/" . $imageNumber . ".webp");
    }

    /**
     * دریافت تصاویر دسته‌بندی‌ها از دیتابیس
     */
    private function getCategoryImages(): array
    {
        $categoryImages = [];
        $categories = MenuCategory::all();
        
        foreach ($categories as $category) {
            if ($category->getImageUrlAttribute()) {
                $categoryImages[$category->name_fa] = $category->getImageUrlAttribute();
            }
        }
        
        // اگر دسته‌بندی تصویر نداشت، از تصاویر پیش‌فرض استفاده کن
        if (empty($categoryImages)) {
            $allCategories = MenuCategory::pluck('name_fa')->toArray();
            foreach ($allCategories as $cat) {
                $image = '/assets/images/menu/مخصوص.webp'; // پیش‌فرض
                if (str_contains($cat, 'ایرانی')) {
                    $image = '/assets/images/menu/ایرانی.webp';
                } elseif (str_contains($cat, 'سالاد')) {
                    $image = '/assets/images/menu/سالاد.webp';
                }
                $categoryImages[$cat] = asset($image);
            }
        }
        
        return $categoryImages;
    }

    // توابع کمکی فرمت قیمت
    private static function toPersianNum($num)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($english, $persian, (string) $num);
    }

    private static function formatPriceFull($price)
    {
        return self::toPersianNum(number_format($price)) . ' تومان';
    }

    private static function formatPrice($price)
    {
        if ($price >= 1000000) {
            $millions = $price / 1000000;
            if ($price % 1000000 == 0) {
                return self::toPersianNum((int)$millions) . ' میلیون تومان';
            } else {
                $formatted = number_format($millions, 1, '.', '');
                $parts = explode('.', $formatted);
                return self::toPersianNum($parts[0]) . '٫' . self::toPersianNum($parts[1]) . ' میلیون تومان';
            }
        } elseif ($price >= 1000) {
            $thousands = round($price / 1000);
            return self::toPersianNum($thousands) . ' هزار تومان';
        } else {
            return self::toPersianNum($price) . ' تومان';
        }
    }
}