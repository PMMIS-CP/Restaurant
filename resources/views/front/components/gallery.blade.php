@props(['images' => []])
{{-- <!-- پس‌زمینه اختصاصی کاخ موراکو --> --}}
<div class="relative w-full bg-linear-to-br from-red-900 to-amber-900 overflow-hidden py-16">
    <svg class="absolute inset-0 w-full h-full opacity-30 pointer-events-none" viewBox="0 0 1000 1000" preserveAspectRatio="none">
        
        <g class="circles">
            <circle cx="150" cy="300" r="30" fill="#fbbf24" class="pulse-circle" />
            <circle cx="400" cy="100" r="40" fill="#fbbf24" class="pulse-circle" />
            <circle cx="700" cy="700" r="25" fill="#fbbf24" class="pulse-circle" />
            <circle cx="900" cy="500" r="35" fill="#fbbf24" class="pulse-circle" />
            <circle cx="300" cy="800" r="20" fill="#fbbf24" class="pulse-circle" />
        </g>

    </svg>

    <div class="relative z-10">
        <div class="text-center mb-6 mt-10">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-amber-100 drop-shadow-lg">{{ __('home.gallery.title') }}</h2>
        </div>
        <div class="mb-20 mt-8 py-8 flex justify-center items-center overflow-hidden">
            <div class="swiper card-swiper w-[85%] md:w-[90%] max-w-2xl aspect-9/4">
                <div class="swiper-wrapper">
                    @foreach($images as $image)
                    <div class="swiper-slide rounded-2xl overflow-hidden shadow-2xl border-2 border-amber-500/30">
                        <img src="{{ asset($image) }}" alt="Restaurant Image" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>