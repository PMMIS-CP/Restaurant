<header x-data="{ mobileMenuOpen: false }" 
        class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-200/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 lg:h-24">
            
            {{-- لوگو --}}
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="bg-orange-100 p-2 rounded-2xl group-hover:bg-orange-500 transition-colors duration-300">
                        <img src="{{ asset('assets/logo/logo.png') }}" alt="logo" class="h-8 w-8 object-contain">
                    </div>
                    <span class="text-xl font-black text-gray-900 tracking-tighter">
                        {{ config('app.name', 'رستوران') }}
                    </span>
                </a>
            </div>

            {{-- منوی دسکتاپ --}}
            <nav class="hidden lg:flex items-center gap-8">
                @php
                    $links = [
                        ['name' => __('messages.nav.home'), 'url' => '/'],
                        ['name' => __('messages.nav.menu'), 'url' => '#'],
                        ['name' => __('messages.nav.reserve'), 'url' => '#'],
                        ['name' => __('messages.nav.contact'), 'url' => '#'],
                    ];
                @endphp
                @foreach($links as $link)
                    <a href="{{ $link['url'] }}" 
                       class="text-sm font-semibold text-gray-600 hover:text-orange-500 transition-all duration-200 relative group">
                        {{ $link['name'] }}
                        <span class="absolute -bottom-1 right-0 w-0 h-0.5 bg-orange-500 transition-all group-hover:w-full"></span>
                    </a>
                @endforeach
            </nav>

            {{-- بخش ورود، زبان و پروفایل --}}
            <div class="hidden lg:flex items-center gap-5">
                {{-- سوییچر زبان --}}
                <div class="flex items-center gap-2 text-xs font-bold border-l border-gray-200 pl-4">
                    <a href="{{ url('/lang/fa') }}" class="{{ app()->getLocale() == 'fa' ? 'text-orange-500' : 'text-gray-400 hover:text-gray-700' }}">FA</a>
                    <span class="text-gray-300">/</span>
                    <a href="{{ url('/lang/en') }}" class="{{ app()->getLocale() == 'en' ? 'text-orange-500' : 'text-gray-400 hover:text-gray-700' }}">EN</a>
                </div>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 bg-gray-50 hover:bg-gray-100 px-4 py-2 rounded-full transition-all">
                            <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</span>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute left-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-xl">{{ __('messages.auth.dashboard') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-right px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-xl">{{ __('messages.auth.logout') }}</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-700 hover:text-orange-500">{{ __('messages.auth.login') }}</a>
                    <a href="#" class="bg-gray-900 hover:bg-orange-500 text-white px-6 py-2.5 rounded-full text-sm font-bold transition-all">
                        {{ __('messages.cta.book_online') }}
                    </a>
                @endauth
            </div>

            {{-- دکمه موبایل --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-800">
                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>
    </div>

    {{-- منوی موبایل --}}
    <div x-show="mobileMenuOpen" class="lg:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur border-b border-gray-100 p-6 shadow-2xl">
        <div class="flex flex-col gap-4">
            <a href="/" class="text-lg font-bold text-gray-800">{{ __('messages.nav.home') }}</a>
            <a href="#" class="text-lg font-bold text-gray-800">{{ __('messages.nav.menu') }}</a>
            <a href="#" class="text-lg font-bold text-gray-800">{{ __('messages.nav.contact') }}</a>
            <hr>
            <a href="{{ route('login') }}" class="bg-orange-500 text-white text-center py-3 rounded-xl font-bold">{{ __('messages.auth.login') }}</a>
        </div>
    </div>
</header>