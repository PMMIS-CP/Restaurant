{{-- سئو و ساختار معنایی: استفاده از تگ استاندارد section به همراه شناسه یکتا برای موتورهای جستجو --}}
<section id="user-testimonials" aria-labelledby="testimonials-heading" class="w-full py-16 bg-linear-to-b from-[#8B0000]/5 to-transparent relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- عنوان بخش با رعایت دقیق ساختار درختی هدینگ‌ها (H2 برای سئو عالی صفحه اصلی) --}}
        <div class="w-24 h-1 bg-[#D4AF37] mx-auto mb-4 rounded-full" aria-hidden="true"></div>
        <div class="text-center mb-12">
            <h2 id="testimonials-heading" class="text-3xl md:text-4xl font-extrabold text-[#8B0000] tracking-tight relative inline-block">
                {{ __('home.comments.section_title') }}
            </h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                {{ __('home.comments.section_description') }}
            </p>
        </div>

        <style>
            .swiper-container-custom { cursor: grab; }
            .swiper-container-custom:active { cursor: grabbing; }
            
            /* === تنظیمات اصلی برای برابری ارتفاع و عرض === */
            .swiper {
                width: 100%;
            }
            
            .swiper-wrapper {
                display: flex !important;
                align-items: stretch !important;
            }
            
            .swiper-slide {
                height: auto !important;
                display: flex !important;
                align-self: stretch !important;
            }
            
            .swiper-slide > div {
                height: 100%;
                width: 100%;
            }
            
            /* کارت سفید داخلی - پر کردن کامل فضا */
            .swiper-slide .bg-white {
                height: 100%;
                width: 100%;
                display: flex;
                flex-direction: column;
            }
            
            /* بخش blockquote فضای باقی‌مانده را پر کند */
            .swiper-slide blockquote {
                flex: 1;
            }
        </style>

        {{-- محفظه اصلی اسلایدر --}}
        <div 
            x-data="customSwiper"
            x-init="initSwiper()"
            class="relative swiper-container-custom"
            role="region"
            aria-label="نظرات کاربران"
        >
            {{-- محفظه اسلایدها --}}
            <div x-ref="swiperContainer" class="swiper overflow-hidden rounded-2xl px-2! py-4!">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        {{-- تزریق ریچ اسنیپت‌های Schema.org (نوع Review) برای نمایش ستاره‌ها و نظرات در نتایج سرچ گوگل --}}
                        <div class="swiper-slide h-auto" itemscope itemtype="https://schema.org/Review">
                            <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border-t-4 border-[#D4AF37] h-full flex flex-col mx-2 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1.5 relative overflow-hidden">
                                
                                {{-- المان‌های تزئینی گوشه‌ها با پوزیشن منطقی (پشتیبانی بی‌نقص از LTR/RTL) --}}
                                <div class="absolute -top-4 -inset-s-4 w-16 h-16 bg-[#D4AF37]/10 rounded-full pointer-events-none" aria-hidden="true"></div>
                                <div class="absolute -bottom-4 -inset-e-4 w-20 h-20 bg-[#8B0000]/5 rounded-full pointer-events-none" aria-hidden="true"></div>

                                {{-- آواتار و مشخصات نویسنده --}}
                                <div class="flex flex-col items-center mb-5 relative z-10" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                    <div class="w-20 h-20 rounded-full overflow-hidden ring-4 ring-[#8B0000]/10 mb-4 bg-linear-to-br from-[#8B0000]/10 to-[#D4AF37]/20 flex items-center justify-center shadow-inner">
                                        {{-- آیکون پیش‌فرض مجهز به شناسه عدم خوانش سیستمی --}}
                                        <svg class="w-12 h-12 text-[#8B0000]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v1.2c0 .66.54 1.2 1.2 1.2h16.8c.66 0 1.2-.54 1.2-1.2v-1.2c0-3.2-6.4-4.8-9.6-4.8z"/>
                                        </svg>
                                    </div>
                                    
                                    <h3 itemprop="name" class="text-lg font-bold text-[#8B0000] mb-2">{{ $testimonial['name'] }}</h3>
                                    
                                    {{-- سیستم امتیازدهی ستاره‌ای متصل به میکرو دیتای گوگل --}}
                                    <div class="flex gap-0.5 text-[#D4AF37]" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                        <meta itemprop="worstRating" content="1" />
                                        <meta itemprop="ratingValue" content="5" />
                                        <meta itemprop="bestRating" content="5" />
                                        @for ($i = 0; $i < 5; $i++)
                                            {!! $starIcon !!}
                                        @endfor
                                    </div>
                                </div>

                                {{-- متن اصلی نظر کاربران --}}
                                <blockquote class="text-gray-700 text-center leading-relaxed grow relative z-10">
                                    <svg class="w-8 h-8 text-[#D4AF37]/20 mx-auto mb-3 transform rtl:rotate-180" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
                                    </svg>
                                    <p itemprop="reviewBody" class="italic font-medium text-sm md:text-base text-gray-800">
                                        "{{ $testimonial['comment'] }}"
                                    </p>
                                </blockquote>

                                {{-- برچسب‌ها/تگ‌های نظر --}}
                                @if(!empty($testimonial['tags']))
                                    <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-center gap-2 relative z-10">
                                        @foreach($testimonial['tags'] as $tag)
                                            <span class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $tagColors[$tag] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- صفحه‌بندی مجهز به ملزومات ناوبری خوانشگرها --}}
            <div x-ref="pagination" class="flex justify-center mt-8 gap-2" role="navigation" aria-label="صفحات اسلایدر"></div>
        </div>

        {{-- ==================== بخش ارسال نظر ==================== --}}
        <div class="mt-24 max-w-2xl mx-auto">
            <h3 id="form-heading" class="text-2xl font-bold text-[#8B0000] text-center mb-8">{{ __('home.comments.form_title') }}</h3>

            {{-- نمایش هوشمند و استاندارد پیام موفقیت --}}
            @if(session('success'))
                <div role="alert" class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-center font-medium text-sm transition-all animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            @auth
                {{-- فرم ارسال نظر کاربر عضو --}}
                <form action="{{ route('comments.store') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border-t-4 border-[#D4AF37] space-y-6" aria-labelledby="form-heading">
                    @csrf
                    <div>
                        <label for="comment-name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('home.comments.form_name_label') }}</label>
                        <input type="text" name="name" id="comment-name" autocomplete="name"
                               value="{{ old('name', Auth::user()->name) }}"
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-[#8B0000]/40 focus:border-[#8B0000] outline-hidden transition duration-200"
                               aria-required="true"
                               required>
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-600 font-medium" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="comment-body" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('home.comments.form_comment_label') }}</label>
                        <textarea name="comment" id="comment-body" rows="5"
                                  class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-[#8B0000]/40 focus:border-[#8B0000] outline-hidden transition duration-200"
                                  aria-required="true"
                                  required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="mt-1.5 text-xs text-red-600 font-medium" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" 
                            class="w-full py-3 bg-[#8B0000] text-white rounded-xl hover:bg-[#6b0000] shadow-md hover:shadow-lg transition-all duration-300 font-bold text-sm cursor-pointer">
                        {{ __('home.comments.form_submit') }}
                    </button>
                    <p class="text-xs text-gray-400 text-center">{{ __('home.comments.form_notice') }}</p>
                </form>
            @else
                {{-- حالت مهمان: نمایش بهینه بدون محتوای شکسته با استفاده از فیلترهای استاندارد --}}
                <div class="relative group">
                    <div class="bg-white rounded-2xl shadow-md p-6 md:p-8 border-t-4 border-gray-200 opacity-40 blur-[2px] pointer-events-none select-none" aria-hidden="true">
                        <div class="space-y-6">
                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-1">{{ __('home.comments.form_name_label') }}</span>
                                <div class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-50 text-sm text-gray-400">{{ __('home.comments.guest_placeholder_name') }}</div>
                            </div>
                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-1">{{ __('home.comments.form_comment_label') }}</span>
                                <div class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-50 h-32 text-sm text-gray-400"></div>
                            </div>
                            <div class="w-full py-3 bg-gray-200 rounded-xl text-center text-sm text-gray-400 font-medium">{{ __('home.comments.guest_placeholder_submit') }}</div>
                        </div>
                    </div>
                    
                    {{-- لایه کارت راهنمای مهمان --}}
                    <div class="absolute inset-0 flex items-center justify-center p-4">
                        <div class="bg-white/95 backdrop-blur-xs rounded-2xl p-6 md:p-8 shadow-2xl text-center max-w-sm border border-gray-100 transition-transform duration-300 group-hover:scale-[1.02]">
                            <svg class="w-12 h-12 text-[#D4AF37] mx-auto mb-4 animate-bounce" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/>
                            </svg>
                            <h4 class="text-gray-900 font-bold text-lg mb-2">{{ __('home.comments.guest_overlay_title') }}</h4>
                            <p class="text-xs md:text-sm text-gray-600 mb-5 leading-relaxed">{{ __('home.comments.guest_overlay_description') }}</p>
                            <a href="{{ route('login') }}" class="inline-block px-8 py-2.5 bg-[#8B0000] text-white rounded-full hover:bg-[#6b0000] shadow-md hover:shadow-lg transition-all duration-300 text-sm font-bold">
                                {{ __('home.comments.guest_login_button') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</section>