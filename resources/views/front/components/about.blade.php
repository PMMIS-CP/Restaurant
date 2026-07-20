<section class="relative overflow-hidden bg-linear-to-b from-[#FFF8E7] to-[#FDF3E1] py-12 sm:py-16 md:py-24">
    <div class="absolute inset-s-0 top-0 h-full w-1.5 sm:w-2 bg-[#C41E3A] shadow-[4px_0_10px_rgba(212,175,55,0.4)]"></div>
    <div class="container mx-auto px-4 sm:px-6">
        <div class="mb-8 sm:mb-10 md:mb-12 text-center md:text-start">
            <span class="inline-block rounded-full bg-[#C41E3A]/10 px-3 sm:px-4 py-1 sm:py-1.5 text-xs sm:text-sm font-semibold text-[#8B1A2B] ring-1 ring-[#D4AF37]/40">
                {{ __('home.about.badge') }}
            </span>
            <p class="mt-2 sm:mt-3 text-lg sm:text-xl font-bold text-[#3E2723] md:text-2xl">
                {{ __('home.about.subtitle') }}
            </p>
        </div>
        <div class="flex flex-col items-center gap-8 sm:gap-10 md:gap-12 md:flex-row">
            <div class="w-full text-center md:w-1/2 md:text-start">
                <h2 id="about-us" class="text-2xl sm:text-3xl font-extrabold text-[#5D1A1A] md:text-4xl lg:text-5xl">
                    {{ __('home.about.title') }}
                </h2>
                <p class="mt-4 sm:mt-5 md:mt-6 text-base sm:text-lg leading-relaxed text-[#4A3424]">
                    {{ __('home.about.description') }}
                </p>
                <div class="mt-6 sm:mt-7 md:mt-8 flex justify-center md:justify-start">
                    <a href="{{ url('/about') }}" 
                    class="group inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-xl bg-[#C41E3A] px-5 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base text-[#FFF8E7] shadow-lg shadow-[#D4AF37]/30 ring-1 ring-[#D4AF37] transition-all duration-500 hover:bg-[#8B1A2B] hover:shadow-xl hover:shadow-[#D4AF37]/50 hover:ring-2">
                        <span class="font-medium">{{ __('home.about.cta') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" sm:width="20" sm:height="20" viewBox="0 0 24 24" fill="none" 
                            class="ltr:block rtl:hidden text-[#FFD700] transition-transform duration-300 group-hover:-translate-x-1">
                            <path d="M16.8 12C16.8 11.3 16.53 10.6 16 10.07L9.48 3.55C9.19 3.26 8.71 3.26 8.42 3.55C8.13 3.84 8.13 4.32 8.42 4.61L14.94 11.13C15.42 11.61 15.42 12.39 14.94 12.87L8.42 19.39C8.13 19.68 8.13 20.16 8.42 20.45C8.71 20.74 9.19 20.74 9.48 20.45L16 13.93C16.53 13.4 16.8 12.7 16.8 12Z" 
                                fill="currentColor"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" sm:width="20" sm:height="20" viewBox="0 0 24 24" fill="none" 
                            class="rtl:block ltr:hidden text-[#FFD700] transition-transform duration-300 group-hover:translate-x-1">
                            <path d="M7.2 12C7.2 11.3 7.47 10.6 8 10.07L14.52 3.55C14.81 3.26 15.29 3.26 15.58 3.55C15.87 3.84 15.87 4.32 15.58 4.61L9.06 11.13C8.58 11.61 8.58 12.39 9.06 12.87L15.58 19.39C15.87 19.68 15.87 20.16 15.58 20.45C15.29 20.74 14.81 20.74 14.52 20.45L8 13.93C7.47 13.4 7.2 12.7 7.2 12Z" 
                                fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="relative px-2 sm:px-0">
                    <div class="absolute -inset-3 sm:-inset-4 rounded-2xl sm:rounded-3xl bg-[#C41E3A]/10 sm:bg-[#C41E3A]/20 blur-xl sm:blur-2xl"></div>
                    <div class="absolute -inset-0.5 sm:-inset-1 rounded-xl sm:rounded-2xl bg-linear-to-tr from-[#D4AF37] via-[#F1E5AC] to-[#D4AF37] p-0.5 shadow-[0_0_20px_rgba(212,175,55,0.4)] sm:shadow-[0_0_30px_rgba(212,175,55,0.6)]"></div>
                    <img src="{{ asset('assets/images/IMG_20260702_113844.webp') }}" 
                         alt="{{ __('home.about.image_alt') }}" 
                         class="relative w-full rounded-xl sm:rounded-2xl shadow-xl sm:shadow-2xl" 
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>