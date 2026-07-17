{{-- resources/views/front/pages/organizational.blade.php --}}
@extends('front.layouts.app')
@section('title', __('organizational.page_title'))
@section('content')

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .category-section {
        scroll-margin-top: 120px;
    }
    .glow-panel {
        box-shadow: 0 15px 35px rgba(0,0,0,0.8), 0 0 20px rgba(255, 215, 0, 0.15);
        transition: box-shadow 0.4s ease, border-color 0.4s ease;
    }
    .glow-panel:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.9), 0 0 30px rgba(255, 215, 0, 0.3);
        border-color: #ffe55c;
    }
    
    .menu-dots {
        flex-grow: 1;
        border-bottom: 2px dotted rgba(255, 215, 0, 0.3);
        margin: 0 15px;
        position: relative;
        top: -8px;
        opacity: 0.7;
    }
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

    @keyframes textShimmer {
        0% { background-position: -200% center; }
        100% { background-position: 200% center; }
    }
    .animate-shimmer-text {
        background: linear-gradient(90deg, #ffd700 0%, #fff3b0 25%, #ffb700 50%, #fff3b0 75%, #ffd700 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShimmer 4s linear infinite;
    }
</style>
<style>
    #sticky-nav.is-scrolled {
        background: rgba(28, 20, 22, 0.98);
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    .swiper-slide {
        margin-right: 12px !important;
        width: auto !important;
    }
</style>

<div class="min-h-screen pb-20 bg-[#070203] text-gray-100 antialiased selection:bg-[#ffd700] selection:text-black">

    <div class="relative overflow-hidden py-16 text-center border-b-2 border-[#FFD700]/20 bg-linear-to-b from-[#1a0a0a] to-[#0a0a0a]">
        <a href="{{ url('/') }}" class="hidden lg:block absolute right-35 top-1/2 -translate-y-1/2 -translate-x-1/4 h-50 w-50 z-20">
            <img src="{{ asset('assets/logo/logo.webp') }}" alt="logo" class="h-full w-full object-contain brightness-200">
        </a>
        <a href="{{ url('/') }}" class="lg:hidden absolute right-1/2 top-15 -translate-y-1/2 translate-x-1/2 h-20 w-20 z-20">
            <img src="{{ asset('assets/logo/logo.webp') }}" alt="logo" class="h-full w-full object-contain brightness-200">
        </a>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(220,20,60,0.1)_0%,rgba(255,215,0,0.05)_50%,transparent_70%)]"></div>
        
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: repeating-linear-gradient(45deg, #FFD700 0px, #FFD700 1px, transparent 1px, transparent 20px), repeating-linear-gradient(-45deg, #DC143C 0px, #DC143C 1px, transparent 1px, transparent 20px);"></div>
        </div>
        
        <div class="relative z-10 mt-10">
            <h1 class="text-4xl md:text-6xl font-black tracking-wider shimmer-text drop-shadow-[0_2px_15px_rgba(255,215,0,0.3)]">
                {{ __('organizational.title') }}
            </h1>
            <p class="mt-4 text-sm md:text-base tracking-[0.3em] uppercase text-[#FFD700]/70 font-medium">
                {{ __('organizational.subtitle') }}
            </p>
            <div class="mt-6 flex justify-center gap-3">
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
                <span class="w-3 h-3 bg-[#DC143C] rounded-full shadow-[0_0_10px_rgba(220,20,60,0.5)]"></span>
                <span class="w-16 h-0.5 bg-linear-to-r from-transparent via-[#FFD700] to-transparent"></span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-30 mb-6">
        <div class="bg-[#140507]/80 backdrop-blur-xl border border-[#ffd700]/30 rounded-2xl p-5 shadow-[0_15px_40px_rgba(0,0,0,0.6),0_0_15px_rgba(255,215,0,0.1)]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                
                <div class="relative group">
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 group-focus-within:text-[#ffd700] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" id="search-input" 
                        placeholder="{{ __('organizational.search_placeholder') }}" 
                        class="w-full bg-[#0a0203] text-sm text-gray-100 pr-11 pl-4 py-3.5 rounded-xl border border-[#ffd700]/20 focus:outline-none focus:border-[#ffd700] focus:ring-1 focus:ring-[#ffd700] transition-all duration-300 placeholder-gray-600">
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm text-gray-400">
                        <span class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#ffd700] animate-pulse"></span> {{ __('organizational.max_price_label') }}
                        </span>
                        <span id="price-val" class="font-bold text-[#ffd700] text-sm bg-[#0a0203] px-3 py-1 rounded-md border border-[#ffd700]/20">
                            {{ $maxPriceFormatted }}
                        </span>
                    </div>
                    <input type="range" id="price-slider" 
                        min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}" step="1"
                        class="w-full accent-[#ffd700] h-1.5 bg-[#2a050a] rounded-lg cursor-pointer appearance-none">
                </div>

                <div class="text-left md:text-left text-sm text-gray-400 flex justify-end items-center gap-3">
                    <span>{{ __('organizational.items_found_label') }}</span>
                    <span id="items-count" class="text-lg font-black text-[#070203] bg-linear-to-r from-[#ffd700] to-[#dfb15b] px-4 py-1 rounded-xl shadow-[0_0_10px_rgba(255,215,0,0.3)]">
                        {{ $initialCountPersian }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <nav id="sticky-nav" class="mb-10 sticky top-2.5 mx-0 sm:mx-auto w-full sm:max-w-304.5 z-50 bg-[#1c1416]/85 backdrop-blur-xl border border-[#dfb15b]/20 rounded-2xl transition-all duration-300 py-2.5 sm:py-3 shadow-[0_0_20px_rgba(255,230,0,0.8)]">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8"> 
            <div class="swiper categories-swiper overflow-hidden">
                <div class="swiper-wrapper">
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        
        <div id="empty-state" class="hidden text-center py-24 bg-[#140507]/50 rounded-3xl border border-dashed border-[#ffd700]/30 max-w-xl mx-auto backdrop-blur-md">
            <svg class="w-20 h-20 text-[#ffd700]/40 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-bold text-[#ffd700]">{{ __('organizational.empty_title') }}</h3>
            <p class="text-sm text-gray-400 mt-2">{{ __('organizational.empty_description') }}</p>
        </div>

        <div id="menu-container" class="space-y-16">
            @foreach($grouped as $category => $items)
                <div class="category-section group/section" data-category="{{ $category }}">
                    
                    {{-- عنوان دسته‌بندی با استایل پویای دسکتاپ --}}
                    <div class="flex items-center gap-4 mb-8">
                        <div class="hidden md:flex w-10 h-10 bg-linear-to-br from-[#2a050a] to-[#140507] rounded-xl items-center justify-center border border-[#ffd700]/30 shadow-[0_0_15px_rgba(255,215,0,0.15)] transform -rotate-3 group-hover/section:rotate-0 transition-transform duration-300">
                            <svg class="w-5 h-5 text-[#ffd700]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.232.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black text-transparent bg-clip-text bg-linear-to-r from-[#ffd700] to-[#fff3b0] drop-shadow-[0_0_8px_rgba(255,215,0,0.5)] md:animate-shimmer-text">
                            {{ $category }}
                        </h2>
                        <div class="h-px flex-1 bg-linear-to-r from-[#ffd700]/40 to-transparent"></div>
                    </div>

                    {{-- حالت موبایل --}}
                    <div class="md:hidden flex overflow-x-auto snap-x snap-mandatory gap-5 pb-6 hide-scrollbar pt-2 px-2 -mx-2">
                        @foreach($items as $item)
                            @php
                                $imagePath = $item['main_image'] ?? asset('assets/images/default-food.webp');
                            @endphp
                            <div class="menu-item-mobile snap-center shrink-0 w-70 bg-linear-to-br from-[#1c0408] to-[#0a0203] border border-[#ffd700]/20 rounded-2xl overflow-hidden shadow-lg relative flex flex-col"
                                data-price="{{ $item['قیمت'] }}"
                                data-modal-type="organizational"
                                data-modal-id="{{ $item['id'] }}"
                                data-product-id="{{ $item['id'] }}"
                                data-product-type="MenuOrganizational"
                                data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}">
                                
                                <div class="relative h-40 w-full overflow-hidden">
                                    <img src="{{ $imagePath }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-linear-to-t from-[#0a0203] via-transparent to-transparent"></div>
                                </div>
                                
                                <div class="p-5 pt-3 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-[#ffd700] mb-1">{{ $item['اسم_غذا_فارسی'] }}</h3>
                                    <p class="text-xs text-gray-500 mb-2 font-mono uppercase tracking-wider">{{ $item['اسم_غذا_لاتین'] }}</p>
                                    <p class="text-xs text-gray-400 leading-relaxed text-justify opacity-90 flex-1">
                                        {{ $item['جزئیات'] }}
                                    </p>
                                    
                                    <div class="mt-4 pt-4 border-t border-[#ffd700]/10 flex justify-between items-center">
                                        <span class="text-[10px] text-gray-500 bg-[#2a050a] px-2 py-1 rounded">{{ __('organizational.organizational_badge') }}</span>
                                        <span class="text-base font-black text-[#ffd700]">{{ $item['formatted_price'] }} <span class="text-[10px] font-normal text-gray-400">{{ __('organizational.currency') }}</span></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- حالت دسکتاپ --}}
                    <div class="hidden md:block relative transition-all duration-500 perspective-[1000px] transform-3d hover:transform-[translateZ(8px)_rotateX(0.5deg)] bg-linear-to-br from-[#140507] to-[#050102] border border-[#ffd700]/30 rounded-3xl p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.7),inset_0_0_20px_rgba(255,215,0,0.02)] hover:shadow-[0_25px_60px_rgba(255,215,0,0.1)]">
                        
                        <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#ffd700]/5 rounded-full blur-3xl pointer-events-none transition-opacity duration-500 group-hover/section:opacity-100"></div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6 relative z-10">
                            @foreach($items as $item)
                                @php
                                    $imagePath = $item['main_image'] ?? asset('assets/images/default-food.webp');
                                @endphp
                                <div class="menu-item-desktop group flex gap-6 p-4 rounded-2xl bg-[#0a0203]/40 border border-[#ffd700]/10 hover:border-[#ffd700]/40 transition-all duration-300 hover:shadow-[0_10px_25px_rgba(0,0,0,0.5),0_0_15px_rgba(255,215,0,0.05)] cursor-pointer"
                                    data-price="{{ $item['قیمت'] }}"
                                    data-modal-type="organizational"
                                    data-modal-id="{{ $item['id'] }}"
                                    data-product-id="{{ $item['id'] }}"
                                    data-product-type="MenuOrganizational"
                                    data-search-keys="{{ mb_strtolower($item['اسم_غذا_فارسی'] . ' ' . $item['اسم_غذا_لاتین'] . ' ' . $item['جزئیات']) }}">
                                    
                                    <div class="shrink-0 w-32 h-32 lg:w-36 lg:h-36 rounded-xl overflow-hidden border border-[#ffd700]/20 shadow-[0_5px_15px_rgba(0,0,0,0.4)] relative">
                                        <img src="{{ $imagePath }}" alt="{{ $item['اسم_غذا_فارسی'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-linear-to-t from-[#0a0203]/40 to-transparent"></div>
                                    </div>
                                    
                                    <div class="flex-1 flex flex-col justify-between min-w-0 py-1">
                                        <div>
                                            <div class="flex items-start justify-between gap-4">
                                                <h3 class="text-lg lg:text-xl font-bold text-gray-100 group-hover:text-[#ffd700] transition-colors duration-300 truncate">
                                                    {{ $item['اسم_غذا_فارسی'] }}
                                                </h3>
                                                <div class="shrink-0 bg-[#2a050a]/60 px-3 py-1 rounded-lg border border-[#ffd700]/30 shadow-[0_0_10px_rgba(255,215,0,0.1)]">
                                                    <span class="text-base font-black text-[#ffd700]">
                                                        {{ $item['formatted_price'] }}
                                                        <span class="text-[10px] font-normal text-gray-400 mr-0.5">{{ __('organizational.currency') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-xs lg:text-sm text-gray-400/90 leading-relaxed text-justify line-clamp-2 mt-2 group-hover:text-gray-300 transition-colors">
                                            {{ $item['جزئیات'] }}
                                        </p>

                                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-[#ffd700]/5">
                                            <span class="text-[10px] text-gray-400 bg-[#140507] px-2 py-0.5 rounded border border-[#ffd700]/10">{{ __('organizational.organizational_badge') }}</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#ffd700]/40 group-hover:bg-[#ffd700] group-hover:scale-125 transition-all duration-300"></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </main>
    @include('front.components.food-modal')
</div>

@endsection