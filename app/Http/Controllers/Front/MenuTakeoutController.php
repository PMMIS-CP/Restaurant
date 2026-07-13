<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuTakeoutController extends Controller
{
    public function index()
    {
        // منوی پیش‌فرض (در صورت نبود داده از دیتابیس)
        $menuJson = '[
            {"ردیف":1,"اسم_غذا_فارسی":"استیک با سس قارچ","اسم_غذا_لاتین":"Steak with Mushroom Sauce","نوع":"غذاهای فرنگی","قیمت":1800000,"جزئیات":"استیک گوساله- سس قارچ خامه‌ای- پوره سیب‌زمینی- سبزیجات گریل"},
            {"ردیف":2,"اسم_غذا_فارسی":"استیک با سس فلفل","اسم_غذا_لاتین":"Steak with Pepper Sauce","نوع":"غذاهای فرنگی","قیمت":1850000,"جزئیات":"استیک گوساله- سس فلفل سیاه- سیب‌زمینی سرخ‌کرده- سبزیجات"},
            {"ردیف":3,"اسم_غذا_فارسی":"فیله مینیون","اسم_غذا_لاتین":"Filet Mignon","نوع":"غذاهای فرنگی","قیمت":2200000,"جزئیات":"فیله گوساله- پوره سیب‌زمینی- مارچوبه گریل- سس دلخواه"},
            {"ردیف":4,"اسم_غذا_فارسی":"کباب شاندیز","اسم_غذا_لاتین":"Shandiz Kebab","نوع":"کباب‌ها","قیمت":2100000,"جزئیات":"کباب برگ مخصوص شاندیز- برنج- گوجه و فلفل کبابی"},
            {"ردیف":5,"اسم_غذا_فارسی":"کباب تبریزی","اسم_غذا_لاتین":"Tabrizi Kebab","نوع":"کباب‌ها","قیمت":1500000,"جزئیات":"گوشت چرخ‌کرده با پیاز و ادویه تبریزی- برنج"},
            {"ردیف":6,"اسم_غذا_فارسی":"سالاد اندونزی","اسم_غذا_لاتین":"Indonesian Salad","نوع":"سالادها","قیمت":600000,"جزئیات":"سبزیجات ترد- جوانه- سس بادام‌زمینی تند"},
            {"ردیف":7,"اسم_غذا_فارسی":"حمص","اسم_غذا_لاتین":"Hummus","نوع":"پیش غذا","قیمت":500000,"جزئیات":"نخود پخته- ارده- سیر- لیمو- روغن زیتون"},
            {"ردیف":8,"اسم_غذا_فارسی":"سینی ویژه","اسم_غذا_لاتین":"Chef\'s Special Platter","نوع":"سینی‌های مخصوص","قیمت":4000000,"جزئیات":"چلو ماهی کباب- چلو لقمه مخصوص-چلو برگ مخصوص- زرشک پلو با مرغ"}
        ]';

        $menu = json_decode($menuJson, true);

        // توابع کمکی برای فرمت قیمت
        $toPersianNum = function($num) {
            $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            return str_replace($english, $persian, (string) $num);
        };

        $formatPrice = function($price) use ($toPersianNum) {
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

        $formatPriceFull = function($price) use ($toPersianNum) {
            return $toPersianNum(number_format($price)) . ' تومان';
        };

        // افزودن قیمت فرمت‌شده به هر آیتم
        foreach ($menu as &$item) {
            $item['formatted_price'] = $formatPrice($item['قیمت']);
        }
        unset($item);

        // گروه‌بندی بر اساس نوع
        $grouped = [];
        foreach ($menu as $item) {
            $category = $item['نوع'] ?? 'سایر';
            $grouped[$category][] = $item;
        }

        $prices = array_column($menu, 'قیمت');
        $maxPrice = !empty($prices) ? max($prices) : 0;
        $minPrice = !empty($prices) ? min($prices) : 0;
        $maxPriceFormatted = $formatPriceFull($maxPrice);
        $totalItems = count($menu);
        $initialCountPersian = $toPersianNum($totalItems);
        $categories = array_unique(array_column($menu, 'نوع'));

        return view('front.pages.takeout', array_merge(
            compact('grouped', 'categories', 'maxPrice', 'minPrice', 'maxPriceFormatted', 'initialCountPersian'),
            [
                'hideHeader' => true,
                'hideFooter' => true
            ]
        ));
    }
}