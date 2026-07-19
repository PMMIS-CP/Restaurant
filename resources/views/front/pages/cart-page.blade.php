@extends('front.layouts.app')

@section('title', __('cart.page_title'))

@section('content')
<div class="min-h-screen bg-[#0a0203] text-white px-4 py-8 pb-30 pt-30">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-black text-[#ffd700] mb-8">{{ __('cart.title') }}</h1>

        {{-- لیست آیتم‌ها --}}
        <div id="cart-items-container" class="space-y-4">
            {{-- توسط جاوااسکریپت پر می‌شود --}}
        </div>

        {{-- خلاصه سبد --}}
        <div id="cart-summary" class="hidden mt-8 bg-[#130d0f] border border-[#ffd700]/20 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-400">{{ __('cart.total_label') }}</span>
                <span id="cart-total-price" class="text-2xl font-bold text-[#ffd700]">0</span>
            </div>
            <div class="flex gap-4">
                <button id="clear-cart-btn" class="flex-1 py-3 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 hover:bg-red-500/20 transition">
                    {{ __('cart.clear_cart') }}
                </button>
                <button class="flex-1 py-3 bg-[#ffd700]/10 border border-[#ffd700]/40 rounded-xl text-[#ffd700] font-bold hover:bg-[#ffd700]/20 transition">
                    {{ __('cart.continue_order') }}
                </button>
            </div>
        </div>

        {{-- حالت خالی --}}
        <div id="cart-empty" class="hidden text-center py-20">
            <svg class="w-24 h-24 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m2-9l2 9m-9-9h4"/>
            </svg>
            <p class="text-xl text-gray-500">{{ __('cart.empty_title') }}</p>
             <a href="{{ route('menu') }}" class="inline-block mt-4 text-[#ffd700] hover:underline">{{ __('cart.view_menu') }}</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// پاس دادن ترجمه‌ها به جاوااسکریپت
window.cartTranslations = {
    errorFetchCart: '{{ __("cart.error_fetch_cart") }}',
    errorUpdate: '{{ __("cart.error_update") }}',
    errorDelete: '{{ __("cart.error_delete") }}',
    errorGeneral: '{{ __("cart.error_general") }}',
    currency: '{{ __("cart.currency") }}',
    confirmDelete: '{{ __("cart.confirm_delete") }}',
    confirmClearAll: '{{ __("cart.confirm_clear_all") }}'
};
</script>
@endpush