@extends('front.layouts.app')

@section('content')
@php
    $images = [
        'assets/images/790015.png',
        'assets/images/790636.png',
        'assets/images/792410.png',
        'assets/images/792412.png',
        'assets/images/831644.png',
        'assets/images/839115.png',
    ];
@endphp

<div class="mt-20 py-12 flex justify-center items-center overflow-hidden">
    <div class="swiper card-swiper w-[95%] max-w-4xl aspect-15/5 py-5">
        <div class="swiper-wrapper">
            @foreach($images as $image)
            <div class="swiper-slide rounded-2xl overflow-hidden relative shadow-xl">
                <img src="{{ asset($image) }}" loading="lazy" class="w-full h-full object-cover">
            </div>
            @endforeach
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
                perSlideOffset: 8,
                perSlideRotate: 2,
                rotate: true,
            },

            watchSlidesProgress: true,
        });
    });
</script>
@endpush
@endsection