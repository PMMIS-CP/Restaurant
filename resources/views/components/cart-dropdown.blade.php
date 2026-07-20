{{-- دکمه شناور سبد خرید - پایین صفحه --}}
<a href="{{ route('cart.index') }}" 
   id="floating-cart-btn"
   class="fixed bottom-6 left-6 z-50 w-14 h-14 bg-[#0a0203] border-2 border-[#ffd700]/40 rounded-full flex items-center justify-center shadow-[0_8px_30px_rgba(0,0,0,0.6),0_0_15px_rgba(255,215,0,0.2)] hover:border-[#ffd700] hover:shadow-[0_8px_35px_rgba(0,0,0,0.7),0_0_20px_rgba(255,215,0,0.3)] transition-all duration-300 group">
    
    {{-- آیکون سبد --}}
    <svg class="w-6 h-6 text-[#ffd700] group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
    </svg>

    {{-- badge تعداد --}}
    <span id="cart-badge" 
          class="absolute -top-1.5 -right-1.5 min-w-5.5 h-5.5 bg-red-600 text-white text-[11px] font-bold rounded-full flex items-center justify-center px-1 shadow-[0_2px_8px_rgba(220,38,38,0.5)] border-2 border-[#0a0203]">
        0
    </span>
</a>

<style>
@keyframes ping-once {
    0% { transform: scale(1); }
    50% { transform: scale(1.3); }
    100% { transform: scale(1); }
}
.animate-ping-once {
    animation: ping-once 0.3s ease-in-out;
}
</style>