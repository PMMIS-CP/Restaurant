{{-- resources/views/front/components/abuot.blade.php --}}
<section class="relative overflow-hidden bg-linear-to-b from-[#FFF8E7] to-[#FDF3E1] py-16 md:py-24">
    <!-- نوار تزیینی کناری با رنگ سلطنتی -->
    <div class="absolute inset-s-0 top-0 h-full w-2 bg-[#C41E3A] shadow-[4px_0_10px_rgba(212,175,55,0.4)]"></div>

    <div class="container mx-auto px-4">
        <!-- سربند بخش -->
        <div class="mb-12 text-center md:text-right">
            <span class="inline-block rounded-full bg-[#C41E3A]/10 px-4 py-1.5 text-sm font-semibold text-[#8B1A2B] ring-1 ring-[#D4AF37]/40">درباره کاخ موراکو</span>
            <p class="mt-3 text-xl font-bold text-[#3E2723] md:text-2xl">قصه‌ای از طعم‌های اصیل و آداب باشکوه دربار</p>
        </div>

        <!-- ردیف اصلی: متن و تصویر -->
        <div class="flex flex-col items-center gap-12 md:flex-row">
            <!-- ستون متن -->
            <div class="w-full text-center md:w-1/2 md:text-right">
                <h2 class="text-3xl font-extrabold text-[#5D1A1A] md:text-4xl lg:text-5xl">
                    کاخ موراکو؛ آمیزه‌ای از شکوه، طعم و هنر میزبانی
                </h2>
                <p class="mt-6 text-lg leading-relaxed text-[#4A3424]">
                    در تالارهای باشکوه «کاخ موراکو»، ما میراث‌دار سفره‌های اصیل ایرانی هستیم. اینجا تنها غذا سرو نمی‌شود؛ 
                    هر بشقاب روایتی از تاریخ کهن، هر عطر، دعوتی به ضیافتی درباری و هر دیدار، خاطره‌ای است که در قلب مهمانان نقش می‌بندد. 
                    پذیرایی در این آستان، ادای دینی است به فرهنگ غنی میزبانی ایرانی.
                </p>
                <div class="mt-8 flex justify-center md:justify-start">
                    <a href="{{ url('/about') }}" 
                       class="group inline-flex items-center gap-2 rounded-xl bg-[#C41E3A] px-6 py-3 text-[#FFF8E7] shadow-lg shadow-[#D4AF37]/30 ring-1 ring-[#D4AF37] transition-all duration-500 hover:bg-[#8B1A2B] hover:shadow-xl hover:shadow-[#D4AF37]/50 hover:ring-2">
                        <span class="font-medium">درباره ما بیشتر بدانید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" 
                             class="text-[#FFD700] transition-transform duration-300 group-hover:-translate-x-1">
                            <path d="M7.2 12C7.2 11.3 7.47 10.6 8 10.07L14.52 3.55C14.81 3.26 15.29 3.26 15.58 3.55C15.87 3.84 15.87 4.32 15.58 4.61L9.06 11.13C8.58 11.61 8.58 12.39 9.06 12.87L15.58 19.39C15.87 19.68 15.87 20.16 15.58 20.45C15.29 20.74 14.81 20.74 14.52 20.45L8 13.93C7.47 13.4 7.2 12.7 7.2 12Z" 
                                  fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- ستون تصویر -->
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <!-- هاله و قاب زرین دور تصویر -->
                    <div class="absolute -inset-4 rounded-3xl bg-[#C41E3A]/20 blur-2xl"></div>
                    <div class="absolute -inset-1 rounded-2xl bg-linear-to-tr from-[#D4AF37] via-[#F1E5AC] to-[#D4AF37] p-0.5 shadow-[0_0_30px_rgba(212,175,55,0.6)]"></div>
                    <img src="{{ asset('assets/images/50.webp') }}" 
                         alt="فضای باشکوه کاخ موراکو" 
                         class="relative w-full rounded-2xl shadow-2xl" 
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>