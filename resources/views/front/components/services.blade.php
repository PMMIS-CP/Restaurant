@php
    $services = [
        [
            'title' => __('home.services.items.0.title'),
            'desc' => __('home.services.items.0.desc'),
            'svg' => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2" class="w-full h-full"><path stroke-linecap="square" d="M32 26V22"/><path fill="currentColor" d="M61 54C61 38 48 25 32 25 16 25 3 38 3 54H61Z"/><path stroke-linecap="round" d="M32 30C23 30 14 35 11 43"/><rect width="64" height="5" y="54" fill="currentColor" rx="2.5"/><rect width="8" height="3" x="28" y="20" fill="currentColor"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M49 26C49 26 53 20 50 16 48 12 47 10 50 6M56 26C56 26 60 20 57 16 55 12 54 10 57 6"/></svg>'
        ],
        [
            'title' => __('home.services.items.1.title'),
            'desc' => __('home.services.items.1.desc'),
            'svg' => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2" class="w-full h-full"><path fill="currentColor" d="M61 38C61 22 48 9 32 9 16 9 3 22 3 38H61Z"/><path stroke-linecap="round" d="M32 14C23 14 15 19 11 27"/><rect width="58" height="3" x="3" y="39" fill="currentColor"/><circle cx="32" cy="4" r="3" fill="currentColor"/><g transform="matrix(0 1 1 0 4 45)"><path fill="currentColor" d="M2 13.5C2 12 3 11 4.5 11H15V16H4.5C3 16 2 15 2 13.5Z" transform="rotate(31 8.5 13.5)"/><path fill="currentColor" d="M5.7 45L5.7 34C5.7 34 -2 19 0.5 17 3 15 7 23 7 23L9 20L9 9L6.3 4C5.8 3 6.2 2 7 1.5L8 1C9 0.5 10 1 10.7 2L14.5 9L16 20C16 20 19 25 15 44.5"/></g></svg>'
        ],
        [
            'title' => __('home.services.items.2.title'),
            'desc' => __('home.services.items.2.desc'),
            'svg' => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2" class="w-full h-full"><path fill="currentColor" d="M34 15C34 15 26 15 26 9 26 9 37 6 37 12M39 10C39 10 45 2 53 8 53 8 48 15 39 12"/><path stroke-linecap="round" stroke-linejoin="round" d="M35 19C35 19 33 12 45 9"/><path fill="currentColor" d="M17.5 52.4C19.6 55.1 22.2 59.9 25.1 61.5 28.1 63.2 31.5 60.6 35 60.6 38.5 60.6 41.9 63.2 44.9 61.5 47.8 59.9 50.4 55.1 52.5 52.4 56.7 47.2 59.2 41.7 59.2 35.2 59.2 28.5 56.5 22.2 52.2 18.7 47.8 15.2 41.7 18.2 35 18.2 28.3 18.2 22.2 15.2 17.8 18.7 13.5 22.2 10.8 28.5 10.8 35.2 10.8 41.7 13.3 47.2 17.5 52.4Z"/><path stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" d="M21 20C21 20 15 25 17 33"/></svg>'
        ],
    ];
@endphp

<!-- Desktop -->
<div class="hidden md:block bg-[#8B0000] p-8 md:p-12 border border-[#FFD700] shadow-2xl relative overflow-hidden">
    <svg class="absolute -top-10 -right-10 w-40 h-40 text-[#FFD700] opacity-10 animate-spin-slow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
    <svg class="absolute -bottom-10 -left-10 w-40 h-40 text-[#FFD700] opacity-5 animate-pulse" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>

    <div class="relative z-10 bg-white/95 backdrop-blur-md p-6 md:p-8 rounded-2xl border border-[#FFD700]/30 shadow-xl">
        <div class="flex items-center gap-4 mb-8 border-b border-[#8B0000]/10 pb-6">
            <div class="p-3 bg-[#8B0000] rounded-full">
                <svg class="w-8 h-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-[#8B0000] tracking-tight">{{ __('home.services.title') }}</h3>
                <p class="text-[#6B0000] font-medium italic mt-1">{{ __('home.services.subtitle_desktop') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($services as $service)
            <div class="group p-6 rounded-2xl bg-gray-50 border border-gray-200 hover:border-[#FFD700] transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-12 h-12 rounded-xl bg-[#8B0000] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform p-2 text-[#FFD700]" role="img" aria-label="{{ $service['title'] }}">
                    {!! $service['svg'] !!}
                </div>
                <strong class="block text-[#8B0000] font-bold text-lg mb-2">{{ $service['title'] }}</strong>
                <span class="text-gray-700 text-sm leading-relaxed">{{ $service['desc'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Mobile -->
<div class="block md:hidden bg-[#8B0000] p-3 border border-[#FFD700] shadow-lg relative overflow-hidden">
    <svg class="absolute -top-5 -right-5 w-24 h-24 text-[#FFD700] opacity-10 animate-spin-slow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>

    <div class="relative z-10 bg-white/95 backdrop-blur-sm p-3 rounded-xl border border-[#FFD700]/30 shadow-md">
        <div class="flex items-center gap-2 mb-4 border-b border-[#8B0000]/10 pb-3">
            <div class="p-2 bg-[#8B0000] rounded-full">
                <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-[#8B0000] leading-tight">{{ __('home.services.title') }}</h3>
                <p class="text-[#6B0000] text-xs italic mt-0.5">{{ __('home.services.subtitle_mobile') }}</p>
            </div>
        </div>

        <div class="space-y-3">
            @foreach($services as $service)
            <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50/80 border border-gray-200 active:border-[#FFD700] transition-all duration-200 active:shadow-md">
                <div class="w-10 h-10 rounded-lg bg-[#8B0000] flex items-center justify-center shrink-0 p-1.5 text-[#FFD700]" role="img" aria-label="{{ $service['title'] }}">
                    {!! $service['svg'] !!}
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