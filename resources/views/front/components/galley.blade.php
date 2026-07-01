@props(['images' => []])
<div class="text-center mb-6 mt-10">
    <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-800 relative inline-block">
        گالری رستوران
    </h2>
</div>
<div class="max-w-6xl mx-auto p-4" 
     x-data="{ animate: false }" 
     x-init="setInterval(() => { animate = !animate }, 2000)">
    
    <div class="flex flex-col lg:flex-row items-center gap-6 mb-8">
        <div class="hidden lg:block flex-1 h-48 bg-gray-200 rounded-xl overflow-hidden shadow-md transition-all duration-700 ease-in-out"
            :class="animate ? 'ltr:-translate-x-8 ltr:translate-y-4 rtl:translate-x-8 rtl:translate-y-4 rotate-2' : 'translate-x-0 translate-y-0 rotate-0'">
            <img src="{{ asset($images[0]) }}" class="w-full h-full object-cover">
        </div>

        <div class="w-full max-w-lg mx-auto lg:mx-0 shrink-0">
            <div class="swiper card-swiper w-full aspect-9/5 py-5">
                <div class="swiper-wrapper">
                    @foreach($images as $image)
                    <div class="swiper-slide rounded-2xl overflow-hidden relative shadow-xl">
                        <img src="{{ asset($image) }}" loading="lazy" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="hidden lg:block flex-1 h-48 bg-gray-200 rounded-xl overflow-hidden shadow-md transition-all duration-700 ease-in-out"
            :class="animate ? 'ltr:translate-x-8 ltr:translate-y-4 rtl:-translate-x-8 rtl:translate-y-4 -rotate-2' : 'translate-x-0 translate-y-0 rotate-0'">
            <img src="{{ asset($images[1]) }}" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
        <div class="lg:hidden aspect-square bg-gray-300 rounded-2xl overflow-hidden shadow-lg transition-all duration-700 ease-in-out"
             :class="animate ? 'scale-105' : 'scale-100'">
            <img src="{{ asset($images[0]) }}" class="w-full h-full object-cover">
        </div>
        <div class="lg:hidden aspect-square bg-gray-300 rounded-2xl overflow-hidden shadow-lg transition-all duration-700 ease-in-out"
             :class="animate ? 'scale-105' : 'scale-100'">
            <img src="{{ asset($images[1]) }}" class="w-full h-full object-cover">
        </div>

        <div class="aspect-square bg-gray-300 rounded-2xl overflow-hidden shadow-lg transition-all duration-700 ease-in-out"
             :class="animate ? 'transform translate-y-4' : 'transform translate-y-0'">
            <img src="{{ asset($images[2]) }}" class="w-full h-full object-cover">
        </div>
        
        <div class="aspect-square bg-gray-300 rounded-2xl overflow-hidden shadow-lg transition-all duration-700 ease-in-out order-4 lg:order-5"
             :class="animate ? 'transform -translate-y-4' : 'transform translate-y-0'">
            <img src="{{ asset($images[4]) }}" class="w-full h-full object-cover">
        </div>

        <div class="image-container relative aspect-2/1 lg:aspect-square bg-gray-300 rounded-2xl overflow-hidden shadow-lg group cursor-pointer col-span-2 lg:col-span-1 order-5 lg:order-4">
            <img src="{{ asset($images[3]) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-black/60 hidden lg:flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <span class="text-white font-semibold text-lg">مشاهده تصاویر بیشتر</span>
            </div>
            
            <div class="absolute bottom-0 left-0 right-0 bg-black/60 flex lg:hidden items-center justify-center py-3">
                <span class="text-white font-semibold text-base">مشاهده تصاویر بیشتر</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.card-swiper', {
            modules: [SwiperEffectCards, SwiperAutoplay],
            effect: 'cards',
            rtl: true, 
            loop: false,
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            observer: true,
            observeParents: true,
            observeSlideChildren: true, 

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            cardsEffect: {
                slideShadows: true,
                perSlideOffset: 10,
                perSlideRotate: 3,
                rotate: true,
            },
        });
    });
</script>
@endpush