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

            {{-- نام لاتین --}}
            <p id="modal-food-latin" class="text-xs text-gray-500 font-mono tracking-wider uppercase opacity-80"></p>

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
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('food-modal-overlay');
    const modalContent = document.getElementById('food-modal-content');
    const closeBtn = document.getElementById('modal-close-btn');
    
    // المان‌های داخل مودال
    const modalImage = document.getElementById('modal-food-image');
    const modalName = document.getElementById('modal-food-name');
    const modalPrice = document.getElementById('modal-food-price');
    const modalLatin = document.getElementById('modal-food-latin');
    const modalDetails = document.getElementById('modal-food-details');

    // تابع باز کردن مودال
    function openModal(foodCard) {
        // استخراج اطلاعات از کارت غذا
        const imgElement = foodCard.querySelector('img');
        const nameElement = foodCard.querySelector('h3');
        const priceElement = foodCard.querySelector('[data-price]');
        const latinElement = foodCard.querySelector('.font-mono');
        const detailsElement = foodCard.querySelector('.line-clamp-2');
        const priceDisplay = foodCard.querySelector('.text-base.font-black');
        
        // پر کردن مودال با اطلاعات
        modalImage.src = imgElement ? imgElement.src : '';
        modalImage.alt = imgElement ? imgElement.alt : '';
        modalName.textContent = nameElement ? nameElement.textContent.trim() : '';
        
        // استخراج فقط عدد قیمت از متن
        if (priceDisplay) {
            const priceText = priceDisplay.textContent.trim();
            const priceNumber = priceText.replace(/[^\d,]/g, '');
            modalPrice.textContent = priceNumber;
        }
        
        modalLatin.textContent = latinElement ? latinElement.textContent.trim() : '';
        modalDetails.textContent = detailsElement ? detailsElement.textContent.trim() : '';

        // نمایش مودال
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.classList.add('overflow-hidden');
        
        // انیمیشن
        setTimeout(() => {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 50);
    }

    // تابع بستن مودال
    function closeModal() {
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        
        setTimeout(() => {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 200);
    }

    // کلیک روی کارت‌های غذا (Event Delegation)
    document.addEventListener('click', function(e) {
        const foodCard = e.target.closest('.menu-item-desktop');
        if (foodCard) {
            e.preventDefault();
            openModal(foodCard);
        }
    });

    // کلیک روی دکمه بستن
    closeBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        closeModal();
    });

    // کلیک روی overlay (خارج از مودال)
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            closeModal();
        }
    });

    // بستن با کلید Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !overlay.classList.contains('hidden')) {
            closeModal();
        }
    });

    // دکمه افزودن به سبد خرید (نمونه)
    const addToCartBtn = document.getElementById('modal-add-to-cart-btn');
    addToCartBtn.addEventListener('click', function() {
        const foodName = modalName.textContent;
        const foodPrice = modalPrice.textContent;
        
        // اینجا منطق افزودن به سبد خرید رو پیاده‌سازی کن
        // می‌تونی از Local Storage یا متغیرهای جاوااسکریپت استفاده کنی
        
        // نمایش پیام موقت
        const originalText = addToCartBtn.innerHTML;
        addToCartBtn.innerHTML = '✓ به سبد اضافه شد';
        addToCartBtn.classList.add('bg-green-500/20', 'border-green-500/40', 'text-green-400');
        
        setTimeout(() => {
            addToCartBtn.innerHTML = originalText;
            addToCartBtn.classList.remove('bg-green-500/20', 'border-green-500/40', 'text-green-400');
        }, 1500);
        
        console.log('اضافه شد به سبد:', foodName, foodPrice);
    });
});
</script>