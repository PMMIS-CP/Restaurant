@php
    $testimonials = $testimonials ?? [
        [
            'name' => 'سارا احمدی',
            'comment' => 'دیشب تولد همسرم رو تو سالن VIP کاخ سنتی موراکو گرفتیم. دکور سرخ و طلایی سالن واقعاً مجلل و شاهانه بود. پرسنل هم سنگ تموم گذاشتن. یه شب رویایی ساختین برامون.',
            'tags' => ['VIP', 'رزرو میز'],
        ],
        [
            'name' => 'امیرحسین کاظمی',
            'comment' => 'برای اولین بار از سایت سفارش آنلاین غذا دادم. بسته‌بندی بسیار شکیل و باکیفیت بود. طعم چلوکباب کوبیده‌شون دقیقاً همون طعم اصیل ایرانی رو داشت که تو خود رستوران سرو می‌کنن.',
            'tags' => ['سفارش آنلاین'],
        ],
        [
            'name' => 'دکتر مریم هاشمی',
            'comment' => 'جلسه کاری با شرکای خارجی‌مون رو تو اتاق VIP کاخ موراکو برگزار کردم. ترکیب معماری سنتی ایرانی با اون رنگ‌های سرخ و زرد سلطنتی، مهمان‌های خارجی رو میخکوب کرده بود. افتخار فرهنگ ایرانی رو بهشون نشون دادم.',
            'tags' => ['VIP', 'رزرو میز'],
        ],
        [
            'name' => 'رضا نیکخواه',
            'comment' => 'من و خانواده‌م عاشق محوطه گردش کاخ موراکو هستیم. بعد از صرف شام، قدم زدن تو حیاط سنتی با حوض فیروزه‌ای و نورپردازی گرم، یه حس نوستالژیک فوق‌العاده داره. هر هفته میایم اینجا.',
            'tags' => ['بازدید از کاخ سنتی موراکو', 'رزرو میز'],
        ],
        [
            'name' => 'شیرین الیاسی',
            'comment' => 'مراسم بله‌برون دخترم رو تو سالن اصلی کاخ موراکو برگزار کردیم. سقف‌های مقرنس‌کاری شده با نورپردازی طلایی، یه فضای رویایی ساخته بود. همه مهمونا محو زیبایی فضا بودن. بی‌نهایت ممنون از تیم حرفه‌ای کاخ.',
            'tags' => ['VIP', 'رزرو میز'],
        ],
        [
            'name' => 'پویا فرهادی',
            'comment' => 'سفارش آنلاین دیزی سنگی کاخ موراکو یه تجربه متفاوت بود. همه چی دقیقاً مثل سرو داخل رستوران چیده شده بود. گوشت کوبیده و آبگوشت جاافتاده‌ش واقعاً نوستالژیک و دلچسب بود.',
            'tags' => ['سفارش آنلاین'],
        ],
        [
            'name' => 'کتایون صالحی',
            'comment' => 'برای سالگرد ازدواجمون میز VIP کنار پنجره‌های ارسی رزرو کردم. وقتی نور از شیشه‌های رنگی رد میشد و روی میز ما می‌تابید، همسرم اشک تو چشماش جمع شد. کاخ موراکو خاطره‌سازترین جای تهران برای ماست.',
            'tags' => ['VIP', 'رزرو میز'],
        ],
        [
            'name' => 'مهندس کامران ملکی',
            'comment' => 'به عنوان یه معمار سنتی‌کار، بازدید از کاخ موراکو برام حکم کلاس درس رو داشت. جزئیات آجرکاری، کاشی‌های هفت‌رنگ و ترکیب بی‌نظیر سرخ و زرد سلطنتی تو نما، یه شاهکار احیا شده از معماری قاجاریه.',
            'tags' => ['بازدید از کاخ سنتی موراکو'],
        ],
        [
            'name' => 'نرگس جعفری',
            'comment' => 'سه‌شنبه‌ها که موسیقی سنتی زنده دارن رو از دست نمیدم. نشستن تو محوطه گردش کاخ زیر نور فانوس‌ها، با صدای تار و نی و یه بشقاب بادمجان شکم‌پر... اینجا انگار زمان متوقف میشه.',
            'tags' => ['بازدید از کاخ سنتی موراکو', 'رزرو میز'],
        ],
        [
            'name' => 'هادی توکلی',
            'comment' => 'رزرو آنلاین میز برای شب یلدا رو یه هفته قبل انجام دادم. به محض ورود، یه میز تزئین شده با انار و هندوانه و شمع‌های قرمز منتظرمون بود. حواس‌جمعی تیم رزرو کاخ موراکو تحسین‌برانگیزه.',
            'tags' => ['رزرو میز'],
        ],
        [
            'name' => 'آیدا رحیمی',
            'comment' => 'دیروز برای ناهار مهمون کاخ موراکو بودیم. تور بازدید از بخش‌های تاریخی کاخ مثل تالار آینه و شربت‌خانه قدیمی برامون گذاشتن. بعدش یه ناهار مجلسی تو سالن اصلی خوردیم. یه روز کامل و خاطره‌انگیز بود.',
            'tags' => ['بازدید از کاخ سنتی موراکو', 'رزرو میز'],
        ],
        [
            'name' => 'فرزاد امینی',
            'comment' => 'برای مهمونی ۲۰ نفره فامیل، اتاق VIP اختصاصی گرفتم. منوی شخصی‌سازی شده با اسم فامیل چاپ کرده بودن. موسیقی زنده سنتی هم مارو تا آخر شب سرحال نگه داشت. حرفه‌ای‌ترین سرویس VIP که دیدم.',
            'tags' => ['VIP'],
        ],
        [
            'name' => 'محدثه کریمی',
            'comment' => 'تجربه سفارش آنلاین کاخ موراکو از خیلی رستوران‌های حضوری بهتر بود! فسنجونشون با گردو تازه و رب انار ترش، عین غذاهای دست‌پخت مادربزرگم بود. بسته‌بندی مسی رنگ هم خیلی چشمنواز بود.',
            'tags' => ['سفارش آنلاین'],
        ],
        [
            'name' => 'تورج پارسایی',
            'comment' => 'جهانگرد هستم و رستوران‌های تاریخی زیادی تو دنیا دیدم. کاخ سنتی موراکو تو تهران یه جواهر پنهانه. تلفیق غذاهای اصیل ایرانی با اون فضای باشکوه قجری، یه تجربه جهانی در کلاس جهانیه.',
            'tags' => ['بازدید از کاخ سنتی موراکو', 'VIP'],
        ],
        [
            'name' => 'گلناز صادقی',
            'comment' => 'هر وقت میخوام یه مهمون ویژه رو تحت تأثیر بذارم، بدون فکر رزرو میز VIP کاخ موراکو رو میزنم. لوسترهای کریستال، دیوارهای سرخ مخملی و سرویس طلایی، ترکیبیه که هیچ‌کس نمی‌تونه فراموش کنه.',
            'tags' => ['VIP', 'رزرو میز'],
        ],
    ];

    $starIcon = '<svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';

    // نگاشت تگ‌ها به رنگ‌های مناسب
    $tagColors = [
        'سفارش آنلاین' => 'bg-green-100 text-green-800',
        'رزرو میز' => 'bg-blue-100 text-blue-800',
        'VIP' => 'bg-[#D4AF37]/20 text-[#8B0000] font-bold',
        'بازدید از کاخ سنتی موراکو' => 'bg-[#8B0000]/10 text-[#8B0000]',
    ];
@endphp
<div class="w-full py-16 bg-linear-to-b from-[#8B0000]/5 to-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- عنوان بخش --}}
        <div class="w-24 h-1 bg-[#D4AF37] mx-auto mb-4 rounded-full"></div>
        <div class="text-center mb-8">
            <h4 class="text-3xl md:text-4xl font-bold text-[#8B0000] relative inline-block">
                بازخورد مشتریان

            </h4>
            <p class="mt-6 text-gray-600 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                آنچه میهمانان عزیزمان درباره تجربه خود در کاخ سنتی موراکو می‌گویند
            </p>
        </div>

        <style>
            .swiper-container-custom { cursor: grab; }
            .swiper-container-custom:active { cursor: grabbing; }
        </style>

        <div 
            x-data="customSwiper"
            x-init="initSwiper()"
            class="relative swiper-container-custom"
        >
            {{-- محفظه اسلایدها --}}
            <div x-ref="swiperContainer" class="swiper overflow-hidden rounded-2xl px-2! py-4!">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide h-auto">
                            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border-t-4 border-[#D4AF37] h-full flex flex-col mx-2 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative overflow-hidden">
                                
                                {{-- نشان تزئینی گوشه --}}
                                <div class="absolute -top-4 -left-4 w-16 h-16 bg-[#D4AF37]/10 rounded-full"></div>
                                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-[#8B0000]/5 rounded-full"></div>

                                {{-- آواتار و نام --}}
                                <div class="flex flex-col items-center mb-5 relative z-10">
                                    <div class="w-20 h-20 rounded-full overflow-hidden ring-4 ring-[#8B0000]/20 mb-4 bg-linear-to-br from-[#8B0000]/10 to-[#D4AF37]/20 flex items-center justify-center shadow-md">
                                        <svg class="w-12 h-12 text-[#8B0000]" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v1.2c0 .66.54 1.2 1.2 1.2h16.8c.66 0 1.2-.54 1.2-1.2v-1.2c0-3.2-6.4-4.8-9.6-4.8z"/>
                                        </svg>
                                    </div>
                                    <h5 class="text-xl font-bold text-[#8B0000] mb-2">{{ $testimonial['name'] }}</h5>
                                    <div class="flex space-x-1 space-x-reverse text-[#D4AF37]">
                                        @for ($i = 0; $i < 5; $i++)
                                            {!! $starIcon !!}
                                        @endfor
                                    </div>
                                </div>

                                {{-- متن نظر --}}
                                <blockquote class="text-gray-700 text-center leading-relaxed grow relative z-10">
                                    <svg class="w-8 h-8 text-[#D4AF37]/20 mx-auto mb-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
                                    </svg>
                                    <p class="italic font-medium text-sm md:text-base">"{{ $testimonial['comment'] }}"</p>
                                </blockquote>

                                {{-- تگ‌ها --}}
                                @if(!empty($testimonial['tags']))
                                    <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-center gap-2 relative z-10">
                                        @foreach($testimonial['tags'] as $tag)
                                            <span class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $tagColors[$tag] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- صفحه‌بندی --}}
            <div x-ref="pagination" class="flex justify-center mt-8 space-x-2 space-x-reverse"></div>
        </div>
    </div>
</div>