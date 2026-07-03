{{-- components/ceremony.blade.php --}}
<section class="ceremony-section py-12 md:py-16 bg-[#fcf8f0]" aria-labelledby="ceremony-heading">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        {{-- هدینگ و متن سئو با رنگ‌های سلطنتی --}}
        <div class="text-center mb-12 md:mb-16 relative">
            {{-- خط تزئینی زرین --}}
            <div class="w-24 h-1 bg-[#D4AF37] mx-auto mb-4 rounded-full"></div>
            
            <h2 id="ceremony-heading" class="text-3xl md:text-5xl font-extrabold text-[#8B1A1A] mb-4 tracking-tight">
                بهترین سالن پذیرایی برای مراسم شما در کاخ سنتی موراکو
            </h2>
            <p class="text-base md:text-lg text-[#4a3e35] max-w-4xl mx-auto leading-relaxed font-light">
                رستوران کاخ سنتی موراکو، فراتر از یک رستوران لوکس، فضایی رویایی و اصیل برای برگزاری ماندگارترین مراسم شماست. 
                از <strong class="font-semibold text-[#8B1A1A]">جشن تولدهای خاطره‌انگیز کودک</strong> با دکوراسیونی شاد و منویی اختصاصی گرفته تا <strong class="font-semibold text-[#8B1A1A]">مراسم عروسی باشکوه</strong> در فضایی سلطنتی و کاملاً تشریفاتی، و همچنین <strong class="font-semibold text-[#8B1A1A]">مهمانی‌ها و جلسات سازمانی</strong> حرفه‌ای با امکانات کامل صوتی و تصویری؛ 
                تیم ما با مدیریتی کارآزموده، فضای اختصاصی شما را با بهترین پذیرایی و خدمات تشریفات فراهم می‌کند. 
                <span class="font-bold text-[#D4AF37]">رزرو سالن اختصاصی موراکو</span>، انتخابی بی‌نظیر برای ثبت زیباترین لحظات زندگی و کسب‌وکار شماست.
            </p>
        </div>

        {{-- گرید کارت‌ها با چیدمان پویا --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            {{-- کارت ۱: جشن تولد کودک --}}
            <div class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 hover:scale-[1.01]">
                {{-- نوار رنگ سلطنتی بالا --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-linear-to-r from-[#8B1A1A] via-[#D4AF37] to-[#8B1A1A] z-10"></div>
                
                <div class="relative overflow-hidden h-56 md:h-64">
                    <img 
                        src="{{ asset('assets/images/7-1.webp') }}" 
                        alt="جشن تولد کودک در کاخ سنتی موراکو - سالن پذیرایی لوکس و شاد" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                        loading="lazy"
                        width="400"
                        height="256"
                    >
                    {{-- اورلی طلایی شفاف --}}
                    <div class="absolute inset-0 bg-linear-to-t from-[#8B1A1A]/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                
                <div class="p-6 text-center">
                    <div class="w-12 h-12 bg-[#D4AF37]/10 rounded-full flex items-center justify-center mx-auto mb-3 text-[#D4AF37] text-2xl">
                        🎂
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-[#8B1A1A] mb-2 tracking-wide">
                        جشن تولد کودک
                    </h3>
                    <p class="text-[#5a4e42] text-sm leading-relaxed">
                        دنیایی از شادی و رنگ را برای فرزند دلبندتان با تم‌های اختصاصی، بادکنک‌آرایی حرفه‌ای و منوی ویژه کودکان در فضایی امن و شیک خلق کنید.
                    </p>
                </div>
            </div>

            {{-- کارت ۲: مراسم عروسی --}}
            <div class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 hover:scale-[1.01]">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-linear-to-r from-[#D4AF37] via-[#8B1A1A] to-[#D4AF37] z-10"></div>
                
                <div class="relative overflow-hidden h-56 md:h-64">
                    <img 
                        src="{{ asset('assets/images/14.webp') }}" 
                        alt="مراسم عروسی رویایی در کاخ سنتی موراکو - تالار پذیرایی مجلل و تشریفاتی" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                        loading="lazy"
                        width="400"
                        height="256"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-[#D4AF37]/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                
                <div class="p-6 text-center">
                    <div class="w-12 h-12 bg-[#D4AF37]/10 rounded-full flex items-center justify-center mx-auto mb-3 text-[#D4AF37] text-2xl">
                        💍
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-[#8B1A1A] mb-2 tracking-wide">
                        مراسم عروسی
                    </h3>
                    <p class="text-[#5a4e42] text-sm leading-relaxed">
                        زیباترین شب زندگی‌تان را در تالار باشکوه موراکو با چیدمان سلطنتی، گل‌آرایی نفیس، موسیقی زنده و شامی مجلل در خاطرها جاودانه سازید.
                    </p>
                </div>
            </div>

            {{-- کارت ۳: مهمانی و جلسات سازمانی --}}
            <div class="group relative bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2 hover:scale-[1.01]">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-linear-to-r from-[#8B1A1A] via-[#D4AF37] to-[#8B1A1A] z-10"></div>
                
                <div class="relative overflow-hidden h-56 md:h-64">
                    <img 
                        src="{{ asset('assets/images/118.webp') }}" 
                        alt="سالن جلسات سازمانی و مهمانی‌های رسمی در رستوران کاخ سنتی موراکو" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                        loading="lazy"
                        width="400"
                        height="256"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-[#8B1A1A]/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                
                <div class="p-6 text-center">
                    <div class="w-12 h-12 bg-[#D4AF37]/10 rounded-full flex items-center justify-center mx-auto mb-3 text-[#D4AF37] text-2xl">
                        💼
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-[#8B1A1A] mb-2 tracking-wide">
                        مهمانی و جلسات سازمانی
                    </h3>
                    <p class="text-[#5a4e42] text-sm leading-relaxed">
                        از سمینارها و جلسات کاری رسمی تا ضیافت‌های سازمانی، فضای اختصاصی ما مجهز به سیستم‌های صوتی/تصویری پیشرفته و پذیرایی در خور برند شماست.
                    </p>
                </div>
            </div>

        </div>
        
        {{-- دکمه CTA با طراحی مدرن و زرین --}}
        <div class="text-center mt-10 md:mt-14">
            <a class="relative inline-block group bg-[#8B1A1A] hover:bg-[#6b1414] text-white font-bold py-3.5 px-8 md:py-4 md:px-10 rounded-full shadow-xl transition-all duration-300 text-base md:text-lg overflow-hidden">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    همین حالا سالن اختصاصی خود را رزرو کنید
                    <svg class="w-5 h-5 transition-transform duration-300 ltr:rotate-0 rtl:rotate-180
                                group-hover:ltr:translate-x-1 group-hover:rtl:-translate-x-1" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
                {{-- حلقه طلایی زیر دکمه --}}
                <div class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 scale-95 group-hover:scale-100"></div>
            </a>
        </div>
    </div>
</section>