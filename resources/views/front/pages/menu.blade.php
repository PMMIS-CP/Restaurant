@extends('front.layouts.app')
@section('title', 'منو')
@section('content')

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
        #sticky-nav.is-scrolled {
        background: rgba(28, 20, 22, 0.98);
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
</style>

<div class="min-h-screen bg-[#090506] text-gray-100 antialiased selection:bg-[#bc1c24] selection:text-white">

    <div class="relative overflow-hidden py-16 text-center border-b-2 border-[#FFD700]/20 bg-linear-to-b from-[#1a0a0a] to-[#0a0a0a]">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(220,20,60,0.1)_0%,rgba(255,215,0,0.05)_50%,transparent_70%)]"></div>
        
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, #FFD700 0px, #FFD700 1px, transparent 1px, transparent 20px), repeating-linear-gradient(-45deg, #DC143C 0px, #DC143C 1px, transparent 1px, transparent 20px);"></div>
        </div>
        
        <div class="relative z-10 mt-15">
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
        <a href="{{ url('/') }}" class="hidden lg:block absolute left-35 top-1/2 -translate-y-1/2 -translate-x-1/4 h-50 w-50 z-20">
            <img src="{{ asset('assets/logo/logo.webp') }}" alt="logo" class="h-full w-full object-contain brightness-200">
        </a>
        <a href="{{ url('/') }}" class="lg:hidden absolute right-1/2 top-15 -translate-y-1/2 translate-x-1/2 h-20 w-20 z-20">
            <img src="{{ asset('assets/logo/logo.webp') }}" alt="logo" class="h-full w-full object-contain brightness-200">
        </a>
    </div>

    <div id="category-page" class="max-w-5xl mx-auto px-4 py-12 relative z-30">
        <h2 class="text-xl md:text-2xl font-bold text-center text-[#ffd700] mb-8 drop-shadow-[0_2px_10px_rgba(255,215,0,0.15)]">
            لطفاً یک دسته‌بندی را انتخاب کنید
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $cat)
                <button data-category-select="{{ $cat }}" class="category-select-card group bg-linear-to-br from-[#130d0f] to-[#0d0809] border border-neutral-900/80 rounded-2xl p-6 text-center transition-all duration-300 hover:border-[#dfb15b]/40 hover:shadow-[0_10px_25px_rgba(220,20,60,0.15)] cursor-pointer flex flex-col items-center gap-4">
                    <img src="{{ $categoryImages[$cat] ?? asset('/assets/images/menu/مخصوص.webp') }}" alt="{{ $cat }}" class="w-24 h-24 rounded-full object-cover border-2 border-neutral-700 group-hover:border-[#ffd700] transition-colors duration-300">
                    <span class="block text-base font-bold text-gray-200 group-hover:text-[#ffd700] transition-colors duration-300">
                        {{ $cat }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>

    <div id="menu-page" class="hidden">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-30">
            <div class="bg-[#140e10]/80 backdrop-blur-xl border border-[#dfb15b]/15 rounded-2xl p-5 shadow-[0_10px_40px_rgba(0,0,0,0.5)]">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400">
                            <svg class="w-5 h-5 text-[#dfb15b]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" id="search-input" placeholder="جستجوی نام غذا یا ترکیبات و جزئیات..." class="w-full bg-[#1c1416] text-sm text-gray-200 pr-11 pl-4 py-3 rounded-xl border border-[#dfb15b]/10 focus:outline-none focus:border-[#bc1c24] focus:ring-1 focus:ring-[#bc1c24] transition-all duration-300 placeholder-gray-500">
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-sm text-gray-400">
                            <span class="flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#bc1c24]"></span> حداکثر قیمت:
                            </span>
                            <span id="price-val" class="font-bold text-[#ffd700] text-sm bg-[#1c1416] px-2 py-0.5 rounded border border-[#dfb15b]/10">
                                {{ $maxPriceFormatted }}
                            </span>
                        </div>
                        <input type="range" id="price-slider" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="1" class="w-full accent-[#bc1c24] h-1.5 bg-[#1c1416] rounded-lg cursor-pointer appearance-none" data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}">
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
        <nav id="sticky-nav" class="mt-5 sticky top-2.5 mx-0 sm:mx-auto w-full sm:max-w-304.5 z-50 bg-[#1c1416]/85 backdrop-blur-xl border border-[#dfb15b]/20 rounded-2xl transition-all duration-300 py-2.5 sm:py-3 shadow-[0_0_20px_rgba(255,230,0,0.8)]">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 flex items-center gap-2 sm:gap-3"> 
                <button id="back-to-categories" class="flex items-center gap-1.5 px-3 sm:px-5 py-1.5 sm:py-2 text-[12px] sm:text-[13px] font-bold rounded-full bg-[#1c1416] border border-[#dfb15b]/30 text-gray-300 hover:text-white shrink-0 shadow-inner">
                    <svg class="w-4 h-4 transform rotate-180 text-[#bc1c24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="hidden sm:inline">بازگشت</span>
                </button>

                <div class="w-px h-6 bg-[#dfb15b]/20 mx-0.5"></div>

                <div class="swiper categories-swiper overflow-hidden flex-1 min-w-0">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide w-auto!">
                            <button data-category-target="all" class="cat-btn active px-4 py-1.5 text-[12px] sm:text-[13px] rounded-full font-medium border bg-[#bc1c24] border-[#bc1c24] text-white">
                                همه منو
                            </button>
                        </div>
                        @foreach($categories as $cat)
                            <div class="swiper-slide w-auto!">
                                <button data-category-target="{{ $cat }}" class="cat-btn px-4 py-1.5 text-[12px] sm:text-[13px] rounded-full font-medium border border-[#dfb15b]/10 text-gray-400 hover:text-[#ffd700] bg-[#140e10]">
                                    {{ $cat }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </nav>
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            
            <div id="empty-state" class="hidden text-center py-20 bg-[#140e10]/30 rounded-2xl border border-dashed border-[#dfb15b]/10 max-w-md mx-auto">
                <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-400">آیتمی یافت نشد</h3>
                <p class="text-sm text-gray-500 mt-1">لطفاً فیلترها یا عبارت جستجوی خود را تغییر دهید.</p>
            </div>

            <div id="menu-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($menu as $item)
                <div class="menu-item-card group bg-linear-to-br from-[#130d0f] to-[#0d0809] border border-neutral-900 rounded-2xl transition-all duration-300 hover:border-[#dfb15b]/30 hover:shadow-[0_15px_30px_rgba(0,0,0,0.6)] relative overflow-hidden flex flex-col h-full"
                    data-category="{{ $item['نوع'] ?? 'سایر' }}"
                    data-price="{{ $item['قیمت'] }}"
                    data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}"
                    style="opacity: 1; visibility: visible; display: flex;">

                    <div class="absolute inset-0 bg-[#bc1c24]/1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-10"></div>

                    <div class="relative">
                        <img src="{{ $item['image_path'] }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-48 object-cover">
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

                    <div class="flex-1 flex flex-col p-6 pt-4 relative z-10">
                        <div class="my-4 h-px bg-linear-to-r from-transparent via-[#dfb15b]/10 to-transparent"></div>
                        <p class="text-xs text-gray-400 leading-relaxed text-justify opacity-80 flex-1 min-h-9">
                            {{ $item['جزئیات'] }}
                        </p>
                        <div class="mt-6 flex justify-between items-center bg-[#181113] p-3 rounded-xl border border-neutral-900/50">
                            <span class="text-xs text-gray-500">بهای هر سهم</span>
                            <div class="text-sm font-black text-[#ffd700] tracking-wide">
                                {{ $item['formatted_price'] }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    @include('front.components.food-modal')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // فچ کردن المان‌های کنترل صفحات
        const categoryPage = document.getElementById('category-page');
        const menuPage = document.getElementById('menu-page');
        const backToCategoriesBtn = document.getElementById('back-to-categories');
        const categorySelectCards = document.querySelectorAll('[data-category-select]');

        // کنترلرهای فیلتر و مابقی المان‌ها
        const searchInput = document.getElementById('search-input');
        const priceSlider = document.getElementById('price-slider');
        const priceVal = document.getElementById('price-val');
        const itemsCountBadge = document.getElementById('items-count');
        const menuGrid = document.getElementById('menu-grid');
        const emptyState = document.getElementById('empty-state');
        const menuCards = document.querySelectorAll('.menu-item-card');
        const categoryButtons = document.querySelectorAll('.cat-btn');

        let currentCategory = 'all';

        // راه اندازی Swiper دسته‌بندی‌ها
        const categorySwiper = new Swiper('.categories-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 12,
            freeMode: true,
            slidesOffsetBefore: 0,
            slidesOffsetAfter: 0,
            watchOverflow: true
        });

        function toPersianNumber(num) {
            const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return num.toString().replace(/\d/g, x => persianDigits[x]);
        }

        function formatSliderPrice(price) {
            return new Intl.NumberFormat('fa-IR').format(price) + ' تومان';
        }

        // موتور اصلی فیلتر محصولات منو
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
                gsap.set(showTargets, { display: 'flex' });
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

        // انیمیشن کارت‌ها موقع فعال شدن صفحه اصلی منو
        function animateCardsOnLoad() {
            const visibleCards = document.querySelectorAll('.menu-item-card[style*="display: flex"]');
            if(visibleCards.length === 0) return;

            gsap.fromTo(visibleCards, 
                { opacity: 0, scale: 0.95, y: 30 },
                {
                    opacity: 1,
                    scale: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.04,
                    ease: 'power4.out'
                }
            );
        }

        // عملکرد کلیک روی کارت‌های دسته‌بندی اولیه صفحه اول
        categorySelectCards.forEach(card => {
            card.addEventListener('click', () => {
                const selectedCategory = card.dataset.categorySelect;
                currentCategory = selectedCategory;

                // سوئیچ بصری دکمه‌های اسلایدر ناوبری چسبان بالای صفحه
                categoryButtons.forEach(b => {
                    if (b.dataset.categoryTarget === selectedCategory) {
                        b.classList.remove('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                        b.classList.add('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-sm', 'shadow-[#bc1c24]/20');
                        
                        // اسکرول اسلایدر به سمت دکمه فعال شده
                        const btnIndex = Array.from(categoryButtons).indexOf(b);
                        setTimeout(() => { categorySwiper.slideTo(btnIndex); }, 100);
                    } else {
                        b.classList.remove('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-[#bc1c24]/20');
                        b.classList.add('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                    }
                });

                // پنهان کردن صفحه دسته‌بندی و بالا آوردن صفحه منو
                categoryPage.classList.add('hidden');
                menuPage.classList.remove('hidden');

                // بروزرسانی محاسبات Swiper به دلیل تغییر وضعیت نمایش
                categorySwiper.update();

                // اجرای فیلتر و اعمال انیمیشن ورود
                filterEngine();
                setTimeout(() => { animateCardsOnLoad(); }, 50);
            });
        });

        // بازگشت به صفحه دسته‌بندی‌ها
        backToCategoriesBtn.addEventListener('click', () => {
            menuPage.classList.add('hidden');
            categoryPage.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // رویدادهای فیلتر قیمت و جستجو درون صفحه منو
        priceSlider.addEventListener('input', filterEngine);
        searchInput.addEventListener('input', filterEngine);

        // رویداد تغییر دسته‌بندی از داخل اسلایدر چسبان بالای صفحه (Nav)
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
    });
</script>
<script>
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('sticky-nav');
        if (window.scrollY > 50) {
            nav.classList.add('is-scrolled');
        } else {
            nav.classList.remove('is-scrolled');
        }
    });
</script>
@endsection
