@extends('front.layouts.app')

@section('title', 'سبد خرید')

@section('content')
<div class="min-h-screen bg-[#0a0203] text-white px-4 py-8 pb-30 pt-30">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-black text-[#ffd700] mb-8">سبد خرید</h1>

        {{-- لیست آیتم‌ها --}}
        <div id="cart-items-container" class="space-y-4">
            {{-- توسط جاوااسکریپت پر می‌شود --}}
        </div>

        {{-- خلاصه سبد --}}
        <div id="cart-summary" class="hidden mt-8 bg-[#130d0f] border border-[#ffd700]/20 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-400">مجموع</span>
                <span id="cart-total-price" class="text-2xl font-bold text-[#ffd700]">0</span>
            </div>
            <div class="flex gap-4">
                <button id="clear-cart-btn" class="flex-1 py-3 bg-red-500/10 border border-red-500/30 rounded-xl text-red-400 hover:bg-red-500/20 transition">
                    خالی کردن سبد
                </button>
                <button class="flex-1 py-3 bg-[#ffd700]/10 border border-[#ffd700]/40 rounded-xl text-[#ffd700] font-bold hover:bg-[#ffd700]/20 transition">
                    ادامه ثبت سفارش
                </button>
            </div>
        </div>

        {{-- حالت خالی --}}
        <div id="cart-empty" class="hidden text-center py-20">
            <svg class="w-24 h-24 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m2-9l2 9m-9-9h4"/>
            </svg>
            <p class="text-xl text-gray-500">سبد خرید شما خالی است</p>
            <a href="{{ route('menu') }}" class="inline-block mt-4 text-[#ffd700] hover:underline">مشاهده منو</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', async function() {
    const container = document.getElementById('cart-items-container');
    const summary = document.getElementById('cart-summary');
    const empty = document.getElementById('cart-empty');
    const totalPriceEl = document.getElementById('cart-total-price');
    const clearBtn = document.getElementById('clear-cart-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    async function fetchCart() {
        try {
            const res = await fetch('/cart', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!res.ok) throw new Error('خطا در دریافت سبد');
            return await res.json();
        } catch (error) {
            console.error(error);
            return null;
        }
    }

    async function updateCartDisplay() {
        const data = await fetchCart();
        if (!data) return;

        if (data.count === 0) {
            container.innerHTML = '';
            summary.classList.add('hidden');
            empty.classList.remove('hidden');
            return;
        }

        empty.classList.add('hidden');
        summary.classList.remove('hidden');

        totalPriceEl.textContent = Number(data.total).toLocaleString() + ' تومان';

        container.innerHTML = data.items.map(item => `
            <div class="flex items-center gap-4 bg-[#130d0f] border border-[#ffd700]/10 rounded-xl p-4" data-item-id="${item.id}">
                <img src="${item.image || '/images/placeholder.jpg'}" alt="${item.name}" class="w-20 h-20 rounded-lg object-cover border border-[#ffd700]/20">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-white">${item.name}</h3>
                    <p class="text-sm text-gray-400">${Number(item.price).toLocaleString()} تومان</p>
                </div>
                <div class="flex items-center gap-2">
                    <button class="quantity-btn decrease w-8 h-8 rounded-full bg-[#2a050a] border border-[#ffd700]/30 text-[#ffd700] hover:bg-[#ffd700]/20 transition" data-id="${item.id}">−</button>
                    <span class="quantity-value w-8 text-center font-bold text-[#ffd700]">${item.quantity}</span>
                    <button class="quantity-btn increase w-8 h-8 rounded-full bg-[#2a050a] border border-[#ffd700]/30 text-[#ffd700] hover:bg-[#ffd700]/20 transition" data-id="${item.id}">+</button>
                </div>
                <button class="remove-item text-red-400 hover:text-red-300 transition p-2" data-id="${item.id}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        `).join('');
    }

    // Event delegation for quantity and remove
    container.addEventListener('click', async (e) => {
        const btn = e.target.closest('button');
        if (!btn) return;
        const itemId = btn.getAttribute('data-id');
        if (!itemId) return;

        if (btn.classList.contains('increase') || btn.classList.contains('decrease')) {
            const quantitySpan = btn.parentElement.querySelector('.quantity-value');
            let currentQty = parseInt(quantitySpan.textContent);
            const newQty = btn.classList.contains('increase') ? currentQty + 1 : Math.max(1, currentQty - 1);

            try {
                const res = await fetch(`/cart/update/${itemId}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ quantity: newQty })
                });
                if (!res.ok) throw new Error('خطا در بروزرسانی');
                const data = await res.json();
                // Update the item count locally
                if (newQty === 0) {
                    btn.closest('.flex.items-center')?.remove();
                } else {
                    quantitySpan.textContent = newQty;
                }
                // Refresh total from server (or recalculate)
                totalPriceEl.textContent = Number(data.total).toLocaleString() + ' تومان';
                if (data.count === 0) {
                    updateCartDisplay();
                }
            } catch (error) {
                console.error(error);
            }
        } else if (btn.classList.contains('remove-item')) {
            if (!confirm('آیا مطمئن هستید؟')) return;
            try {
                const res = await fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                if (!res.ok) throw new Error('خطا در حذف');
                const data = await res.json();
                if (data.count === 0) {
                    updateCartDisplay();
                } else {
                    btn.closest('.flex.items-center')?.remove();
                    totalPriceEl.textContent = Number(data.total).toLocaleString() + ' تومان';
                }
            } catch (error) {
                console.error(error);
            }
        }
    });

    clearBtn?.addEventListener('click', async () => {
        if (!confirm('همه آیتم‌ها حذف شوند؟')) return;
        try {
            const res = await fetch(`/cart/clear`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!res.ok) throw new Error('خطا');
            updateCartDisplay();
        } catch (error) {
            console.error(error);
        }
    });

    // Initial load
    await updateCartDisplay();

    // Expose updateCartCount for modal
    window.updateCartCount = (count) => {
        // If cart page is open, refresh entire list
        if (document.getElementById('cart-items-container')) {
            updateCartDisplay();
        }
    };
});
</script>
@endpush