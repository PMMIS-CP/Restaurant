@props(['images' => []])
<div class="text-center mb-6 mt-10">
    <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-800">گالری رستوران</h2>
</div>

<div class="mt-8 py-8 flex justify-center items-center overflow-hidden">
    <div class="swiper card-swiper w-[85%] md:w-[90%] max-w-2xl aspect-9/4">
        <div class="swiper-wrapper">
            @foreach($images as $image)
            <div class="swiper-slide rounded-2xl overflow-hidden shadow-xl">
                <img src="{{ asset($image) }}" alt="Restaurant Image" loading="lazy" class="w-full h-full object-cover">
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
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