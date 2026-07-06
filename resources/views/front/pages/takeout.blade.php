@extends('front.layouts.app')
@section('title', 'منوی بیرون‌بر')
@section('content')
@php
    if (!isset($menu)) {
        $menuJson = '[
            {"ردیف":1,"اسم_غذا_فارسی":"استیک با سس قارچ","اسم_غذا_لاتین":"Steak with Mushroom Sauce","نوع":"غذاهای فرنگی","قیمت":1800000,"جزئیات":"استیک گوساله- سس قارچ خامه‌ای- پوره سیب‌زمینی- سبزیجات گریل"},
            {"ردیف":2,"اسم_غذا_فارسی":"استیک با سس فلفل","اسم_غذا_لاتین":"Steak with Pepper Sauce","نوع":"غذاهای فرنگی","قیمت":1850000,"جزئیات":"استیک گوساله- سس فلفل سیاه- سیب‌زمینی سرخ‌کرده- سبزیجات"},
            {"ردیف":3,"اسم_غذا_فارسی":"فیله مینیون","اسم_غذا_لاتین":"Filet Mignon","نوع":"غذاهای فرنگی","قیمت":2200000,"جزئیات":"فیله گوساله- پوره سیب‌زمینی- مارچوبه گریل- سس دلخواه"},
            {"ردیف":4,"اسم_غذا_فارسی":"بیف استروگانف","اسم_غذا_لاتین":"Beef Stroganoff","نوع":"غذاهای فرنگی","قیمت":1700000,"جزئیات":"گوشت گوساله- سس قارچ و خامه- همراه برنج زعفرانی"},
            {"ردیف":5,"اسم_غذا_فارسی":"چیکن استروگانف","اسم_غذا_لاتین":"Chicken Stroganoff","نوع":"غذاهای فرنگی","قیمت":1300000,"جزئیات":"فیله مرغ- سس قارچ و خامه- همراه برنج زعفرانی"},
            {"ردیف":6,"اسم_غذا_فارسی":"شنیسل مرغ","اسم_غذا_لاتین":"Chicken Schnitzel","نوع":"غذاهای فرنگی","قیمت":1200000,"جزئیات":"سینه مرغ سوخاری- سیب‌زمینی سرخ‌کرده- سس گوجه فرنگی"},
            {"ردیف":7,"اسم_غذا_فارسی":"میگو سوخاری","اسم_غذا_لاتین":"Fried Shrimp","نوع":"غذاهای دریایی","قیمت":1600000,"جزئیات":"میگو سوخاری- سس تارتار- سیب‌زمینی سرخ‌کرده"},
            {"ردیف":8,"اسم_غذا_فارسی":"میگو پفکی","اسم_غذا_لاتین":"Shrimp Tempura","نوع":"غذاهای دریایی","قیمت":1700000,"جزئیات":"میگو تمپورا- سس تریاکی- سالاد کلم"},
            {"ردیف":9,"اسم_غذا_فارسی":"ماهی کبابی","اسم_غذا_لاتین":"Grilled Fish","نوع":"غذاهای دریایی","قیمت":1200000,"جزئیات":"فیله ماهی سفید کبابی- برنج یا سبزیجات- سس لیمو"},
            {"ردیف":10,"اسم_غذا_فارسی":"میگو کبابی","اسم_غذا_لاتین":"Grilled Shrimp","نوع":"غذاهای دریایی","قیمت":1800000,"جزئیات":"میگو کبابی- برنج زعفرانی- سبزیجات گریل- سس مخصوص"},
            {"ردیف":11,"اسم_غذا_فارسی":"پاستا آلفردو چیکن دودی","اسم_غذا_لاتین":"Smoked Chicken Alfredo Pasta","نوع":"انواع پاستا","قیمت":1400000,"جزئیات":"پاستا- سس آلفردو- تکه‌های مرغ دودی- پنیر پارمزان"},
            {"ردیف":12,"اسم_غذا_فارسی":"پاستا بیف","اسم_غذا_لاتین":"Beef Pasta","نوع":"انواع پاستا","قیمت":1600000,"جزئیات":"پاستا- گوشت گوساله- سس گوجه و ریحان- پنیر"},
            {"ردیف":13,"اسم_غذا_فارسی":"جوجه چینی","اسم_غذا_لاتین":"Chinese Chicken","نوع":"غذاهای فرنگی","قیمت":1300000,"جزئیات":"تکه‌های مرغ- سس سویا و سبزیجات- برنج چینی"},
            {"ردیف":14,"اسم_غذا_فارسی":"چیکن راک","اسم_غذا_لاتین":"Rock Chicken","نوع":"غذاهای فرنگی","قیمت":1400000,"جزئیات":"فیله مرغ گریل‌شده- ادویه مخصوص- برنج و سبزیجات"},
            {"ردیف":15,"اسم_غذا_فارسی":"شریمپ راک","اسم_غذا_لاتین":"Rock Shrimp","نوع":"غذاهای دریایی","قیمت":1800000,"جزئیات":"میگو گریل‌شده- ادویه مخصوص- برنج و سبزیجات"},
            {"ردیف":16,"اسم_غذا_فارسی":"استیک مرغ با سس قارچ","اسم_غذا_لاتین":"Chicken Steak with Mushroom Sauce","نوع":"غذاهای فرنگی","قیمت":1400000,"جزئیات":"استیک سینه مرغ- سس قارچ خامه‌ای- پوره سیب‌زمینی"},
            {"ردیف":17,"اسم_غذا_فارسی":"فیله سوخاری","اسم_غذا_لاتین":"Fried Chicken Fillet","نوع":"غذاهای فرنگی","قیمت":1200000,"جزئیات":"فیله مرغ سوخاری- سیب‌زمینی سرخ‌کرده- سس کچاپ"},
            {"ردیف":18,"اسم_غذا_فارسی":"ماهی قزل‌آلا کبابی","اسم_غذا_لاتین":"Grilled Trout","نوع":"غذاهای دریایی","قیمت":1100000,"جزئیات":"قزل‌آلای کامل کبابی- برنج زعفرانی- سبزیجات و لیمو"},
            {"ردیف":19,"اسم_غذا_فارسی":"ماهی قزل‌آلا سرخ کرده","اسم_غذا_لاتین":"Fried Trout","نوع":"غذاهای دریایی","قیمت":1000000,"جزئیات":"قزل‌آلای سرخ‌شده- برنج یا سیب‌زمینی- سس تارتار"},
            {"ردیف":20,"اسم_غذا_فارسی":"ماهی قزل‌آلا گریل","اسم_غذا_لاتین":"Grilled Trout","نوع":"غذاهای دریایی","قیمت":1100000,"جزئیات":"قزل‌آلای گریل‌شده- سبزیجات تازه- برنج و لیمو"},
            {"ردیف":21,"اسم_غذا_فارسی":"ماهی سالمون","اسم_غذا_لاتین":"Salmon","نوع":"غذاهای دریایی","قیمت":1900000,"جزئیات":"فیله سالمون گریل‌شده- پوره سیب‌زمینی- مارچوبه"},
            {"ردیف":22,"اسم_غذا_فارسی":"کباب میکس دریایی","اسم_غذا_لاتین":"Mixed Seafood Kebab","نوع":"غذاهای دریایی","قیمت":2000000,"جزئیات":"ماهی- میگو- اسکوئید کبابی- برنج و سس"},
            {"ردیف":23,"اسم_غذا_فارسی":"سینی میکس دریایی","اسم_غذا_لاتین":"Mixed Seafood Platter","نوع":"غذاهای دریایی","قیمت":2500000,"جزئیات":"انواع ماهی و میگو کبابی و سوخاری- برنج- سس‌های مخصوص"},
            {"ردیف":24,"اسم_غذا_فارسی":"سینی مخصوص","اسم_غذا_لاتین":"Special Platter","نوع":"سینی‌های مخصوص","قیمت":3500000,"جزئیات":"مجموعه‌ای از کباب‌ها و خوراک‌های ویژه رستوران- برنج- مخلفات"},
            {"ردیف":25,"اسم_غذا_فارسی":"میکس کباب‌ها فرنگی دریایی","اسم_غذا_لاتین":"Mixed Grill & Seafood Platter","نوع":"کباب‌ها","قیمت":3000000,"جزئیات":"استیک- میگو- ماهی کبابی- جوجه- برنج و سبزیجات"},
            {"ردیف":26,"اسم_غذا_فارسی":"چلو کره","اسم_غذا_لاتین":"Butter Rice","نوع":"غذاهای ایرانی","قیمت":800000,"جزئیات":"برنج زعفرانی با کره- همراه ماست و سالاد"},
            {"ردیف":27,"اسم_غذا_فارسی":"برنج تند عربی","اسم_غذا_لاتین":"Arabic Spicy Rice","نوع":"غذاهای فرنگی","قیمت":900000,"جزئیات":"برنج با ادویه‌جات تند عربی- خلال بادام و پسته"},
            {"ردیف":28,"اسم_غذا_فارسی":"پلو شوید","اسم_غذا_لاتین":"Dill Rice","نوع":"غذاهای ایرانی","قیمت":850000,"جزئیات":"برنج- شوید تازه- باقالی- کره"},
            {"ردیف":29,"اسم_غذا_فارسی":"پلو سبزی","اسم_غذا_لاتین":"Herbed Rice","نوع":"غذاهای ایرانی","قیمت":850000,"جزئیات":"برنج- سبزی معطر (تره، جعفری، شوید، گشنیز)- کره"},
            {"ردیف":30,"اسم_غذا_فارسی":"جوجه کباب ترش","اسم_غذا_لاتین":"Sour Chicken Kebab","نوع":"کباب‌ها","قیمت":1500000,"جزئیات":"جوجه خوابانده در آب‌انار و گردو- کبابی- برنج و کره"},
            {"ردیف":31,"اسم_غذا_فارسی":"کباب ترش","اسم_غذا_لاتین":"Torsh Kebab","نوع":"کباب‌ها","قیمت":1800000,"جزئیات":"گوشت ترش‌شده با آب‌انار و گردو- کبابی- برنج"},
            {"ردیف":32,"اسم_غذا_فارسی":"کباب مصری","اسم_غذا_لاتین":"Egyptian Kebab","نوع":"کباب‌ها","قیمت":1600000,"جزئیات":"گوشت با ادویه مصری- کبابی- برنج یا نان"},
            {"ردیف":33,"اسم_غذا_فارسی":"جوجه ماستی","اسم_غذا_لاتین":"Yogurt-Marinated Chicken Kebab","نوع":"کباب‌ها","قیمت":1400000,"جزئیات":"جوجه خوابانده در ماست و زعفران- کبابی- برنج و کره"},
            {"ردیف":34,"اسم_غذا_فارسی":"تکه ماستی","اسم_غذا_لاتین":"Mas Tekeh","نوع":"کباب‌ها","قیمت":1700000,"جزئیات":"تکه‌های گوشت ماستی (خوابانده در ماست)- کبابی- برنج"},
            {"ردیف":35,"اسم_غذا_فارسی":"شش طاووق","اسم_غذا_لاتین":"Shish Tawook","نوع":"کباب‌ها","قیمت":1500000,"جزئیات":"جوجه کباب ترکی با ماست و ادویه- کبابی- برنج یا نان- سیر"},
            {"ردیف":36,"اسم_غذا_فارسی":"کباب لوله عربی","اسم_غذا_لاتین":"Arabic Kofta Kebab","نوع":"کباب‌ها","قیمت":1300000,"جزئیات":"گوشت چرخ‌کرده با ادویه عربی- کبابی- برنج"},
            {"ردیف":37,"اسم_غذا_فارسی":"کباب مشکل","اسم_غذا_لاتین":"Mixed Kebab","نوع":"کباب‌ها","قیمت":2200000,"جزئیات":"میکس کباب برگ- جوجه- کوبیده- برنج"},
            {"ردیف":38,"اسم_غذا_فارسی":"کباب سوری","اسم_غذا_لاتین":"Syrian Kebab","نوع":"کباب‌ها","قیمت":1600000,"جزئیات":"کباب گوشت به سبک سوری- برنج- سبزیجات"},
            {"ردیف":39,"اسم_غذا_فارسی":"کباب شالتو (اصل لبنانی)","اسم_غذا_لاتین":"Shalto Kebab","نوع":"کباب‌ها","قیمت":1500000,"جزئیات":"گوشت چرخ‌کرده و جعفری لبنانی- کبابی- برنج"},
            {"ردیف":40,"اسم_غذا_فارسی":"کباب فیله باربیکیو با سس برنر","اسم_غذا_لاتین":"BBQ Fillet Kebab with Berner Sauce","نوع":"کباب‌ها","قیمت":2100000,"جزئیات":"فیله گوساله باربیکیو- سس برنر خامه‌ای- برنج و سبزیجات"},
            {"ردیف":41,"اسم_غذا_فارسی":"جوجه ترکی","اسم_غذا_لاتین":"Turkish Chicken Kebab","نوع":"کباب‌ها","قیمت":1400000,"جزئیات":"جوجه کباب ترکی با ادویه مخصوص- برنج- سالاد"},
            {"ردیف":42,"اسم_غذا_فارسی":"جوجه کباب کاردی","اسم_غذا_لاتین":"Chicken Kebab Kardi","نوع":"کباب‌ها","قیمت":1400000,"جزئیات":"جوجه کباب با چاشنی کاردی- برنج و کره"},
            {"ردیف":43,"اسم_غذا_فارسی":"کباب برگ","اسم_غذا_لاتین":"Barg Kebab","نوع":"کباب‌ها","قیمت":2000000,"جزئیات":"برگ گوساله- برنج زعفرانی- کره- گوجه کبابی"},
            {"ردیف":44,"اسم_غذا_فارسی":"کباب شاندیز","اسم_غذا_لاتین":"Shandiz Kebab","نوع":"کباب‌ها","قیمت":2100000,"جزئیات":"کباب برگ مخصوص شاندیز- برنج- گوجه و فلفل کبابی"},
            {"ردیف":45,"اسم_غذا_فارسی":"کباب تبریزی","اسم_غذا_لاتین":"Tabrizi Kebab","نوع":"کباب‌ها","قیمت":1500000,"جزئیات":"گوشت چرخ‌کرده با پیاز و ادویه تبریزی- برنج"},
            {"ردیف":46,"اسم_غذا_فارسی":"کباب جوجه با استخوان","اسم_غذا_لاتین":"Bone-In Chicken Kebab","نوع":"کباب‌ها","قیمت":1300000,"جزئیات":"جوجه با استخوان کبابی- برنج زعفرانی- کره"},
            {"ردیف":47,"اسم_غذا_فارسی":"سینی مخصوص کباب‌های عربی","اسم_غذا_لاتین":"Special Arabic Mixed Grill Platter","نوع":"کباب‌ها","قیمت":3200000,"جزئیات":"کباب لوله- شیش طاووق- کباب حلبی- برنج و مخلفات"},
            {"ردیف":48,"اسم_غذا_فارسی":"سینی میکس کباب‌های ایرانی و عربی","اسم_غذا_لاتین":"Persian and Arabic Mixed Grill Platter","نوع":"کباب‌ها","قیمت":3500000,"جزئیات":"کباب برگ- جوجه- کوبیده- کباب لوله- شیش طاووق- برنج"},
            {"ردیف":49,"اسم_غذا_فارسی":"سوپ روز","اسم_غذا_لاتین":"Soup of the day","نوع":"پیش غذا","قیمت":500000,"جزئیات":"سوپ تازه روز (جو، قارچ یا سبزیجات)"},
            {"ردیف":50,"اسم_غذا_فارسی":"قارچ سرخ کرده با کره سیر دار","اسم_غذا_لاتین":"Sauted Mushrooms with Garlic Butter","نوع":"پیش غذا","قیمت":600000,"جزئیات":"قارچ تفت‌داده- کره- سیر تازه"},
            {"ردیف":51,"اسم_غذا_فارسی":"سیب زمینی سرخ کرده","اسم_غذا_لاتین":"French Fries","نوع":"پیش غذا","قیمت":400000,"جزئیات":"سیب‌زمینی خلال‌شده سرخ‌شده- سس کچاپ"},
            {"ردیف":52,"اسم_غذا_فارسی":"سالاد سزار (سوخاری یا گریل)","اسم_غذا_لاتین":"Caesar Salad (Fried or Grilled Chicken)","نوع":"سالادها","قیمت":700000,"جزئیات":"کاهو- سس سزار- پنیر پارمزان- فیله مرغ (سوخاری یا گریل)"},
            {"ردیف":53,"اسم_غذا_فارسی":"سالاد استیک گوشت با فیله","اسم_غذا_لاتین":"Beef Fillet Steak Salad","نوع":"سالادها","قیمت":1000000,"جزئیات":"سبزیجات تازه- تکه‌های استیک فیله گوساله- سس بالزامیک"},
            {"ردیف":54,"اسم_غذا_فارسی":"سالاد فتوش","اسم_غذا_لاتین":"Fattoush Salad","نوع":"سالادها","قیمت":500000,"جزئیات":"سبزیجات- نان سرخ‌شده- سماق- سس انار"},
            {"ردیف":55,"اسم_غذا_فارسی":"سالاد تبوله","اسم_غذا_لاتین":"Tabbouleh Salad","نوع":"سالادها","قیمت":500000,"جزئیات":"بلغور- جعفری- گوجه- نعناع- لیمو"},
            {"ردیف":56,"اسم_غذا_فارسی":"سالاد شیرازی","اسم_غذا_لاتین":"Shirazi Salad","نوع":"سالادها","قیمت":400000,"جزئیات":"خیار- گوجه- پیاز- نعناع خشک- آبلیمو"},
            {"ردیف":57,"اسم_غذا_فارسی":"سینی مزه عربی","اسم_غذا_لاتین":"Arabic Mezze Platter","نوع":"پیش غذا","قیمت":1200000,"جزئیات":"حمص- متبل- تبوله- فتوش- نان عربی"},
            {"ردیف":58,"اسم_غذا_فارسی":"سالاد اندونزی","اسم_غذا_لاتین":"Indonesian Salad","نوع":"سالادها","قیمت":600000,"جزئیات":"سبزیجات ترد- جوانه- سس بادام‌زمینی تند"},
            {"ردیف":59,"اسم_غذا_فارسی":"حمص","اسم_غذا_لاتین":"Hummus","نوع":"پیش غذا","قیمت":500000,"جزئیات":"نخود پخته- ارده- سیر- لیمو- روغن زیتون"},
            {"ردیف":60,"اسم_غذا_فارسی":"متبل","اسم_غذا_لاتین":"Moutabel","نوع":"پیش غذا","قیمت":500000,"جزئیات":"بادمجان کبابی- ارده- سیر- لیمو- روغن زیتون"},
            {"ردیف":61,"اسم_غذا_فارسی":"سینی مخصوص","اسم_غذا_لاتین":"Special Platter","نوع":"سینی‌های مخصوص","قیمت":4000000,"جزئیات":"چلو لقمه- چلو جوجه زعفرانی- زرشک پلو با مرغ- چلوخورشت قیمه"},
            {"ردیف":62,"اسم_غذا_فارسی":"سینی همایونی","اسم_غذا_لاتین":"Homayouni Platter","نوع":"سینی‌های مخصوص","قیمت":5500000,"جزئیات":"باقالی پلو با ماهیچه- چلو برگ مخصوص- چلو لقمه مخصوص-چلو خورشت قرمه"},
            {"ردیف":63,"اسم_غذا_فارسی":"سینی موراکو","اسم_غذا_لاتین":"Morocco Platter","نوع":"سینی‌های مخصوص","قیمت":4200000,"جزئیات":"باقالی پلو با ماهیچه- چلوجوجه زعفرانی- سبزی پلو با ماهی سرخ شده"},
            {"ردیف":64,"اسم_غذا_فارسی":"سینی عمارت","اسم_غذا_لاتین":"Mansion Platter","نوع":"سینی‌های مخصوص","قیمت":4500000,"جزئیات":"چلو ماهی کباب- چلو جوجه با استخوان-چلو برگ مخصوص- چلو بختیاری"},
            {"ردیف":65,"اسم_غذا_فارسی":"سینی 3 نفره","اسم_غذا_لاتین":"Platter for three","نوع":"سینی‌های مخصوص","قیمت":3500000,"جزئیات":"چلو لقمه-چلو خورشت- چلوجوجه زعفرانی- چلو قیمه- چلو قرمه"},
            {"ردیف":66,"اسم_غذا_فارسی":"سینی 2 نفره","اسم_غذا_لاتین":"Platter for two","نوع":"سینی‌های مخصوص","قیمت":25000000,"جزئیات":"کاسه کباب دونفره"},
            {"ردیف":67,"اسم_غذا_فارسی":"سینی ویژه","اسم_غذا_لاتین":"Chef\'s Special Platter","نوع":"سینی‌های مخصوص","قیمت":4000000,"جزئیات":"چلو ماهی کباب- چلو لقمه مخصوص-چلو برگ مخصوص- زرشک پلو با مرغ"}
        ]';
        $menu = json_decode($menuJson, true);
    }

    // گروه‌بندی منو بر اساس نوع برای ساخت پنل‌های مجزا
    $grouped = [];
    foreach ($menu as $item) {
        $category = $item['نوع'] ?? 'سایر';
        $grouped[$category][] = $item;
    }

    function toPersianNum($num) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($english, $persian, (string) $num);
    }
    
    function formatPriceFull($price) {
        return toPersianNum(number_format($price)) . ' تومان';
    }
    
    function formatPrice($price) {
        if ($price >= 1000000) {
            $millions = $price / 1000000;
            if ($price % 1000000 == 0) {
                return toPersianNum((int)$millions) . ' میلیون';
            } else {
                $formatted = number_format($millions, 1, '.', '');
                $parts = explode('.', $formatted);
                return toPersianNum($parts[0]) . '٫' . toPersianNum($parts[1]) . ' میلیون';
            }
        } elseif ($price >= 1000) {
            $thousands = round($price / 1000);
            return toPersianNum($thousands) . ' هزار';
        } else {
            return toPersianNum($price);
        }
    }

    $prices = array_column($menu, 'قیمت');
    $maxPrice = !empty($prices) ? max($prices) : 0;
    $minPrice = !empty($prices) ? min($prices) : 0;
@endphp

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .glow-panel {
        box-shadow: 0 15px 35px rgba(0,0,0,0.8), 0 0 20px rgba(255, 215, 0, 0.15);
        transition: box-shadow 0.4s ease, border-color 0.4s ease;
    }
    .glow-panel:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.9), 0 0 30px rgba(255, 215, 0, 0.3);
        border-color: #ffe55c;
    }
    
    .menu-dots {
        flex-grow: 1;
        border-bottom: 2px dotted rgba(255, 215, 0, 0.3);
        margin: 0 15px;
        position: relative;
        top: -8px;
        opacity: 0.7;
    }
    :root {
        --royal-yellow: #FFD700;
        --royal-yellow-dark: #B8860B;
        --royal-yellow-light: #FFED4A;
        --crimson: #DC143C;
        --crimson-dark: #8B0000;
        --crimson-light: #FF6B6B;
        --dark-bg: #0a0a0a;
        --dark-panel: #1a1a1a;
        --dark-border: #2a2a2a;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% center;
        }
        100% {
            background-position: 200% center;
        }
    }

    .shimmer-text {
        background: linear-gradient(
            90deg,
            var(--royal-yellow) 0%,
            var(--royal-yellow-light) 25%,
            var(--crimson-light) 50%,
            var(--royal-yellow-light) 75%,
            var(--royal-yellow) 100%
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmer 3s linear infinite;
    }

    @keyframes textShimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
    .animate-shimmer-text {
        background: linear-gradient(90deg, #ffd700 0%, #fff3b0 25%, #ffb700 50%, #fff3b0 75%, #ffd700 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShimmer 4s linear infinite;
    }
</style>


<div class="min-h-screen bg-[#070203] text-gray-100 antialiased selection:bg-[#ffd700] selection:text-black">
    
<div class="min-h-screen bg-[#0a0a0a] text-gray-100 antialiased selection:bg-[#DC143C] selection:text-white">

    <div class="relative overflow-hidden py-16 text-center border-b-2 border-[#FFD700]/20 bg-linear-to-b from-[#1a0a0a] to-[#0a0a0a]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(220,20,60,0.1)_0%,rgba(255,215,0,0.05)_50%,transparent_70%)]"></div>
        
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, #FFD700 0px, #FFD700 1px, transparent 1px, transparent 20px), repeating-linear-gradient(-45deg, #DC143C 0px, #DC143C 1px, transparent 1px, transparent 20px);"></div>
        </div>
        
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-black tracking-wider shimmer-text drop-shadow-[0_2px_15px_rgba(255,215,0,0.3)]">
                منوی بیرون‌بر
            </h1>
            <p class="mt-4 text-sm md:text-base tracking-[0.3em] uppercase text-[#FFD700]/70 font-medium">
                سفارش آنلاین - تحویل سریع
            </p>
            <div class="mt-6 flex justify-center gap-3">
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
                <span class="w-3 h-3 bg-[#DC143C] rounded-full shadow-[0_0_10px_rgba(220,20,60,0.5)]"></span>
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-30 mb-12">
        <div class="bg-[#140507]/80 backdrop-blur-xl border border-[#ffd700]/30 rounded-2xl p-5 shadow-[0_15px_40px_rgba(0,0,0,0.6),0_0_15px_rgba(255,215,0,0.1)]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
                <div class="relative group">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 group-focus-within:text-[#ffd700] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="search-input" 
                        placeholder="جستجوی غذا یا ترکیبات..." 
                        class="w-full bg-[#0a0203] text-sm text-gray-100 pr-11 pl-4 py-3.5 rounded-xl border border-[#ffd700]/20 focus:outline-none focus:border-[#ffd700] focus:ring-1 focus:ring-[#ffd700] transition-all duration-300 placeholder-gray-600">
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <span class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ffd700] animate-pulse"></span> سقف قیمت:
                        </span>
                        <span id="price-val" class="font-bold text-[#ffd700] text-sm bg-[#0a0203] px-3 py-1 rounded-md border border-[#ffd700]/20">
                            {{ formatPriceFull($maxPrice) }}
                        </span>
                    </div>
                    <input type="range" id="price-slider" 
                        min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="50000"
                        class="w-full accent-[#ffd700] h-1.5 bg-[#2a050a] rounded-lg cursor-pointer appearance-none">
                </div>

                <div class="text-left md:text-left text-sm text-gray-400 flex justify-end items-center gap-3">
                    <span>موارد یافت شده:</span>
                    <span id="items-count" class="text-lg font-black text-[#070203] bg-linear-to-r from-[#ffd700] to-[#dfb15b] px-4 py-1 rounded-xl shadow-[0_0_10px_rgba(255,215,0,0.3)]">
                        {{ toPersianNum(count($menu)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        
        <div id="empty-state" class="hidden text-center py-24 bg-[#140507]/50 rounded-3xl border border-dashed border-[#ffd700]/30 max-w-xl mx-auto backdrop-blur-md">
            <svg class="w-20 h-20 text-[#ffd700]/40 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-[#ffd700]">آیتمی یافت نشد</h3>
            <p class="text-sm text-gray-400 mt-2">لطفاً فیلترها یا عبارت جستجوی خود را تغییر دهید.</p>
        </div>

        <div id="menu-container" class="space-y-16">
            @foreach($grouped as $category => $items)
                <div class="category-section group/section" data-category="{{ $category }}">
                    
                    {{-- عنوان دسته‌بندی با استایل پویای دسکتاپ --}}
                    <div class="flex items-center gap-4 mb-8">
                        <div class="hidden md:flex w-10 h-10 bg-linear-to-br from-[#2a050a] to-[#140507] rounded-xl items-center justify-center border border-[#ffd700]/30 shadow-[0_0_15px_rgba(255,215,0,0.15)] transform -rotate-3 group-hover/section:rotate-0 transition-transform duration-300">
                            <svg class="w-5 h-5 text-[#ffd700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.232.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black text-transparent bg-clip-text bg-linear-to-r from-[#ffd700] to-[#fff3b0] drop-shadow-[0_0_8px_rgba(255,215,0,0.5)] md:animate-shimmer-text">
                            {{ $category }}
                        </h2>
                        <div class="h-px flex-1 bg-linear-to-r from-[#ffd700]/40 to-transparent"></div>
                    </div>

                    {{-- حالت موبایل (بدون هیچ تغییری حفظ شده است) --}}
                    <div class="md:hidden flex overflow-x-auto snap-x snap-mandatory gap-5 pb-6 hide-scrollbar pt-2 px-2 -mx-2">
                        @foreach($items as $item)
                            @php
                                $imageNumber = fmod($item['ردیف'] - 1, 12) + 1;
                                $imagePath = asset("assets/images/menu/{$imageNumber}.webp");
                            @endphp
                            <div class="menu-item-mobile snap-center shrink-0 w-70 bg-linear-to-br from-[#1c0408] to-[#0a0203] border border-[#ffd700]/20 rounded-2xl overflow-hidden shadow-lg relative flex flex-col"
                                data-price="{{ $item['قیمت'] }}"
                                data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}">
                                
                                <div class="relative h-40 w-full overflow-hidden">
                                    <img src="{{ $imagePath }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-linear-to-t from-[#0a0203] via-transparent to-transparent"></div>
                                </div>
                                
                                <div class="p-5 pt-3 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-[#ffd700] mb-1">{{ $item['اسم_غذا_فارسی'] }}</h3>
                                    <p class="text-xs text-gray-500 mb-2 font-mono uppercase tracking-wider">{{ $item['اسم_غذا_لاتین'] }}</p>
                                    <p class="text-xs text-gray-400 leading-relaxed text-justify opacity-90 flex-1">
                                        {{ $item['جزئیات'] }}
                                    </p>
                                    
                                    <div class="mt-4 pt-4 border-t border-[#ffd700]/10 flex justify-between items-center">
                                        <span class="text-[10px] text-gray-500 bg-[#2a050a] px-2 py-1 rounded">بیرون‌بر</span>
                                        <span class="text-base font-black text-[#ffd700]">{{ formatPrice($item['قیمت']) }} <span class="text-[10px] font-normal text-gray-400">تومان</span></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- حالت دسکتاپ: بازنویسی شده با ساختار سه بعدی، تصاویر بزرگتر و بهینه‌سازی انیمیشن‌ها --}}
                    <div class="hidden md:block relative transition-all duration-500 perspective-[1000px] transform-3d hover:transform-[translateZ(8px)_rotateX(0.5deg)] bg-linear-to-br from-[#140507] to-[#050102] border border-[#ffd700]/30 rounded-3xl p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.7),inset_0_0_20px_rgba(255,215,0,0.02)] hover:shadow-[0_25px_60px_rgba(255,215,0,0.1)]">
                        
                        {{-- هاله نوری پس زمینه پنل در زمان هاور دسکتاپ --}}
                        <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#ffd700]/5 rounded-full blur-3xl pointer-events-none transition-opacity duration-500 group-hover/section:opacity-100"></div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6 relative z-10">
                            @foreach($items as $item)
                                @php
                                    $imageNumber = fmod($item['ردیف'] - 1, 12) + 1;
                                    $imagePath = asset("assets/images/menu/{$imageNumber}.webp");
                                @endphp
                                <div class="menu-item-desktop group flex gap-6 p-4 rounded-2xl bg-[#0a0203]/40 border border-[#ffd700]/10 hover:border-[#ffd700]/40 transition-all duration-300 hover:shadow-[0_10px_25px_rgba(0,0,0,0.5),0_0_15px_rgba(255,215,0,0.05)]"
                                    data-price="{{ $item['قیمت'] }}"
                                    data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}">
                                    
                                    {{-- تصویر بهینه شده دسکتاپ با ابعاد بزرگتر و افکت ترنزیشن --}}
                                    <div class="shrink-0 w-32 h-32 lg:w-36 lg:h-36 rounded-xl overflow-hidden border border-[#ffd700]/20 shadow-[0_5px_15px_rgba(0,0,0,0.4)] relative">
                                        <img src="{{ $imagePath }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-linear-to-t from-[#0a0203]/40 to-transparent"></div>
                                    </div>
                                    
                                    {{-- جزییات محصول --}}
                                    <div class="flex-1 flex flex-col justify-between min-w-0 py-1">
                                        <div>
                                            <div class="flex items-start justify-between gap-4">
                                                <h3 class="text-lg lg:text-xl font-bold text-gray-100 group-hover:text-[#ffd700] transition-colors duration-300 truncate">
                                                    {{ $item['اسم_غذا_فارسی'] }}
                                                </h3>
                                                {{-- بج قیمت با دیزاین گلس‌مورفیسم به سبک تم اصلی شما --}}
                                                <div class="shrink-0 bg-[#2a050a]/60 px-3 py-1 rounded-lg border border-[#ffd700]/30 shadow-[0_0_10px_rgba(255,215,0,0.1)]">
                                                    <span class="text-base font-black text-[#ffd700]">
                                                        {{ formatPrice($item['قیمت']) }}
                                                        <span class="text-[10px] font-normal text-gray-400 mr-0.5">تومان</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 font-mono tracking-wider uppercase mt-0.5 opacity-80">
                                                {{ $item['اسم_غذا_لاتین'] }}
                                            </p>
                                        </div>

                                        <p class="text-xs lg:text-sm text-gray-400/90 leading-relaxed text-justify line-clamp-2 mt-2 group-hover:text-gray-300 transition-colors">
                                            {{ $item['جزئیات'] }}
                                        </p>

                                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-[#ffd700]/5">
                                            <span class="text-[10px] text-gray-400 bg-[#140507] px-2 py-0.5 rounded border border-[#ffd700]/10">بیرون‌بر</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#ffd700]/40 group-hover:bg-[#ffd700] group-hover:scale-125 transition-all duration-300"></span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search-input');
        const priceSlider = document.getElementById('price-slider');
        const priceVal = document.getElementById('price-val');
        const itemsCountBadge = document.getElementById('items-count');
        const menuContainer = document.getElementById('menu-container');
        const emptyState = document.getElementById('empty-state');
        const categorySections = document.querySelectorAll('.category-section');

        function toPersianNumber(num) {
            const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return num.toString().replace(/\d/g, x => persianDigits[x]);
        }

        function formatSliderPrice(price) {
            return new Intl.NumberFormat('fa-IR').format(price) + ' تومان';
        }

        function filterEngine() {
            const query = searchInput.value.toLowerCase().trim();
            const maxPrice = parseInt(priceSlider.value);
            
            priceVal.textContent = formatSliderPrice(maxPrice);
            let totalVisibleItems = 0;

            categorySections.forEach(section => {
                const mobileItems = section.querySelectorAll('.menu-item-mobile');
                const desktopItems = section.querySelectorAll('.menu-item-desktop');
                let sectionHasVisibleItem = false;

                // تابع کمکی برای بررسی و اعمال استایل روی آیتم‌ها
                const processItems = (items) => {
                    items.forEach(item => {
                        const itemPrice = parseInt(item.dataset.price);
                        const searchKeys = item.dataset.searchKeys;

                        const matchPrice = itemPrice <= maxPrice;
                        const matchSearch = !query || searchKeys.includes(query);

                        if (matchPrice && matchSearch) {
                            item.style.display = ''; // بازگشت به حالت پیش‌فرض (flex/block)
                            sectionHasVisibleItem = true;
                            totalVisibleItems++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                };

                processItems(mobileItems);
                
                // از آنجایی که در موبایل و دسکتاپ آیتم‌ها دو بار رندر شده‌اند، برای شمارش دقیق،
                // فقط یکی را می‌شماریم. متغیر totalVisibleItems را تقسیم بر 2 می‌کنیم.
                processItems(desktopItems);

                // اگر دسته‌بندی هیچ آیتم فعالی نداشت، کل پنل/سکشن مخفی شود
                if (sectionHasVisibleItem) {
                    section.style.display = 'block';
                    // انیمیشن نرم با GSAP اگر در پروژه لود شده باشد
                    if(typeof gsap !== 'undefined') {
                        gsap.to(section, {opacity: 1, duration: 0.3});
                    } else {
                        section.style.opacity = '1';
                    }
                } else {
                    section.style.display = 'none';
                    section.style.opacity = '0';
                }
            });

            // محاسبه واقعی تعداد آیتم‌ها (چون هر آیتم ۲ بار رندر شده - موبایل و دسکتاپ)
            const actualVisibleCount = totalVisibleItems / 2;
            itemsCountBadge.textContent = toPersianNumber(actualVisibleCount);

            // مدیریت نمایش Empty State
            if (actualVisibleCount === 0) {
                emptyState.classList.remove('hidden');
                menuContainer.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                menuContainer.classList.remove('hidden');
            }
        }

        priceSlider.addEventListener('input', filterEngine);
        searchInput.addEventListener('input', filterEngine);

        // انیمیشن اولیه هنگام لود صفحه (استفاده از GSAP در صورت وجود)
        if (typeof gsap !== 'undefined') {
            gsap.from('.category-section', {
                opacity: 0,
                y: 40,
                duration: 0.8,
                stagger: 0.15,
                ease: 'power3.out'
            });
        }
    });
</script>
@endsection