{{-- Overlay پس‌زمینه مات --}}
<div id="food-modal-overlay" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 hidden items-center justify-center transition-all duration-300">
    
    {{-- محتوای نیم‌صفحه مودال --}}
    <div id="food-modal-content" class="relative w-full max-w-lg mx-4 bg-[#0f0508] rounded-2xl border border-[#ffd700]/30 shadow-[0_20px_60px_rgba(0,0,0,0.8),0_0_30px_rgba(255,215,0,0.1)] transform scale-95 transition-transform duration-300">
        
        {{-- دکمه بستن --}}
        <button id="modal-close-btn" class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-[#1a080c] border border-[#ffd700]/20 text-gray-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 transition-all duration-200 z-10">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        {{-- تصویر غذا --}}
        <div class="relative w-full h-56 sm:h-64 rounded-t-2xl overflow-hidden">
            <img id="modal-food-image" src="" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-linear-to-t from-[#0f0508] via-transparent to-transparent"></div>
        </div>

        {{-- جزئیات غذا --}}
        <div class="p-6 pt-4 space-y-4">
            {{-- نام فارسی و قیمت --}}
            <div class="flex items-start justify-between gap-4">
                <h3 id="modal-food-name" class="text-xl sm:text-2xl font-bold text-[#ffd700] leading-tight"></h3>
                <div class="shrink-0 bg-[#2a050a]/80 px-4 py-2 rounded-lg border border-[#ffd700]/40 shadow-[0_0_15px_rgba(255,215,0,0.15)]">
                    <span id="modal-food-price" class="text-lg font-black text-[#ffd700]"></span>
                    <span class="text-[10px] font-normal text-gray-400 mr-1">تومان</span>
                </div>
            </div>


            {{-- خط جداکننده --}}
            <div class="border-t border-[#ffd700]/10"></div>

            {{-- توضیحات --}}
            <p id="modal-food-details" class="text-sm text-gray-300 leading-relaxed text-justify"></p>

            {{-- دکمه افزودن به سبد خرید --}}
            <button id="modal-add-to-cart-btn" class="w-full py-3 mt-4 bg-linear-to-r from-[#ffd700]/20 to-[#ffd700]/10 border border-[#ffd700]/40 rounded-xl text-[#ffd700] font-bold text-lg hover:from-[#ffd700]/30 hover:to-[#ffd700]/20 hover:shadow-[0_0_20px_rgba(255,215,0,0.2)] transition-all duration-300">
                افزودن به سبد خرید
                <span class="text-sm font-normal text-gray-400 mr-2">+</span>
            </button>
        </div>
    </div>
</div>

<script>
window.menuData = @json($grouped ?? []);
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('food-modal-overlay');
    const modalContent = document.getElementById('food-modal-content');
    const closeBtn = document.getElementById('modal-close-btn');
    
    const modalImage = document.getElementById('modal-food-image');
    const modalName = document.getElementById('modal-food-name');
    const modalPrice = document.getElementById('modal-food-price');
    const modalDetails = document.getElementById('modal-food-details');
    const addToCartBtn = document.getElementById('modal-add-to-cart-btn');

    // ذخیره اطلاعات محصول جاری برای ارسال به API
    let currentProduct = {
        type: null,
        id: null,
        name: '',
        price: ''
    };

    // استخراج اطلاعات از DOM (جایگزین findMenuItem)
    function extractProductData(card) {
        const nameEl = card.querySelector('h3');
        const name = nameEl ? nameEl.textContent.trim() : '';
        
        // قیمت
        let price = '';
        if (card.classList.contains('menu-item-card')) {
            const priceEl = card.querySelector('.text-sm.font-black');
            price = priceEl ? priceEl.textContent.trim().replace(/[^\d]/g, '') : '';
        } else {
            const priceEl = card.querySelector('.text-base.font-black');
            price = priceEl ? priceEl.textContent.trim().replace(/[^\d]/g, '') : '';
        }
        
        // تصویر
        const imgEl = card.querySelector('img');
        const image = imgEl ? imgEl.src : '';
        
        // توضیحات
        let details = '';
        if (card.classList.contains('menu-item-card')) {
            const detEl = card.querySelector('p.text-xs.text-gray-400');
            details = detEl ? detEl.textContent.trim() : '';
        } else {
            const detEl = card.querySelector('.line-clamp-2') || card.querySelector('p.text-xs.text-gray-400');
            details = detEl ? detEl.textContent.trim() : '';
        }
        
        // شناسه محصول و نوع
        const productId = card.getAttribute('data-product-id');
        const productType = card.getAttribute('data-product-type');
        
        return { name, price, image, details, productId, productType };
    }

    function openModal(card) {
        const data = extractProductData(card);
        if (!data.productId || !data.productType) {
            console.error('Missing product identifier on card', card);
            return;
        }

        // ذخیره برای درخواست API
        currentProduct = {
            type: data.productType,
            id: data.productId,
            name: data.name,
            price: data.price
        };

        // پر کردن UI
        modalImage.src = data.image;
        modalImage.alt = data.name;
        modalName.textContent = data.name;
        modalPrice.textContent = Number(data.price).toLocaleString();
        modalDetails.textContent = data.details;

        // نمایش مودال
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 50);
    }

    function closeModal() {
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 200);
    }

    // Event delegation روی کل document
    document.addEventListener('click', function(e) {
        const card = e.target.closest('.menu-item-card, .menu-item-desktop, .menu-item-mobile');
        if (card) {
            e.preventDefault();
            openModal(card);
        }
    });

    // بستن مودال
    closeBtn?.addEventListener('click', (e) => { e.stopPropagation(); closeModal(); });
    overlay?.addEventListener('click', (e) => { if (e.target === overlay) closeModal(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !overlay.classList.contains('hidden')) closeModal(); });

    // ========== افزودن به سبد خرید ==========
    addToCartBtn?.addEventListener('click', async function() {
        if (!currentProduct.id || !currentProduct.type) {
            alert('اطلاعات محصول ناقص است.');
            return;
        }

        // disable button to prevent double click
        addToCartBtn.disabled = true;
        const originalHTML = addToCartBtn.innerHTML;

        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_type: currentProduct.type,
                    product_id: currentProduct.id,
                    quantity: 1
                })
            });

            if (!response.ok) {
                const errorData = await response.json().catch(() => null);
                throw new Error(errorData?.message || 'خطا در افزودن به سبد خرید');
            }

            const data = await response.json();

            // نمایش موفقیت
            addToCartBtn.innerHTML = '<span class="inline-flex items-center gap-1">✓ به سبد اضافه شد</span>';
            addToCartBtn.classList.add('bg-green-500/20', 'border-green-500/40', 'text-green-400');

            // به‌روزرسانی UI سبد (آیکون تعداد) - این تابع بعداً تعریف می‌شود
            if (typeof updateCartCount === 'function') {
                updateCartCount(data.count);
            }

        } catch (error) {
            console.error(error);
            addToCartBtn.innerHTML = '<span class="text-red-400">خطا! دوباره تلاش کنید</span>';
            addToCartBtn.classList.add('bg-red-500/20', 'border-red-500/40');
        } finally {
            setTimeout(() => {
                addToCartBtn.disabled = false;
                addToCartBtn.innerHTML = originalHTML;
                addToCartBtn.classList.remove('bg-green-500/20', 'border-green-500/40', 'text-green-400',
                                            'bg-red-500/20', 'border-red-500/40', 'text-red-400');
            }, 1500);
        }
    });
});
</script>