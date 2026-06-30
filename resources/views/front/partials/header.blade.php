<header x-data="{ mobileMenuOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="scrolled ? 'bg-red-950/95 py-4' : 'bg-red-950/80 py-6'"
        class="fixed w-full top-0 z-50 transition-all duration-500 backdrop-blur-md border-b border-yellow-700/30">
    
    {{-- تراز کردن المان‌ها با justify-between --}}
    <div class="container mx-auto px-6 flex items-center justify-between">
        
        {{-- منوی دسکتاپ --}}
        {{-- کلاس flex-1 را حذف کردیم تا فقط فضای مورد نیاز خود را بگیرد --}}
        <nav class="hidden lg:flex items-center gap-10">
            @php
                $links = [
                    ['name' => __('messages.nav.home'), 'url' => '/'],
                    ['name' => __('messages.nav.menu'), 'url' => '#'],
                    ['name' => __('messages.nav.reserve'), 'url' => '#'],
                    ['name' => __('messages.nav.contact'), 'url' => '#'],
                ];
            @endphp
            @foreach($links as $link)
                <a href="{{ $link['url'] }}" class="text-sm font-medium text-gray-200 hover:text-yellow-500 transition-colors relative group">
                    {{ $link['name'] }}
                    <span class="absolute -bottom-2 inset-s-0 w-0 h-0.5 bg-yellow-500 transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endforeach
        </nav>

        {{-- لوگو --}}
        {{-- این بخش اکنون دقیقاً در مرکز قرار می‌گیرد --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group shrink-0">
            <div class="p-2 rounded-full border-2 border-yellow-600 group-hover:rotate-12 transition-transform duration-500">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="h-10 w-10 brightness-200">
            </div>
            <span class="text-2xl font-bold text-yellow-500 tracking-widest uppercase">
                {{ config('app.name', 'رستوران') }}
            </span>
        </a>

        {{-- بخش اکشن‌ها --}}
        {{-- کلاس flex-1 حذف شد تا به لوگو نچسبد --}}
        <div class="hidden lg:flex items-center gap-6 border-s border-yellow-700/50 ps-6">
            <div class="flex items-center gap-2 text-xs text-gray-400 font-bold">
                <a href="{{ url('/lang/fa') }}" class="{{ app()->getLocale() == 'fa' ? 'text-yellow-500' : 'hover:text-white' }}">FA</a>
                <span>|</span>
                <a href="{{ url('/lang/en') }}" class="{{ app()->getLocale() == 'en' ? 'text-yellow-500' : 'hover:text-white' }}">EN</a>
            </div>

            @auth
                <button @click="profileOpen = !profileOpen" class="text-white hover:text-yellow-500 transition-colors">
                    {{ Auth::user()->name }}
                </button>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold text-white hover:text-yellow-500 transition-all">{{ __('messages.auth.login') }}</a>
                <a href="#" class="bg-yellow-600 hover:bg-yellow-500 text-red-950 px-6 py-2.5 rounded-full text-sm font-black uppercase tracking-wide transition-all shadow-lg hover:shadow-yellow-600/50">
                    {{ __('messages.cta.book_online') }}
                </a>
            @endauth
        </div>
        
        {{-- دکمه موبایل در انتها قرار می‌گیرد --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-yellow-500">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
        </button>
    </div>

    {{-- منوی موبایل --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-5"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden bg-red-950 border-t border-yellow-700/30 p-6">
        <div class="flex flex-col gap-6 text-center">
            @foreach($links as $link)
                <a href="{{ $link['url'] }}" class="text-lg font-bold text-white">{{ $link['name'] }}</a>
            @endforeach
            <a href="{{ route('login') }}" class="bg-yellow-600 text-red-950 py-3 rounded-xl font-bold">ورود به پنل</a>
        </div>
    </div>
</header>