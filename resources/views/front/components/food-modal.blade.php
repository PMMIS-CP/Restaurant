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

{{-- دیتای منو برای استفاده در جاوااسکریپت --}}
<script>
window.menuData = @json($grouped ?? []);
</script>

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

    // تابع پیدا کردن آیتم در menuData بر اساس اسم فارسی
    function findMenuItem(foodNameFa) {
        if (!window.menuData) return null;
        
        for (const category in window.menuData) {
            const items = window.menuData[category];
            if (Array.isArray(items)) {
                for (const item of items) {
                    if (item['اسم_غذا_فارسی'] === foodNameFa) {
                        return item;
                    }
                }
            }
        }
        return null;
    }

    // تابع باز کردن مودال با پشتیبانی از هر دو ساختار کارت
    function openModal(foodCard) {
        // تشخیص نوع کارت
        const isSalonCard = foodCard.classList.contains('menu-item-card');
        const isDesktopCard = foodCard.classList.contains('menu-item-desktop');
        const isMobileCard = foodCard.classList.contains('menu-item-mobile');
        
        let foodNameFa = '';
        let foodImage = '';
        let foodPrice = '';
        let foodLatin = '';
        let foodDetails = '';
        
        // استخراج نام غذا (مشترک بین همه نوع کارت‌ها)
        const nameElement = foodCard.querySelector('h3');
        foodNameFa = nameElement ? nameElement.textContent.trim() : '';
        
        if (isSalonCard) {
            // ========== استخراج از کارت سالن ==========
            
            // تصویر
            const imgElement = foodCard.querySelector('img');
            foodImage = imgElement ? imgElement.src : '';
            
            // قیمت - در کارت سالن با کلاس text-sm.font-black
            const priceElement = foodCard.querySelector('.text-sm.font-black');
            if (priceElement) {
                foodPrice = priceElement.textContent.trim();
            }
            
            // نام لاتین - در کارت سالن وجود ندارد
            foodLatin = '';
            
            // جزئیات - پاراگراف با کلاس text-xs.text-gray-400
            const detailsElement = foodCard.querySelector('p.text-xs.text-gray-400');
            if (detailsElement) {
                foodDetails = detailsElement.textContent.trim();
            }
            
        } else if (isDesktopCard || isMobileCard) {
            // ========== استخراج از کارت بیرون‌بر/سازمانی ==========
            
            // تلاش برای پیدا کردن در menuData
            const itemData = findMenuItem(foodNameFa);
            
            if (itemData) {
                // پر کردن مودال با اطلاعات مستقیم از PHP
                foodImage = itemData['main_image'] || '';
                foodPrice = itemData['formatted_price'] || '';
                foodLatin = itemData['اسم_غذا_لاتین'] || '';
                foodDetails = itemData['جزئیات'] || '';
            } else {
                // fallback به استخراج از DOM
                const imgElement = foodCard.querySelector('img');
                foodImage = imgElement ? imgElement.src : '';
                
                // قیمت - در کارت‌های دسکتاپ با کلاس text-base.font-black
                let priceElement = foodCard.querySelector('.text-base.font-black');
                if (!priceElement && isMobileCard) {
                    // در کارت موبایل قیمت با ساختار متفاوت
                    priceElement = foodCard.querySelector('.text-base.font-black');
                }
                if (priceElement) {
                    const priceText = priceElement.textContent.trim();
                    foodPrice = priceText.replace(/[^\d,]/g, '');
                }
                
                // نام لاتین
                const latinElement = foodCard.querySelector('.font-mono');
                foodLatin = latinElement ? latinElement.textContent.trim() : '';
                
                // جزئیات
                let detailsElement = foodCard.querySelector('.line-clamp-2');
                if (!detailsElement && isMobileCard) {
                    detailsElement = foodCard.querySelector('p.text-xs.text-gray-400');
                }
                foodDetails = detailsElement ? detailsElement.textContent.trim() : '';
            }
        }
        
        // ========== به‌روزرسانی محتوای مودال ==========
        modalImage.src = foodImage;
        modalImage.alt = foodNameFa;
        modalName.textContent = foodNameFa;
        modalPrice.textContent = foodPrice;
        modalLatin.textContent = foodLatin;
        modalDetails.textContent = foodDetails;

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
        // کارت‌های بیرون‌بر/سازمانی (دسکتاپ)
        let foodCard = e.target.closest('.menu-item-desktop');
        
        // کارت‌های بیرون‌بر/سازمانی (موبایل)
        if (!foodCard) {
            foodCard = e.target.closest('.menu-item-mobile');
        }
        
        // کارت‌های سالن
        if (!foodCard) {
            foodCard = e.target.closest('.menu-item-card');
        }
        
        if (foodCard) {
            e.preventDefault();
            openModal(foodCard);
        }
    });

    // کلیک روی دکمه بستن
    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeModal();
        });
    }

    // کلیک روی overlay (خارج از مودال)
    if (overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeModal();
            }
        });
    }

    // بستن با کلید Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay && !overlay.classList.contains('hidden')) {
            closeModal();
        }
    });

    // دکمه افزودن به سبد خرید
    const addToCartBtn = document.getElementById('modal-add-to-cart-btn');
    if (addToCartBtn) {
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
    }
});
</script>