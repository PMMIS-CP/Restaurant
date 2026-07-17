<div class="relative w-full min-h-screen flex items-center justify-center bg-gray-900 overflow-hidden pt-20 md:pt-0"
     x-data="{
        images: [
            '{{ asset('assets/images/IMG_20260702_113900.webp') }}',
            '{{ asset('assets/images/IMG_20260702_113844.webp') }}',
            '{{ asset('assets/images/IMG_20260702_113729.webp') }}',
            '{{ asset('assets/images/IMG_20260702_113837.webp') }}',
        ],
        active: 0
     }"
     x-init="setInterval(() => { active = (active + 1) % images.length }, 4000)">

    <template x-for="(image, index) in images" :key="index">
        <img :src="image" 
             alt="Background" 
             class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none z-0 transition-opacity duration-1000 ease-in-out"
             :class="active === index ? 'opacity-100' : 'opacity-0'">
    </template>

    <div class="absolute inset-0 bg-black/50 backdrop-blur-[1px] z-10"></div>

    <div class="relative z-20 text-center text-white px-4 max-w-3xl flex flex-col items-center justify-center space-y-4 sm:space-y-6">
        
        <h1 class="text-3xl sm:text-4xl md:text-6xl font-black leading-tight tracking-wide drop-shadow-md">
            {{ __('home.hero.title') }}
        </h1>
        
        <p class="text-base sm:text-lg md:text-2xl text-gray-200 font-medium max-w-xl drop-shadow">
            {{ __('home.hero.description') }}
        </p>

        <div class="flex flex-col gap-4 w-full sm:w-auto pt-4">
            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <a href="/menu" class="w-full sm:w-auto bg-rose-900 hover:bg-rose-800 text-white font-bold text-lg px-8 py-4 rounded-2xl shadow-xl shadow-amber-500/20 transition-all duration-300 hover:scale-105 active:scale-95 text-center">
                    {{ __('home.hero.menu_hall') }}
                </a>
                <a href="/reserve" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white font-bold text-lg px-8 py-4 rounded-2xl transition-all duration-300 hover:scale-105 active:scale-95 text-center">
                    {{ __('home.hero.reserve_table') }}
                </a>
                <a href="/menu/takeout" class="w-full sm:w-auto bg-amber-500 hover:bg-amber-400 text-slate-950 border border-rose-700 font-semibold text-lg px-8 py-4 rounded-2xl shadow-lg shadow-rose-900/20 transition-all duration-300 hover:scale-105 active:scale-95 text-center">
                    {{ __('home.hero.menu_takeout') }}
                </a>
            </div>
            <a href="/menu/organizational" class="w-full bg-purple-700 hover:bg-purple-600 text-white font-bold text-lg px-8 py-4 rounded-2xl shadow-xl shadow-purple-700/20 transition-all duration-300 hover:scale-105 active:scale-95 text-center">
                {{ __('home.hero.menu_organizational') }}
            </a>
        </div>
    </div>
</div>