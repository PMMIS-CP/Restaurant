@extends('front.layouts.app')
@section('title', 'منو')
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
            // برای اعداد میلیونی: تقسیم بر 1 میلیون و گرد کردن به 1 رقم اعشار
            $millions = $price / 1000000;
            // اگر عدد صحیح است، اعشار نشان نده
            if ($price % 1000000 == 0) {
                return toPersianNum((int)$millions) . ' میلیون تومان';
            } else {
                // گرد کردن به 1 رقم اعشار و تبدیل نقطه به ممیز فارسی
                $formatted = number_format($millions, 1, '.', '');
                $parts = explode('.', $formatted);
                return toPersianNum($parts[0]) . '٫' . toPersianNum($parts[1]) . ' میلیون تومان';
            }
        } elseif ($price >= 1000) {
            // برای اعداد هزارتایی
            $thousands = round($price / 1000);
            return toPersianNum($thousands) . ' هزار تومان';
        } else {
            // برای اعداد کمتر از 1000
            return toPersianNum($price) . ' تومان';
        }
    }
@endphp

@php
    // استخراج منحصر به فرد دسته‌بندی‌ها برای ساخت منوی اسلایدر بالا
    $categories = array_unique(array_column($menu, 'نوع'));
    
    // محاسبه حداقل و حداکثر قیمت برای تنظیم خودکار اسلایدر فیلتر قیمت
    $prices = array_column($menu, 'قیمت');
    $maxPrice = !empty($prices) ? max($prices) : 0;
    $minPrice = !empty($prices) ? min($prices) : 0;
@endphp
@php
    $menuArray = json_decode($menuJson, true);

    foreach ($menuArray as $item) {
        $imageNumber = fmod($item['ردیف'] - 1, 12) + 1;
        
        $imagePath = asset("assets/images/menu/{$imageNumber}.webp");
    }
@endphp

<style>
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
</style>

<div class="min-h-screen bg-[#090506] text-gray-100 antialiased selection:bg-[#bc1c24] selection:text-white">

    <div class="relative overflow-hidden py-16 text-center border-b-2 border-[#FFD700]/20 bg-linear-to-b from-[#1a0a0a] to-[#0a0a0a]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(220,20,60,0.1)_0%,rgba(255,215,0,0.05)_50%,transparent_70%)]"></div>
        
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, #FFD700 0px, #FFD700 1px, transparent 1px, transparent 20px), repeating-linear-gradient(-45deg, #DC143C 0px, #DC143C 1px, transparent 1px, transparent 20px);"></div>
        </div>
        
        <div class="relative z-10">
            <h1 class="text-4xl md:text-6xl font-black tracking-wider shimmer-text drop-shadow-[0_2px_15px_rgba(255,215,0,0.3)]">
                منوی سالن
            </h1>
            <p class="mt-4 text-sm md:text-base uppercase text-[#FFD700]/70 font-medium">
                از منوی رستوران ما لذت ببرید!
            </p>
            <div class="mt-6 flex justify-center gap-3">
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
                <span class="w-3 h-3 bg-[#DC143C] rounded-full shadow-[0_0_10px_rgba(220,20,60,0.5)]"></span>
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-30">
        <div class="bg-[#140e10]/80 backdrop-blur-xl border border-[#dfb15b]/15 rounded-2xl p-5 shadow-[0_10px_40px_rgba(0,0,0,0.5)]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
                <div class="relative">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400">
                        <svg class="w-5 h-5 text-[#dfb15b]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="search-input" 
                           placeholder="جستجوی نام غذا یا ترکیبات و جزئیات..." 
                           class="w-full bg-[#1c1416] text-sm text-gray-200 pr-11 pl-4 py-3 rounded-xl border border-[#dfb15b]/10 focus:outline-none focus:border-[#bc1c24] focus:ring-1 focus:ring-[#bc1c24] transition-all duration-300 placeholder-gray-500">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center text-xs text-gray-400">
                        <span class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#bc1c24]"></span> حداکثر قیمت:
                        </span>
                        <span id="price-val" class="font-bold text-[#ffd700] text-sm bg-[#1c1416] px-2 py-0.5 rounded border border-[#dfb15b]/10">
                            {{ formatPriceFull($maxPrice) }}
                        </span>
                    </div>
                    <input type="range" id="price-slider" 
                        min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="50000"
                        class="w-full accent-[#bc1c24] h-1.5 bg-[#1c1416] rounded-lg cursor-pointer appearance-none"
                        data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}">
                </div>

                <div class="text-left md:text-left text-xs text-gray-400 flex justify-end items-center gap-2">
                    <span>موارد یافت شده:</span>
                    <span id="items-count" class="text-base font-bold text-[#bc1c24] bg-[#1c1416] px-3 py-1 rounded-xl border border-[#bc1c24]/20">
                        {{ count($menu) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div class="swiper categories-swiper overflow-visible!">
            <div class="swiper-wrapper">
                <div class="swiper-slide w-auto!">
                    <button data-category-target="all" 
                            class="cat-btn active px-6 py-2.5 rounded-full text-sm font-medium tracking-wide border transition-all duration-300 cursor-pointer shadow-sm
                                   bg-[#bc1c24] border-[#bc1c24] text-white shadow-[#bc1c24]/20">
                        همه منو
                    </button>
                </div>
                @foreach($categories as $cat)
                    <div class="swiper-slide w-auto!">
                        <button data-category-target="{{ $cat }}" 
                                class="cat-btn px-6 py-2.5 rounded-full text-sm font-medium border transition-all duration-300 cursor-pointer
                                       bg-[#140e10] border-[#dfb15b]/10 text-gray-400 hover:text-[#ffd700] hover:border-[#dfb15b]/30">
                            {{ $cat }}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div id="empty-state" class="hidden text-center py-20 bg-[#140e10]/30 rounded-2xl border border-dashed border-[#dfb15b]/10 max-w-md mx-auto">
            <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-400">آیتمی یافت نشد</h3>
            <p class="text-sm text-gray-500 mt-1">لطفاً فیلترها یا عبارت جستجوی خود را تغییر دهید.</p>
        </div>

        <div id="menu-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($menu as $item)
    @php
        // محاسبه شماره تصویر بر اساس ردیف (۱ تا ۱۲)
        $imageNumber = fmod($item['ردیف'] - 1, 12) + 1;
        $imagePath = asset("assets/images/menu/{$imageNumber}.webp");
    @endphp

    <div class="menu-item-card group bg-linear-to-br from-[#130d0f] to-[#0d0809] border border-neutral-900 rounded-2xl transition-all duration-300 hover:border-[#dfb15b]/30 hover:shadow-[0_15px_30px_rgba(0,0,0,0.6)] relative overflow-hidden flex flex-col h-full"
         data-category="{{ $item['نوع'] ?? 'سایر' }}"
         data-price="{{ $item['قیمت'] }}"
         data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}"
         style="opacity: 1; visibility: visible; display: flex;">

        <!-- overlay hover -->
        <div class="absolute inset-0 bg-[#bc1c24]/1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

        <!-- بخش تصویر + overlay نام و نوع -->
        <div class="relative">
            <img src="{{ $imagePath }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-48 object-cover">
            <!-- سایه و gradient از پایین تصویر -->
            <div class="absolute inset-x-0 bottom-0 bg-linear-to-t from-black/90 via-black/50 to-transparent p-4 pt-8">

                <div class="flex justify-between items-end gap-4">
                    <h3 class="text-lg font-bold text-gray-100 group-hover:text-[#ffd700] transition-colors duration-300">
                        {{ $item['اسم_غذا_فارسی'] }}
                    </h3>
                    <span class="text-[10px] px-2 py-1 bg-[#1c1416] text-[#dfb15b]/80 border border-[#dfb15b]/10 rounded whitespace-nowrap">
                        {{ $item['نوع'] ?? 'سایر' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- محتوای پایینی کارت -->
        <div class="flex-1 flex flex-col p-6 pt-4 relative z-10">
            <!-- خط جداکننده -->
            <div class="my-4 h-px bg-linear-to-r from-transparent via-[#dfb15b]/10 to-transparent"></div>

            <!-- توضیحات -->
            <p class="text-xs text-gray-400 leading-relaxed text-justify opacity-80 flex-1 min-h-9">
                {{ $item['جزئیات'] }}
            </p>

            <!-- بخش قیمت -->
            <div class="mt-6 flex justify-between items-center bg-[#181113] p-3 rounded-xl border border-neutral-900/50">
                <span class="text-xs text-gray-500">بهای هر سهم</span>
                <div class="text-sm font-black text-[#ffd700] tracking-wide">
                    {{ formatPrice($item['قیمت']) }}
                </div>
            </div>
        </div>
    </div>
@endforeach
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const categorySwiper = new Swiper('.categories-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 12,
            freeMode: true,
            slidesOffsetBefore: 0,
            slidesOffsetAfter: 0,
            watchOverflow: true
        });

        const searchInput = document.getElementById('search-input');
        const priceSlider = document.getElementById('price-slider');
        const priceVal = document.getElementById('price-val');
        const itemsCountBadge = document.getElementById('items-count');
        const menuGrid = document.getElementById('menu-grid');
        const emptyState = document.getElementById('empty-state');
        const menuCards = document.querySelectorAll('.menu-item-card');
        const categoryButtons = document.querySelectorAll('.cat-btn');

        let currentCategory = 'all';

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

            const showTargets = [];
            const hideTargets = [];

            menuCards.forEach(card => {
                const itemCategory = card.dataset.category;
                const itemPrice = parseInt(card.dataset.price);
                const searchKeys = card.dataset.searchKeys;

                const matchCategory = (currentCategory === 'all' || itemCategory === currentCategory);
                const matchPrice = itemPrice <= maxPrice;
                const matchSearch = !query || searchKeys.includes(query);

                if (matchCategory && matchPrice && matchSearch) {
                    showTargets.push(card);
                } else {
                    hideTargets.push(card);
                }
            });

            itemsCountBadge.textContent = toPersianNumber(showTargets.length);

            if (showTargets.length === 0) {
                emptyState.classList.remove('hidden');
                menuGrid.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                menuGrid.classList.remove('hidden');
            }

            if (hideTargets.length > 0) {
                gsap.to(hideTargets, {
                    opacity: 0,
                    scale: 0.92,
                    y: 15,
                    duration: 0.25,
                    overwrite: 'auto',
                    display: 'none',
                    ease: 'power2.in'
                });
            }

            if (showTargets.length > 0) {
                gsap.killTweensOf(showTargets);
                gsap.set(showTargets, { display: 'block' });
                gsap.fromTo(showTargets, 
                    { opacity: 0, scale: 0.95, y: -10 },
                    { 
                        opacity: 1, 
                        scale: 1, 
                        y: 0,
                        duration: 0.35, 
                        stagger: 0.03, 
                        overwrite: 'auto',
                        ease: 'power3.out'
                    }
                );
            }
        }

        priceSlider.addEventListener('input', filterEngine);
        searchInput.addEventListener('input', filterEngine);

        categoryButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                categoryButtons.forEach(b => {
                    b.classList.remove('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-[#bc1c24]/20');
                    b.classList.add('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                });

                btn.classList.remove('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                btn.classList.add('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-sm', 'shadow-[#bc1c24]/20');

                currentCategory = btn.dataset.categoryTarget;
                filterEngine();
            });
        });

        function animateCardsOnLoad() {
            const allCards = document.querySelectorAll('.menu-item-card');
            
            gsap.set(allCards, { 
                opacity: 0,
                display: 'block',
                visibility: 'visible',
                scale: 0.95,
                y: 30
            });
            
            gsap.to(allCards, {
                opacity: 1,
                scale: 1,
                y: 0,
                duration: 0.6,
                stagger: {
                    each: 0.04,
                    from: "start"
                },
                ease: 'power4.out',
                clearProps: 'all',
                onComplete: () => {
                    gsap.set(allCards, { clearProps: 'all' });
                }
            });
        }

        setTimeout(() => {
            animateCardsOnLoad();
        }, 100);
    });
</script>
@endsection
