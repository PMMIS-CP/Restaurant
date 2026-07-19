{{-- فوتر مدرن با رنگ‌های زرشکی و زرد سلطنتی --}}
<footer class="bg-linear-to-b from-[#5C0A1E] to-[#3A0512] text-gray-200 border-t-4 border-[#F5C518]">
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-right">
            {{-- ستون ۱: برند --}}
            <div class="flex flex-col items-center md:items-start gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-white text-xl font-bold">
                    <img src="{{ asset('assets/logo/logo.webp') }}" alt="{{ __('app.name') }}" class="h-8 w-8">
                    {{ __('app.name') }}
                </a>
                <p class="text-sm text-[#E8C88A] leading-relaxed">
                    {{ __('footer.brand_description') }}
                </p>
            </div>

            {{-- ستون ۲: لینک‌های سریع --}}
            <div>
                <h3 class="text-[#F5C518] font-semibold mb-4 text-lg">{{ __('footer.quick_access') }}</h3>
                <ul class="space-y-2.5">
                    <li><a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.home') }}</a></li>
                    <li><a href="{{ url('/menu') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.menu') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.contact_us') }}</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.about_us') }}</a></li>
                </ul>
            </div>

            {{-- ستون ۳: اطلاعات تماس با شماره‌ها --}}
            <div>
                <h3 class="text-[#F5C518] font-semibold mb-4 text-lg">{{ __('footer.contact_title') }}</h3>
                <ul class="space-y-3 text-sm">
                    {{-- شماره موبایل --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:09353077797" class="hover:text-[#F5C518] transition-colors font-medium" dir="ltr">
                            0935 307 7797
                        </a>
                    </li>
                    {{-- شماره تلفن ثابت --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:02191094044" class="hover:text-[#F5C518] transition-colors font-medium" dir="ltr">
                            021-910-940-44
                        </a>
                    </li>
                    {{-- ایمیل --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ __('footer.email') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- خط جداکننده و کپی‌رایت --}}
        <div class="border-t border-[#7A2A3E] mt-8 pt-6 text-center">
            <p class="text-sm text-[#B88A6B]">
                &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('footer.copyright') }}
            </p>
        </div>
    </div>
</footer>