<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuTakeout;
use Illuminate\Http\Request;

class MenuTakeoutController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale(); // fa, en, ar
        
        $digits = __('takeout.digits');
        $currency = __('takeout.currency');
        $million = __('takeout.million');
        $thousand = __('takeout.thousand');
        
        $toLocaleNum = function ($num) use ($digits) {
            $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            return str_replace($english, $digits, (string) $num);
        };

        $formatPrice = function ($price) use ($toLocaleNum, $million, $thousand, $digits) {
            if ($price >= 1000000) {
                $millions = $price / 1000000;
                if ($price % 1000000 == 0) {
                    return $toLocaleNum((int)$millions) . ' ' . $million;
                } else {
                    $formatted = number_format($millions, 1, '.', '');
                    $parts = explode('.', $formatted);
                    $decimalSeparator = ($digits[0] === '۰') ? '٫' : '.';
                    return $toLocaleNum($parts[0]) . $decimalSeparator . $toLocaleNum($parts[1]) . ' ' . $million;
                }
            } elseif ($price >= 1000) {
                $thousands = round($price / 1000);
                return $toLocaleNum($thousands) . ' ' . $thousand;
            } else {
                return $toLocaleNum($price);
            }
        };

        $formatPriceFull = function ($price) use ($toLocaleNum, $currency) {
            return $toLocaleNum(number_format($price)) . ' ' . $currency;
        };

        // دریافت آیتم‌های فعال به‌همراه دسته‌بندی
        $takeouts = MenuTakeout::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $menu = [];
        $row = 1;

        foreach ($takeouts as $item) {
            // دریافت نام و توضیحات به زبان جاری
            $itemName        = $item->getNameInLocale($locale);
            $itemDescription = $item->getDescriptionInLocale($locale);

            // نام دسته‌بندی با توجه به زبان جاری (با fallback به نام فارسی)
            if ($item->category) {
                $categoryName = $item->category->{'name_' . $locale}
                    ?? $item->category->name_fa
                    ?? __('takeout.without_category');
            } else {
                $categoryName = __('takeout.without_category');
            }

            $price = (float) $item->price;
            $images = $item->getImagesUrls();

            $menu[] = [
                'id'                  => $item->id,
                'row'                 => $row++,
                'name'                => $itemName,
                'description'         => $itemDescription,
                'category'            => $categoryName,
                'price'               => $price,
                'formatted_price'     => $formatPrice($price),
                'formatted_price_full' => $formatPriceFull($price),
                'images'              => $images,
                'main_image'          => $images[0] ?? null,
            ];
        }

        // گروه‌بندی بر اساس category
        $grouped = [];
        foreach ($menu as $item) {
            $category = $item['category'];
            $grouped[$category][] = $item;
        }

        $prices = array_column($menu, 'price');
        $maxPrice = !empty($prices) ? max($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPriceFormatted = $formatPriceFull($maxPrice);
        $totalItems = count($menu);
        $initialCountFormatted = $toLocaleNum($totalItems);
        $categories = array_keys($grouped);

        return view('front.pages.takeout', array_merge(
            compact(
                'grouped',
                'categories',
                'maxPrice',
                'minPrice',
                'maxPriceFormatted',
                'initialCountFormatted'
            ),
            [
                'hideHeader' => true,
                'hideFooter' => false,
            ]
        ));
    }
}