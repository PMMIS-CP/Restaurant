@extends('front.layouts.app')

@section('title', __('about.meta_title'))
@section('meta_description', __('about.meta_description'))

@section('content')
{{-- Hero Section --}}
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    {{-- Background with overlay --}}
    <div class="absolute inset-0 z-0">
        <img 
            src="{{ asset('assets/images/og-image.webp') }}" 
            alt="{{ __('about.hero_title') }}" 
            class="w-full h-full object-cover"
            loading="eager"
        >
        <div class="absolute inset-0 bg-linear-to-b from-gray-900/70 via-gray-900/50 to-gray-900/80"></div>
        {{-- Pattern Overlay --}}
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    {{-- Content --}}
    <div class="pt-20 relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto" dir="auto">
        <div class="space-y-8 animate-fade-in">

            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-tight">
                {{ __('about.hero_title') }}
            </h1>
            
            <p class="text-lg sm:text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed">
                {{ __('about.hero_subtitle') }}
            </p>

            <div class="flex items-center justify-center gap-4 mt-8">
                <div class="h-px w-16 sm:w-24 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
                <div class="h-px w-16 sm:w-24 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

{{-- Introduction Section --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Text Content --}}
            <div class="space-y-6 lg:order-2">
                <span class="inline-block text-amber-600 font-semibold text-sm tracking-wider uppercase bg-amber-50 px-4 py-2 rounded-full">
                    {{ __('about.intro_heading') }}
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    {{ __('about.intro_heading') }}
                </h2>
                <div class="h-1 w-20 bg-linear-to-r from-amber-500 to-amber-600 rounded-full"></div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    {{ __('about.intro_text') }}
                </p>
                <div class="flex gap-4 pt-4">
                    <div class="flex items-center gap-2 text-gray-500">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">{{ __('about.quality_guarantee') }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-500">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">{{ __('about.fresh_ingredients') }}</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative lg:order-1">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img 
                        src="{{ asset('assets/images/about-restaurant.webp') }}" 
                        alt="{{ __('about.intro_heading') }}" 
                        class="w-full h-100 lg:h-125 object-cover"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-gray-900/20 to-transparent"></div>
                </div>
                {{-- Decorative element --}}
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-amber-100 rounded-2xl -z-10 hidden lg:block"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 border-2 border-amber-200 rounded-2xl -z-10 hidden lg:block"></div>
            </div>
        </div>
    </div>
</section>

{{-- Cuisine Section --}}
<section class="py-16 md:py-24 bg-gray-50 relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23000000' fill-opacity='1'%3E%3Cpath d='M20 0L22.5 7.5L30 10L22.5 12.5L20 20L17.5 12.5L10 10L17.5 7.5L20 0z'/%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Image --}}
            <div class="relative">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="rounded-2xl overflow-hidden shadow-lg h-48">
                            <img src="{{ asset('assets/images/food-1.webp') }}" alt="Food" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg h-64">
                            <img src="{{ asset('assets/images/food-2.webp') }}" alt="Food" class="w-full h-full object-cover" loading="lazy">
                        </div>
                    </div>
                    <div class="space-y-4 pt-8">
                        <div class="rounded-2xl overflow-hidden shadow-lg h-64">
                            <img src="{{ asset('assets/images/food-3.webp') }}" alt="Food" class="w-full h-full object-cover" loading="lazy">
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg h-48">
                            <img src="{{ asset('assets/images/food-4.webp') }}" alt="Food" class="w-full h-full object-cover" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text Content --}}
            <div class="space-y-6">
                <span class="inline-block text-amber-600 font-semibold text-sm tracking-wider uppercase bg-amber-100 px-4 py-2 rounded-full">
                    {{ __('about.our_menu') }}
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    {{ __('about.cuisine_heading') }}
                </h2>
                <div class="h-1 w-20 bg-linear-to-r from-amber-500 to-amber-600 rounded-full"></div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    {{ __('about.cuisine_text') }}
                </p>
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ __('about.iranian_cuisine') }}</h3>
                            <p class="text-sm text-gray-500">{{ __('about.authentic_taste') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ __('about.arabic_kebabs') }}</h3>
                            <p class="text-sm text-gray-500">{{ __('about.special_recipe') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Music & Celebrations Section --}}
<section class="py-16 md:py-24 bg-gray-900 text-white relative overflow-hidden">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,0.05) 10px, rgba(255,255,255,0.05) 20px);"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
        <div class="text-center mb-16">
            <span class="inline-block text-amber-400 font-semibold text-sm tracking-wider uppercase bg-gray-800 px-4 py-2 rounded-full">
                {{ __('about.entertainment') }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mt-6 mb-4">
                {{ __('about.music_heading') }}
            </h2>
            <div class="h-1 w-20 bg-linear-to-r from-amber-500 to-amber-600 rounded-full mx-auto"></div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Live Music --}}
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                <div class="w-16 h-16 bg-amber-500/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('about.live_music') }}</h3>
                <p class="text-gray-400 leading-relaxed">
                    {{ __('about.live_music_description') }}
                </p>
            </div>

            {{-- Celebrations --}}
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                <div class="w-16 h-16 bg-amber-500/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('about.celebrations') }}</h3>
                <p class="text-gray-400 leading-relaxed">
                    {{ __('about.music_text') }}
                </p>
            </div>

            {{-- Stage Area --}}
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                <div class="w-16 h-16 bg-amber-500/20 rounded-xl flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4">{{ __('about.stage_area') }}</h3>
                <p class="text-gray-400 leading-relaxed">
                    {{ __('about.stage_description') }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- VIP Section --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Text Content --}}
            <div class="space-y-6">
                <span class="inline-block text-amber-600 font-semibold text-sm tracking-wider uppercase bg-amber-50 px-4 py-2 rounded-full">
                    {{ __('about.premium') }}
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                    {{ __('about.vip_heading') }}
                </h2>
                <div class="h-1 w-20 bg-linear-to-r from-amber-500 to-amber-600 rounded-full"></div>
                <p class="text-gray-600 text-lg leading-relaxed">
                    {{ __('about.vip_text') }}
                </p>
                <div class="flex flex-wrap gap-3 pt-4">
                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm">
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('about.led_screens') }}
                    </span>
                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm">
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('about.projector') }}
                    </span>
                    <span class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm">
                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('about.private_events') }}
                    </span>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img 
                        src="{{ asset('assets/images/vip-lounge.webp') }}" 
                        alt="{{ __('about.vip_heading') }}" 
                        class="w-full h-100 object-cover"
                        loading="lazy"
                    >
                </div>
                {{-- Decorative element --}}
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-amber-100 rounded-2xl -z-10 hidden lg:block"></div>
            </div>
        </div>
    </div>
</section>

{{-- Online Reservation CTA --}}
<section class="py-16 md:py-24 bg-linear-to-br from-amber-500 to-amber-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: repeating-conic-gradient(#fff 0 90deg, transparent 0 180deg); background-size: 20px 20px;"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10">
        <div class="max-w-3xl mx-auto text-center space-y-8">
            <span class="inline-block text-white/90 font-semibold text-sm tracking-wider uppercase bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                {{ __('about.easy_booking') }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                {{ __('about.reservation_heading') }}
            </h2>
            <p class="text-white/90 text-lg leading-relaxed">
                {{ __('about.reservation_text') }}
            </p>
            <a href="{{ url('/reserve') }}" class="inline-flex items-center gap-2 bg-white text-amber-600 font-semibold px-8 py-4 rounded-full hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                {{ __('about.reserve_now') }}
                <svg class="w-5 h-5 rtl:scale-x-[-1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Information Section --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Working Hours --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('about.hours_heading') }}</h3>
                        <p class="text-gray-600 text-lg">{{ __('about.hours_text') }}</p>
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <div class="shrink-0 w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('about.address_heading') }}</h3>
                        <p class="text-gray-600 text-lg">{{ __('about.address_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Closing Statement --}}
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="text-center space-y-8">
            <div class="flex items-center justify-center gap-4">
                <div class="h-px w-16 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
                <span class="text-amber-400 text-2xl">✦</span>
                <div class="h-px w-16 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
            </div>
            
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed italic">
                {{ __('about.closing_text') }}
            </p>

            <div class="flex items-center justify-center gap-4">
                <div class="h-px w-16 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
                <span class="text-amber-400 text-2xl">✦</span>
                <div class="h-px w-16 bg-linear-to-r from-transparent via-amber-400 to-transparent"></div>
            </div>
        </div>
    </div>
</section>

{{-- Custom Animations --}}
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }
</style>
@endsection