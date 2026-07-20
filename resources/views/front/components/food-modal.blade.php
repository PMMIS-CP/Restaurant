{{-- Overlay پس‌زمینه مات --}}
<div id="food-modal-overlay" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center transition-all duration-300">
    
    {{-- محتوای نیم‌صفحه مودال --}}
    <div id="food-modal-content" class="relative w-full max-w-lg mx-4 bg-[#0f0508] rounded-2xl border border-[#ffd700]/30 shadow-[0_20px_60px_rgba(0,0,0,0.8),0_0_30px_rgba(255,215,0,0.1)] transform scale-95 transition-transform duration-300">
        
        {{-- دکمه بستن --}}
        <button id="modal-close-btn" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-[#1a080c] border border-[#ffd700]/20 text-gray-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 transition-all duration-200 z-20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- گالری تصاویر غذا (حداکثر ۶ تصویر) --}}
        <div class="relative w-full h-56 sm:h-64 rounded-t-2xl overflow-hidden">
            {{-- کانتینر تصاویر --}}
            <div id="modal-food-gallery" class="w-full h-full relative bg-[#1a080c]">
                <div id="modal-gallery-loading" class="absolute inset-0 flex items-center justify-center">
                    <div class="w-8 h-8 border-2 border-[#ffd700]/30 border-t-[#ffd700] rounded-full animate-spin"></div>
                </div>
            </div>
            
            {{-- گرادینت محو پایین --}}
            <div class="absolute inset-0 bg-linear-to-t from-[#0f0508] via-transparent to-transparent pointer-events-none"></div>
            
            {{-- فلش قبلی --}}
            <button id="modal-prev-image" class="absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center rounded-full bg-black/50 text-white/80 hover:bg-black/70 hover:text-white transition-all duration-200 z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            {{-- فلش بعدی --}}
            <button id="modal-next-image" class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center rounded-full bg-black/50 text-white/80 hover:bg-black/70 hover:text-white transition-all duration-200 z-10">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- نقاط نشان‌دهنده اسلاید --}}
            <div id="modal-image-dots" class="absolute bottom-3 left-0 right-0 flex justify-center gap-1.5 z-10"></div>
        </div>

        {{-- جزئیات غذا --}}
        <div class="p-6 pt-4 space-y-4">
            {{-- نام فارسی و قیمت --}}
            <div class="flex items-start justify-between gap-4">
                <h3 id="modal-food-name" class="text-xl sm:text-2xl font-bold text-[#ffd700] leading-tight">---</h3>
                <div class="shrink-0 bg-[#2a050a]/80 px-4 py-2 rounded-lg border border-[#ffd700]/40 shadow-[0_0_15px_rgba(255,215,0,0.15)]">
                    <span id="modal-food-price" class="text-lg font-black text-[#ffd700]">---</span>
                    <span class="text-[10px] font-normal text-gray-400 mr-1">{{ __('food-modal.toman') }}</span>
                </div>
            </div>

            {{-- خط جداکننده --}}
            <div class="border-t border-[#ffd700]/10"></div>

            {{-- توضیحات --}}
            <p id="modal-food-details" class="text-sm text-gray-300 leading-relaxed text-justify">---</p>

            {{-- دکمه افزودن به سبد خرید --}}
            <button id="modal-add-to-cart-btn" class="w-full py-3 mt-4 bg-linear-to-r from-[#ffd700]/20 to-[#ffd700]/10 border border-[#ffd700]/40 rounded-xl text-[#ffd700] font-bold text-lg hover:from-[#ffd700]/30 hover:to-[#ffd700]/20 hover:shadow-[0_0_20px_rgba(255,215,0,0.2)] transition-all duration-300">
                {{ __('food-modal.add_to_cart') }}
                <span class="text-sm font-normal text-gray-400 mr-2">+</span>
            </button>
        </div>
    </div>
</div>

{{-- تمام داده‌های مورد نیاز اسکریپت در یک تگ --}}
<script>window.FoodModalData={digits:@json(__('food-modal.digits')),translations:{no_image:@json(__('food-modal.no_image')),loading:@json(__('food-modal.loading')),error_fetch:@json(__('food-modal.error_fetch')),no_description:@json(__('food-modal.no_description')),error_loading:@json(__('food-modal.error_loading')),error_retry:@json(__('food-modal.error_retry')),incomplete_product:@json(__('food-modal.incomplete_product')),error_add_failed:@json(__('food-modal.error_add_failed')),added_to_cart:@json(__('food-modal.added_to_cart')),error_add_to_cart:@json(__('food-modal.error_add_to_cart'))},csrfToken:document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||''};</script>