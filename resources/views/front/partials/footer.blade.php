{{-- فوتر مدرن --}}
<footer class="bg-gray-900 text-gray-300">
    <div class="container mx-auto px-4 py-8 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-right">
            {{-- ستون ۱: برند --}}
            <div class="flex flex-col items-center md:items-start gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-white text-xl font-bold">
                    <img src="{{ asset('assets/logo/logo.webp') }}" alt="{{ config('app.name') }}" class="h-8 w-auto brightness-0 invert">
                    {{ config('app.name', 'رستوران') }}
                </a>
                <p class="text-sm text-gray-400 leading-relaxed">
                    بهترین تجربه غذایی را با ما داشته باشید. کیفیت، طعم و اصالت در هر وعده.
                </p>
            </div>

            {{-- ستون ۲: لینک‌های سریع --}}
            <div>
                <h3 class="text-white font-semibold mb-4 text-lg">دسترسی سریع</h3>
                <ul class="space-y-2.5">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-orange-400 transition-colors text-sm">خانه</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors text-sm">منوی غذا</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors text-sm">تماس با ما</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-orange-400 transition-colors text-sm">درباره ما</a></li>
                </ul>
            </div>

            {{-- ستون ۳: اطلاعات تماس --}}
            <div>
                <h3 class="text-white font-semibold mb-4 text-lg">ارتباط با ما</h3>
                <ul class="space-y-2.5 text-sm">
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        <span>۰۲۱-۱۲۳۴۵۶۷۸</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        <span>info@restaurant.ir</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- خط جداکننده و کپی‌رایت --}}
        <div class="border-t border-gray-800 mt-8 pt-6 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. تمام حقوق محفوظ است.
            </p>
        </div>
    </div>
</footer>