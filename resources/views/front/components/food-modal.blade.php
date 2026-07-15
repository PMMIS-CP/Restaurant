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
                    <span class="text-[10px] font-normal text-gray-400 mr-1">تومان</span>
                </div>
            </div>

            {{-- خط جداکننده --}}
            <div class="border-t border-[#ffd700]/10"></div>

            {{-- توضیحات --}}
            <p id="modal-food-details" class="text-sm text-gray-300 leading-relaxed text-justify">---</p>

            {{-- دکمه افزودن به سبد خرید --}}
            <button id="modal-add-to-cart-btn" class="w-full py-3 mt-4 bg-linear-to-r from-[#ffd700]/20 to-[#ffd700]/10 border border-[#ffd700]/40 rounded-xl text-[#ffd700] font-bold text-lg hover:from-[#ffd700]/30 hover:to-[#ffd700]/20 hover:shadow-[0_0_20px_rgba(255,215,0,0.2)] transition-all duration-300">
                افزودن به سبد خرید
                <span class="text-sm font-normal text-gray-400 mr-2">+</span>
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById('food-modal-overlay');
        const modalContent = document.getElementById('food-modal-content');
        const closeBtn = document.getElementById('modal-close-btn');
        const galleryContainer = document.getElementById('modal-food-gallery');
        const loadingSpinner = document.getElementById('modal-gallery-loading');
        const prevBtn = document.getElementById('modal-prev-image');
        const nextBtn = document.getElementById('modal-next-image');
        const dotsContainer = document.getElementById('modal-image-dots');
        
        const modalName = document.getElementById('modal-food-name');
        const modalPrice = document.getElementById('modal-food-price');
        const modalDetails = document.getElementById('modal-food-details');
        const addToCartBtn = document.getElementById('modal-add-to-cart-btn');

        // وضعیت گالری
        let modalImages = [];
        let modalCurrentIndex = 0;

        // ذخیره اطلاعات محصول جاری برای ارسال به API سبد خرید
        let currentProduct = {
            type: null,
            id: null,
            name: '',
            price: ''
        };

        /**
         * بروزرسانی اسلاید گالری
         */
        function updateGallerySlide() {
            const slides = galleryContainer.querySelectorAll('img');
            slides.forEach((img, idx) => {
                img.style.opacity = idx === modalCurrentIndex ? '1' : '0';
            });

            const dots = dotsContainer.querySelectorAll('span');
            dots.forEach((dot, idx) => {
                dot.classList.toggle('bg-[#ffd700]', idx === modalCurrentIndex);
                dot.classList.toggle('bg-white/40', idx !== modalCurrentIndex);
            });
        }

        /**
         * ساخت گالری از آرایه تصاویر
         */
        function buildGallery(images) {
            // پاکسازی قبلی
            galleryContainer.querySelectorAll('img').forEach(img => img.remove());
            dotsContainer.innerHTML = '';
            
            modalImages = images.length ? images : [];
            modalCurrentIndex = 0;

            if (modalImages.length === 0) {
                // نمایش placeholder اگر تصویری نبود
                const placeholder = document.createElement('div');
                placeholder.className = 'absolute inset-0 flex items-center justify-center text-gray-500 text-sm';
                placeholder.textContent = 'بدون تصویر';
                galleryContainer.appendChild(placeholder);
                prevBtn.classList.add('hidden');
                nextBtn.classList.add('hidden');
                return;
            }

            // ایجاد تصاویر
            modalImages.forEach((src, idx) => {
                const img = document.createElement('img');
                img.src = src;
                img.alt = '';
                img.className = 'absolute inset-0 w-full h-full object-cover transition-opacity duration-300';
                img.style.opacity = idx === 0 ? '1' : '0';
                galleryContainer.appendChild(img);
            });

            // ایجاد نقاط (اگر بیشتر از یک تصویر)
            if (modalImages.length > 1) {
                modalImages.forEach((_, idx) => {
                    const dot = document.createElement('span');
                    dot.className = 'w-2 h-2 rounded-full transition-colors duration-200 cursor-pointer';
                    dot.classList.add(idx === 0 ? 'bg-[#ffd700]' : 'bg-white/40');
                    dot.addEventListener('click', () => {
                        modalCurrentIndex = idx;
                        updateGallerySlide();
                    });
                    dotsContainer.appendChild(dot);
                });
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
            } else {
                prevBtn.classList.add('hidden');
                nextBtn.classList.add('hidden');
            }
        }

        /**
         * باز کردن مودال با fetch از API
         */
        async function openModal(type, id) {
            // نمایش مودال اول با حالت loading
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            document.body.classList.add('overflow-hidden');
            
            modalName.textContent = 'در حال بارگذاری...';
            modalPrice.textContent = '---';
            modalDetails.textContent = '---';
            loadingSpinner?.classList.remove('hidden');

            // غیرفعال کردن دکمه افزودن به سبد خرید تا زمان بارگذاری
            addToCartBtn.disabled = true;

            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 50);

            try {
                const response = await fetch(`/api/food-modal?type=${type}&id=${id}`, {
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error('خطا در دریافت اطلاعات');
                }

                const data = await response.json();

                // پر کردن اطلاعات
                modalName.textContent = data.name;
                modalPrice.textContent = Number(data.price).toLocaleString();
                modalDetails.textContent = data.description || 'بدون توضیحات';

                // ذخیره برای سبد خرید
                currentProduct = {
                    type: data.type,
                    id: data.id,
                    name: data.name,
                    price: data.price
                };

                // ساخت گالری
                loadingSpinner?.classList.add('hidden');
                buildGallery(data.images);

                // فعال کردن دکمه سبد خرید
                addToCartBtn.disabled = false;

            } catch (error) {
                console.error('FoodModal Error:', error);
                modalName.textContent = 'خطا در بارگذاری';
                modalPrice.textContent = '---';
                modalDetails.textContent = 'لطفاً دوباره تلاش کنید.';
                loadingSpinner?.classList.add('hidden');
                buildGallery([]);
            }
        }

        /**
         * بستن مودال
         */
        function closeModal() {
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                // ریست گالری
                buildGallery([]);
                loadingSpinner?.classList.remove('hidden');
                currentProduct = { type: null, id: null, name: '', price: '' };
                addToCartBtn.disabled = false;
            }, 200);
        }

        /**
         * Event delegation: گوش دادن به کلیک روی کارت‌های منو
         */
        document.addEventListener('click', function (e) {
            const card = e.target.closest('[data-modal-type][data-modal-id]');
            if (!card) return;

            e.preventDefault();
            e.stopPropagation();

            const type = card.getAttribute('data-modal-type');
            const id = card.getAttribute('data-modal-id');

            if (type && id) {
                openModal(type, id);
            }
        });

        // بستن مودال
        closeBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            closeModal();
        });

        overlay?.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !overlay.classList.contains('hidden')) closeModal();
        });

        // دکمه‌های گالری
        prevBtn?.addEventListener('click', () => {
            if (modalImages.length < 2) return;
            modalCurrentIndex = (modalCurrentIndex - 1 + modalImages.length) % modalImages.length;
            updateGallerySlide();
        });

        nextBtn?.addEventListener('click', () => {
            if (modalImages.length < 2) return;
            modalCurrentIndex = (modalCurrentIndex + 1) % modalImages.length;
            updateGallerySlide();
        });

        // ========== افزودن به سبد خرید ==========
        addToCartBtn?.addEventListener('click', async function () {
            if (!currentProduct.id || !currentProduct.type) {
                alert('اطلاعات محصول ناقص است.');
                return;
            }

            // مپ کردن type به product_type مناسب برای API سبد خرید
            const productTypeMap = {
                'menu': 'App\\Models\\Menu',
                'organizational': 'App\\Models\\MenuOrganizational',
                'takeout': 'App\\Models\\MenuTakeout',
            };

            const productType = productTypeMap[currentProduct.type] || currentProduct.type;

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
                        product_type: productType,
                        product_id: currentProduct.id,
                        quantity: 1
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json().catch(() => null);
                    throw new Error(errorData?.message || 'خطا در افزودن به سبد خرید');
                }

                const data = await response.json();

                addToCartBtn.innerHTML = '<span class="inline-flex items-center gap-1">✓ به سبد اضافه شد</span>';
                addToCartBtn.classList.add('bg-green-500/20', 'border-green-500/40', 'text-green-400');

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