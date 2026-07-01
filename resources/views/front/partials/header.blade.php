<header x-data="{ mobileMenuOpen: false, profileOpen: false, scrollY: 0 }" 
        @scroll.window="scrollY = window.pageYOffset"
        :class="scrollY <= 50 
            ? 'bg-transparent py-6 border-b border-transparent' 
            : 'bg-red-950/95 py-4 border-b border-yellow-700/30 backdrop-blur-md shadow-xl'"
        class="fixed w-full top-0 z-50 transition-all duration-500" dir="rtl">
    
    <div class="container mx-auto px-6 flex items-center justify-between">
        
        {{-- ناوبری دسکتاپ (بدون تغییر) --}}
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
        <a href="{{ url('/') }}" class="flex items-center gap-3 group shrink-0">
            <div class="p-2 rounded-full border-2 border-yellow-600 group-hover:rotate-12 transition-transform duration-500">
                <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="h-10 w-10 brightness-200">
            </div>
            <span class="text-2xl font-bold text-yellow-500 tracking-widest uppercase">
                {{ config('app.name', 'رستوران') }}
            </span>
        </a>

        {{-- بخش سمت چپ دسکتاپ (زبان / احراز هویت / CTA) --}}
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
        
        {{-- دکمه همبرگری موبایل --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-yellow-500 hover:text-yellow-400 transition-colors">
            <svg x-show="!mobileMenuOpen" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            <svg x-show="mobileMenuOpen" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Overlay (فقط موبایل) --}}
    <div x-show="mobileMenuOpen" 
         @click="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden">
    </div>

    {{-- منوی موبایل --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-5"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-5"
         class="fixed top-0 left-0 w-full z-50 lg:hidden bg-red-950/95 backdrop-blur-xl border-b border-yellow-700/30 shadow-2xl">
        
        <div class="p-6 pt-4">
            <div class="flex justify-end mb-4">
                <button @click="mobileMenuOpen = false" class="text-yellow-500 hover:text-yellow-400 p-1">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="flex flex-col gap-4 text-center">
                @foreach($links as $link)
                    <a href="{{ $link['url'] }}" @click="mobileMenuOpen = false" class="text-lg font-bold text-white hover:text-yellow-500 py-2 transition-colors">
                        {{ $link['name'] }}
                    </a>
                @endforeach

                <hr class="border-yellow-700/30 my-2">

                <div class="flex items-center justify-center gap-4 text-sm font-bold">
                    <a href="{{ url('/lang/fa') }}" @click="mobileMenuOpen = false" class="{{ app()->getLocale() == 'fa' ? 'text-yellow-500' : 'text-gray-400 hover:text-white' }}">FA</a>
                    <span class="text-gray-600">|</span>
                    <a href="{{ url('/lang/en') }}" @click="mobileMenuOpen = false" class="{{ app()->getLocale() == 'en' ? 'text-yellow-500' : 'text-gray-400 hover:text-white' }}">EN</a>
                </div>

                <div class="flex flex-col gap-3 mt-2">
                    @auth
                        <span class="text-white font-bold text-lg">{{ Auth::user()->name }}</span>
                    @else
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="w-full bg-yellow-600 hover:bg-yellow-500 text-red-950 py-3 rounded-xl font-bold text-lg transition-colors">
                            {{ __('messages.auth.login') }}
                        </a>
                        <a href="#" @click="mobileMenuOpen = false" class="w-full border-2 border-yellow-600 text-yellow-500 hover:bg-yellow-600 hover:text-red-950 py-3 rounded-xl font-bold text-lg transition-all">
                            {{ __('messages.cta.book_online') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>