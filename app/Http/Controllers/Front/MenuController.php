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
        $locale = app()->getLocale(); // fa, en, ar

        $menuItems = Menu::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $menu = $menuItems->map(function ($item, $index) use ($locale) {
            $itemName        = $item->getNameInLocale($locale);
            $itemDescription = $item->getDescriptionInLocale($locale);
            $categoryName    = $item->category
                ? $this->getCategoryNameInLocale($item->category, $locale)
                : __('menu.without_category');

            return [
                'id'                => $item->id,
                'row'               => $index + 1,
                'name'              => $itemName,
                'description'       => $itemDescription,
                'category'          => $categoryName,
                'price'             => (int) $item->price,
                'image_path'        => $this->getItemImage($item),
                'formatted_price'       => self::formatPrice($item->price),
                'formatted_price_full'  => self::formatPriceFull($item->price),
            ];
        })->toArray();

        // دسته‌بندی‌های فعال با نام چندزبانه
        $categories = MenuCategory::whereHas('menus', function ($query) {
            $query->where('is_active', true);
        })->get()->map(function ($category) use ($locale) {
            return $this->getCategoryNameInLocale($category, $locale);
        })->unique()->values()->toArray();

        if (empty($categories)) {
            $categories = array_values(array_unique(array_column($menu, 'category')));
        }

        // قیمت‌ها
        $prices = Menu::where('is_active', true)->pluck('price')->toArray();
        $maxPrice = !empty($prices) ? max($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPriceFormatted = self::formatPriceFull($maxPrice);

        $categoryImages = $this->getCategoryImages($locale);

        return view('front.pages.menu', [
            'hideHeader'       => true,
            'hideFooter'       => false,
            'menu'             => $menu,
            'categories'       => $categories,
            'maxPrice'         => $maxPrice,
            'minPrice'         => $minPrice,
            'maxPriceFormatted' => $maxPriceFormatted,
            'categoryImages'   => $categoryImages,
        ]);
    }

    /**
     * دریافت نام دسته‌بندی بر اساس زبان جاری
     */
    private function getCategoryNameInLocale($category, string $locale): string
    {
        $column = 'name_' . $locale;
        return $category->{$column} ?? $category->name_fa ?? '';
    }

    /**
     * دریافت تصویر برای هر آیتم منو
     */
    private function getItemImage($item): string
    {
        if (!empty($item->images) && isset($item->images[0])) {
            return asset('storage/' . $item->images[0]);
        }
        return '';
    }

    /**
     * دریافت تصاویر دسته‌بندی‌ها از دیتابیس با کلید متناسب با زبان جاری
     */
    private function getCategoryImages(string $locale): array
    {
        $categoryImages = [];
        $categories = MenuCategory::all();

        foreach ($categories as $category) {
            $imageUrl = $category->getImageUrlAttribute();
            if ($imageUrl) {
                // کلید رو متناسب با زبان جاری می‌ذاریم تا با $categories تطابق داشته باشه
                $key = $this->getCategoryNameInLocale($category, $locale);
                $categoryImages[$key] = $imageUrl;
            }
        }

        return $categoryImages;
    }

    /**
     * تبدیل اعداد بر اساس زبان فعلی
     */
    private static function formatNumber($num): string
    {
        if (!in_array(app()->getLocale(), ['fa', 'ar'])) {
            return (string) $num;
        }

        $persian = __('menu.digits');
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($english, $persian, (string) $num);
    }

    /**
     * جداکننده اعشار بر اساس زبان
     */
    private static function getDecimalSeparator(): string
    {
        return app()->getLocale() === 'fa' ? '٫' : '.';
    }

    private static function formatPriceFull($price): string
    {
        return self::formatNumber(number_format($price)) . ' ' . __('menu.currency');
    }

    private static function formatPrice($price): string
    {
        $currency = ' ' . __('menu.currency');

        if ($price >= 1000000) {
            $millions = $price / 1000000;
            if ($price % 1000000 == 0) {
                return self::formatNumber((int)$millions) . ' ' . __('menu.million') . $currency;
            } else {
                $formatted = number_format($millions, 1, '.', '');
                $parts = explode('.', $formatted);
                return self::formatNumber($parts[0]) . self::getDecimalSeparator() . self::formatNumber($parts[1]) . ' ' . __('menu.million') . $currency;
            }
        } elseif ($price >= 1000) {
            $thousands = round($price / 1000);
            return self::formatNumber($thousands) . ' ' . __('menu.thousand') . $currency;
        } else {
            return self::formatNumber($price) . $currency;
        }
    }
}