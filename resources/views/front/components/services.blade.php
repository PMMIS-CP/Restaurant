<div class="hidden md:block bg-[#8B0000] p-8 md:p-12 border border-[#FFD700] shadow-2xl relative overflow-hidden">
    
    <svg class="absolute -top-10 -right-10 w-40 h-40 text-[#FFD700] opacity-10 animate-spin-slow" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
    </svg>
    
    <svg class="absolute -bottom-10 -left-10 w-40 h-40 text-[#FFD700] opacity-5 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" />
    </svg>

    <div class="relative z-10 bg-white/95 backdrop-blur-md p-6 md:p-8 rounded-2xl border border-[#FFD700]/30 shadow-xl">
        
        <div class="flex items-center gap-4 mb-8 border-b border-[#8B0000]/10 pb-6">
            <div class="p-3 bg-[#8B0000] rounded-full">
                <svg class="w-8 h-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-3xl font-bold text-[#8B0000] tracking-tight">{{ __('home.services.title') }}</h4>
                <p class="text-[#6B0000] font-medium italic mt-1">{{ __('home.services.subtitle_desktop') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            @php
                $services = [
                    [
                        'title' => __('home.services.items.0.title'),
                        'desc' => __('home.services.items.0.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (105).svg')
                    ],
                    [
                        'title' => __('home.services.items.1.title'),
                        'desc' => __('home.services.items.1.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (178).svg')
                    ],
                    [
                        'title' => __('home.services.items.2.title'),
                        'desc' => __('home.services.items.2.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (125).svg')
                    ],
                ];
            @endphp

            @foreach($services as $service)
            <div class="group p-6 rounded-2xl bg-gray-50 border border-gray-200 hover:border-[#FFD700] transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-12 h-12 rounded-xl bg-[#8B0000] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform p-2">
                    <img src="{{ $service['icon'] }}" alt="{{ $service['title'] }}" class="w-full h-full object-contain" style="filter: brightness(0) saturate(100%) invert(67%) sepia(91%) saturate(600%) hue-rotate(2deg) brightness(109%) contrast(95%);">
                </div>
                <strong class="block text-[#8B0000] font-bold text-lg mb-2">{{ $service['title'] }}</strong>
                <span class="text-gray-700 text-sm leading-relaxed">{{ $service['desc'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="block md:hidden bg-[#8B0000] p-3 border border-[#FFD700] shadow-lg relative overflow-hidden">
    
    <svg class="absolute -top-5 -right-5 w-24 h-24 text-[#FFD700] opacity-10 animate-spin-slow" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
    </svg>

    <div class="relative z-10 bg-white/95 backdrop-blur-sm p-3 rounded-xl border border-[#FFD700]/30 shadow-md">
        
        <div class="flex items-center gap-2 mb-4 border-b border-[#8B0000]/10 pb-3">
            <div class="p-2 bg-[#8B0000] rounded-full">
                <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-bold text-[#8B0000] leading-tight">{{ __('home.services.title') }}</h4>
                <p class="text-[#6B0000] text-xs italic mt-0.5">{{ __('home.services.subtitle_mobile') }}</p>
            </div>
        </div>

        <div class="space-y-3">
            
            @php
                $services = [
                    [
                        'title' => __('home.services.items.0.title'),
                        'desc' => __('home.services.items.0.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (105).svg')
                    ],
                    [
                        'title' => __('home.services.items.1.title'),
                        'desc' => __('home.services.items.1.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (178).svg')
                    ],
                    [
                        'title' => __('home.services.items.2.title'),
                        'desc' => __('home.services.items.2.desc'),
                        'icon' => asset('assets/svg/Restaurant/restaurant (125).svg')
                    ],
                ];
            @endphp

            @foreach($services as $service)
            <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50/80 border border-gray-200 active:border-[#FFD700] transition-all duration-200 active:shadow-md">
                <div class="w-10 h-10 rounded-lg bg-[#8B0000] flex items-center justify-center shrink-0 p-1.5">
                    <img src="{{ $service['icon'] }}" alt="{{ $service['title'] }}" class="w-full h-full object-contain" style="filter: brightness(0) saturate(100%) invert(67%) sepia(91%) saturate(600%) hue-rotate(2deg) brightness(109%) contrast(95%);">
                </div>
                <div class="flex-1 min-w-0">
                    <strong class="block text-[#8B0000] font-bold text-sm mb-1">{{ $service['title'] }}</strong>
                    <span class="text-gray-600 text-xs leading-relaxed line-clamp-2">{{ $service['desc'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    .animate-spin-slow { animation: spin-slow 20s linear infinite; }
</style>