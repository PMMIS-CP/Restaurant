<footer class="bg-linear-to-b from-[#5C0A1E] to-[#3A0512] text-gray-200 border-t-4 border-[#F5C518]" itemscope itemtype="https://schema.org/Organization">
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-start">
            
            {{-- ستون ۱: برند و توضیحات --}}
            <div class="flex flex-col items-center md:items-start gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-white text-xl font-bold" itemprop="url">
                    <img src="{{ asset('assets/logo/logo.webp') }}" alt="{{ __('app.name') }}" class="h-8 w-8" width="32" height="32">
                    <span itemprop="name">{{ __('app.name') }}</span>
                </a>
                <p class="text-sm text-[#E8C88A] leading-relaxed max-w-xs">
                    {{ __('footer.brand_description') }}
                </p>
            </div>

            {{-- ستون ۲: لینک‌های سریع --}}
            <nav aria-label="{{ __('footer.quick_access') }}">
                <h3 class="text-[#F5C518] font-semibold mb-4 text-lg">{{ __('footer.quick_access') }}</h3>
                <ul class="space-y-2.5">
                    <li><a href="{{ url('/') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.home') }}</a></li>
                    <li><a href="{{ route('reserve') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.reserve') }}</a></li>
                    <li><a href="{{ route('menu') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.menu') }}</a></li>
                    <li><a href="{{ route('menu.takeout') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.takeout') }}</a></li>
                    <li><a href="{{ route('menu.organizational') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.organizational') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-[#F5C518] transition-colors text-sm">{{ __('footer.about_us') }}</a></li>
                </ul>
            </nav>

            {{-- ستون ۳: اطلاعات تماس --}}
            <div itemscope itemtype="https://schema.org/ContactPoint">
                <h3 class="text-[#F5C518] font-semibold mb-4 text-lg">{{ __('footer.contact_title') }}</h3>
                <ul class="space-y-3 text-sm">
                    {{-- شماره موبایل --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-200">
                        <svg class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:09353077797" class="hover:text-[#F5C518] transition-colors font-medium" dir="ltr" itemprop="telephone">
                            0935 307 7797
                        </a>
                    </li>
                    {{-- شماره ثابت --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-200">
                        <svg class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:02191094044" class="hover:text-[#F5C518] transition-colors font-medium" dir="ltr" itemprop="telephone">
                            021-910-940-44
                        </a>
                    </li>
                    {{-- ایمیل --}}
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-300">
                        <svg class="h-5 w-5 text-[#F5C518] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" focusable="false">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span itemprop="email">{{ __('footer.email') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- کپی‌رایت --}}
        <div class="border-t border-[#7A2A3E] mt-8 pt-6 text-center">
            <p class="text-sm text-[#B88A6B]">
                &copy; {{ date('Y') }} {{ __('app.name') }}. {{ __('footer.copyright') }}
            </p>
        </div>
    </div>
</footer>