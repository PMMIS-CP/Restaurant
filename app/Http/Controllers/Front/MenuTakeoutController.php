<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuTakeout;
use Illuminate\Http\Request;

class MenuTakeoutController extends Controller
{
    public function index()
    {
        // توابع کمکی برای فرمت قیمت (بدون تغییر)
        $toPersianNum = function ($num) {
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            return str_replace($english, $persian, (string) $num);
        };

        $formatPrice = function ($price) use ($toPersianNum) {
            if ($price >= 1000000) {
                $millions = $price / 1000000;
                if ($price % 1000000 == 0) {
                    return $toPersianNum((int)$millions) . ' میلیون';
                } else {
                    $formatted = number_format($millions, 1, '.', '');
                    $parts = explode('.', $formatted);
                    return $toPersianNum($parts[0]) . '٫' . $toPersianNum($parts[1]) . ' میلیون';
                }
            } elseif ($price >= 1000) {
                $thousands = round($price / 1000);
                return $toPersianNum($thousands) . ' هزار';
            } else {
                return $toPersianNum($price);
            }
        };

        $formatPriceFull = function ($price) use ($toPersianNum) {
            return $toPersianNum(number_format($price)) . ' تومان';
        };

        // دریافت آیتم‌های فعال به‌همراه دسته‌بندی
        $takeouts = MenuTakeout::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $menu = [];
        $row = 1;
        $currentLocale = app()->getLocale();

        foreach ($takeouts as $item) {
            $nameFa = $item->getNameInLocale('fa');
            $nameEn = $item->getNameInLocale('en');
            $descFa = $item->getDescriptionInLocale('fa');

            // نام دسته‌بندی با توجه به زبان جاری (با fallback به نام فارسی)
            if ($item->category) {
                $categoryName = $item->category->{'name_' . $currentLocale}
                    ?? $item->category->name_fa
                    ?? 'سایر';
            } else {
                $categoryName = 'سایر';
            }

            $price = (float) $item->price;
            $images = $item->getImagesUrls();

            $menu[] = [
                'id'               => $item->id,
                'ردیف'             => $row++,
                'اسم_غذا_فارسی'    => $nameFa,
                'اسم_غذا_لاتین'    => $nameEn,
                'نوع'              => $categoryName,
                'قیمت'             => $price,
                'جزئیات'           => $descFa,
                'formatted_price'  => $formatPrice($price),
                'images'           => $images,
                'main_image'       => $images[0] ?? null,
            ];
        }

        // گروه‌بندی بر اساس نوع
        $grouped = [];
        foreach ($menu as $item) {
            $category = $item['نوع'];
            $grouped[$category][] = $item;
        }

        $prices = array_column($menu, 'قیمت');
        $maxPrice = !empty($prices) ? max($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPriceFormatted = $formatPriceFull($maxPrice);
        $totalItems = count($menu);
        $initialCountPersian = $toPersianNum($totalItems);
        $categories = array_keys($grouped);

        return view('front.pages.takeout', array_merge(
            compact(
                'grouped',
                'categories',
                'maxPrice',
                'minPrice',
                'maxPriceFormatted',
                'initialCountPersian'
            ),
            [
                'hideHeader' => true,
                'hideFooter' => false,
            ]
        ));
    }
}