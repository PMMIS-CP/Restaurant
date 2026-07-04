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
            همین حالا سفارش بگیرید
        </h1>
        
        <p class="text-base sm:text-lg md:text-2xl text-gray-200 font-medium max-w-xl drop-shadow">
            میز خود را در کوتاه‌ترین زمان رزرو کنید و از منوی بی‌نظیر ما لذت ببرید.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto pt-4">
            <a href="#order" class="w-full sm:w-auto bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold text-lg px-8 py-3.5 rounded-xl shadow-lg shadow-amber-500/20 transition-all duration-300 transform hover:-translate-y-1 text-center">
                سفارش آنلاین
            </a>
            <a href="#reserve" class="w-full sm:w-auto bg-transparent hover:bg-white border-2 border-white text-white hover:text-black font-bold text-lg px-8 py-3.5 rounded-xl transition-all duration-300 transform hover:-translate-y-1 text-center">
                رزرو میز
            </a>
        </div>
        
    </div>
</div>