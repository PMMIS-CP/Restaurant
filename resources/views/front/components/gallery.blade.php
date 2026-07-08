@props(['images' => []])
{{-- <!-- پس‌زمینه اختصاصی کاخ موراکو --> --}}
<div class="relative w-full bg-linear-to-br from-red-900 to-amber-900 overflow-hidden py-16">
    <svg class="absolute inset-0 w-full h-full opacity-30 pointer-events-none" viewBox="0 0 1000 1000" preserveAspectRatio="none">
        <g class="stars">
            <polygon points="50,0 61,35 98,35 68,57 79,91 50,70 21,91 32,57 2,35 39,35" fill="#fbbf24" class="star" />
            <use href="#star-template" x="200" y="100" />
            <use href="#star-template" x="500" y="600" />
            <use href="#star-template" x="800" y="200" />
            <use href="#star-template" x="100" y="700" />
        </g>
        
        <g class="circles">
            <circle cx="150" cy="300" r="30" fill="#fbbf24" class="pulse-circle" />
            <circle cx="400" cy="100" r="40" fill="#fbbf24" class="pulse-circle" />
            <circle cx="700" cy="700" r="25" fill="#fbbf24" class="pulse-circle" />
            <circle cx="900" cy="500" r="35" fill="#fbbf24" class="pulse-circle" />
            <circle cx="300" cy="800" r="20" fill="#fbbf24" class="pulse-circle" />
        </g>

        <g class="triangles">
            <polygon points="50,0 100,87 0,87" fill="#fbbf24" class="rotate-triangle" />
            <use href="#tri-template" x="600" y="300" />
            <use href="#tri-template" x="200" y="500" />
            <use href="#tri-template" x="850" y="700" />
            <use href="#tri-template" x="50" y="400" />
        </g>

        <defs>
            <polygon id="star-template" points="50,0 61,35 98,35 68,57 79,91 50,70 21,91 32,57 2,35 39,35" fill="#fbbf24" class="star" />
            <polygon id="tri-template" points="50,0 100,87 0,87" fill="#fbbf24" class="rotate-triangle" />
        </defs>
    </svg>

    <div class="relative z-10">
        <div class="text-center mb-6 mt-10">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-amber-100 drop-shadow-lg">گالری رستوران کاخ موراکو</h2>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // انیمیشن ستاره‌ها (حرکت رفت و برگشتی)
        window.gsap.to(".star", { y: -30, duration: 2, repeat: -1, yoyo: true, ease: "power1.inOut", stagger: 0.4 });
        
        // انیمیشن دایره‌ها (تغییر شعاع/قطر)
        window.gsap.to(".pulse-circle", { scale: 1.5, opacity: 0.3, duration: 2.5, repeat: -1, yoyo: true, ease: "sine.inOut", stagger: 0.5 });
        
        // انیمیشن مثلث‌ها (چرخش ۳۶۰ درجه)
        window.gsap.to(".rotate-triangle", { rotation: 360, duration: 10, repeat: -1, ease: "none", transformOrigin: "50% 50%" });

        // مقداردهی سوایپر
        new window.Swiper('.card-swiper', {
            modules: [window.SwiperEffectCards, window.SwiperAutoplay],
            effect: "cards",
            grabCursor: true,
            loop: true,
            autoplay: { delay: 3000 }
        });
    });
</script>
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