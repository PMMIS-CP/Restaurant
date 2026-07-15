// مختص به فایل resources\views\front\pages\reserve.blade.php
window.handleSubmit = function(event) {
    event.preventDefault();
    
    // 1. خواندن فروشگاه Alpine (همان منبع یکتا)
    const store = Alpine.store('reserveForm');
    console.log('📦 Store data:', store);

    // 2. ساخت FormData تمیز
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('name', store.name);
    formData.append('phone', store.phone);
    formData.append('email', store.email);
    formData.append('event_type', store.event_type);
    formData.append('guest_count', store.guest_count);
    formData.append('reservation_date', store.reservation_date);
    formData.append('entry_time', store.entry_time);
    formData.append('exit_time', store.exit_time);
    formData.append('description', store.description);

    // لاگ نهایی
    console.log('📦 Final FormData:');
    for (let [k, v] of formData.entries()) console.log(`  ${k}: ${v}`);

    // 3. ارسال (fetch بدون تغییر، فقط body=formData)
    fetch(event.target.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'موفق',
                text: data.message,
                confirmButtonText: 'متوجه شدم'  // 👈 اینجا تغییر دادیم
            }).then(() => location.reload());
        } else {
            Swal.fire({
                icon: 'error',
                title: 'خطا',
                text: data.message,
                confirmButtonText: 'متوجه شدم'  // 👈 اینجا هم تغییر دادیم
            });
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'خطا',
            text: 'ارتباط با سرور برقرار نشد.',
            confirmButtonText: 'متوجه شدم'  // 👈 و اینجا هم
        });
    });
};

// resources\views\front\components\gallery.blade.php
document.addEventListener('DOMContentLoaded', () => {
    // فقط اگر المان‌های مربوطه در صفحه وجود دارند، اجرا کن
    if (document.querySelector('.star')) {
        window.gsap.to(".star", { 
            y: -30, 
            duration: 2, 
            repeat: -1, 
            yoyo: true, 
            ease: "power1.inOut", 
            stagger: 0.4 
        });
    }
    
    if (document.querySelector('.pulse-circle')) {
        window.gsap.to(".pulse-circle", { 
            scale: 1.5, 
            opacity: 0.3, 
            duration: 2.5, 
            repeat: -1, 
            yoyo: true, 
            ease: "sine.inOut", 
            stagger: 0.5 
        });
    }
    
    if (document.querySelector('.rotate-triangle')) {
        window.gsap.to(".rotate-triangle", { 
            rotation: 360, 
            duration: 10, 
            repeat: -1, 
            ease: "none", 
            transformOrigin: "50% 50%" 
        });
    }

    // Swiper عمومی (نسخه ساده)
    if (document.querySelector('.card-swiper')) {
        new window.Swiper('.card-swiper', {
            modules: [window.SwiperEffectCards, window.SwiperAutoplay],
            effect: "cards",
            grabCursor: true,
            loop: true,
            autoplay: { delay: 3000 }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // انتخاب تمام Swiperهای با کلاس card-swiper
    const swiperElements = document.querySelectorAll('.card-swiper');
    
    // اگر Swiper از قبل راه‌اندازی شده، دوباره راه‌اندازی نکن
    swiperElements.forEach(el => {
        // بررسی می‌کنیم Swiper قبلاً روی این المان راه‌اندازی نشده باشد
        if (!el.classList.contains('swiper-initialized')) {
            new window.Swiper(el, {
                modules: [window.SwiperEffectCards, window.SwiperAutoplay],
                effect: 'cards',
                rtl: true, 
                loop: false,
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                observer: true,
                observeParents: true,
                observeSlideChildren: true, 

                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                cardsEffect: {
                    slideShadows: true,
                    perSlideOffset: 10,
                    perSlideRotate: 3,
                    rotate: true,
                },
            });
        }
    });
});

// resources\views\front\components\commetns.blade.php
document.addEventListener('alpine:init', () => {
    Alpine.data('customSwiper', () => ({
        swiper: null,
        timeout: null,
        
        initSwiper() {
            // بررسی وجود المان Swiper
            if (!this.$refs.swiperContainer) return;
            
            this.swiper = new window.Swiper(this.$refs.swiperContainer, {
                modules: [window.SwiperAutoplay],
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                speed: 3000,
                autoplay: {
                    delay: 0,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false,
                },
                pagination: {
                    el: this.$refs.pagination,
                    clickable: true,
                },
                navigation: {
                    nextEl: this.$refs.nextBtn,
                    prevEl: this.$refs.prevBtn,
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }
            });

            // تابع کمکی برای توقف و زمان‌بندی مجدد
            const handleInteraction = () => {
                if (!this.swiper) return;
                this.swiper.autoplay.stop();
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    if (this.swiper) {
                        this.swiper.autoplay.start();
                    }
                }, 30000);
            };

            // تشخیص اسکرول موس (کمترین حرکت)
            this.$refs.swiperContainer.addEventListener('wheel', (e) => {
                // فقط اگر اسکرول عمودی باشه (نه افقی)
                if (Math.abs(e.deltaY) > Math.abs(e.deltaX)) {
                    handleInteraction();
                }
            }, { passive: true });

            // تشخیص لمس در موبایل (کمترین حرکت انگشت)
            let touchStartY = 0;
            this.$refs.swiperContainer.addEventListener('touchstart', (e) => {
                touchStartY = e.touches[0].clientY;
            });
            
            this.$refs.swiperContainer.addEventListener('touchmove', (e) => {
                const touchY = e.touches[0].clientY;
                // اگر حرکت عمودی اتفاق افتاده (حتی کم)
                if (Math.abs(touchY - touchStartY) > 5) {
                    handleInteraction();
                }
            }, { passive: true });

            // کلیک موس هم بمونه (برای موارد خاص)
            this.$refs.swiperContainer.addEventListener('mousedown', handleInteraction);
        },
        
        // Cleanup هنگام destroy شدن کامپوننت
        destroy() {
            if (this.swiper) {
                this.swiper.destroy(true, true);
                this.swiper = null;
            }
            if (this.timeout) {
                clearTimeout(this.timeout);
            }
        }
    }));
});

// ==========================================
// کدهای صفحه منو (resources\views\front\pages\menu.blade.php)
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    // فقط اگر در صفحه منو هستیم اجرا کن
    const menuGrid = document.getElementById('menu-grid');
    if (!menuGrid) return;

    // المان‌های کنترل صفحات
    const categoryPage = document.getElementById('category-page');
    const menuPage = document.getElementById('menu-page');
    const backToCategoriesBtn = document.getElementById('back-to-categories');
    const categorySelectCards = document.querySelectorAll('[data-category-select]');

    // کنترلرهای فیلتر
    const searchInput = document.getElementById('search-input');
    const priceSlider = document.getElementById('price-slider');
    const priceVal = document.getElementById('price-val');
    const itemsCountBadge = document.getElementById('items-count');
    const emptyState = document.getElementById('empty-state');
    const menuCards = document.querySelectorAll('.menu-item-card');
    const categoryButtons = document.querySelectorAll('.cat-btn');

    let currentCategory = 'all';

    // راه اندازی Swiper دسته‌بندی‌ها
    const categorySwiper = new window.Swiper('.categories-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        freeMode: true,
        slidesOffsetBefore: 0,
        slidesOffsetAfter: 0,
        watchOverflow: true
    });

    function toPersianNumber(num) {
        const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return num.toString().replace(/\d/g, x => persianDigits[x]);
    }

    function formatSliderPrice(price) {
        return new Intl.NumberFormat('fa-IR').format(price) + ' تومان';
    }

    // موتور اصلی فیلتر محصولات منو
    function filterEngine() {
        const query = searchInput.value.toLowerCase().trim();
        const maxPrice = parseInt(priceSlider.value);
        
        priceVal.textContent = formatSliderPrice(maxPrice);

        const showTargets = [];
        const hideTargets = [];

        menuCards.forEach(card => {
            const itemCategory = card.dataset.category;
            const itemPrice = parseInt(card.dataset.price);
            const searchKeys = card.dataset.searchKeys;

            const matchCategory = (currentCategory === 'all' || itemCategory === currentCategory);
            const matchPrice = itemPrice <= maxPrice;
            const matchSearch = !query || searchKeys.includes(query);

            if (matchCategory && matchPrice && matchSearch) {
                showTargets.push(card);
            } else {
                hideTargets.push(card);
            }
        });

        itemsCountBadge.textContent = toPersianNumber(showTargets.length);

        if (showTargets.length === 0) {
            emptyState.classList.remove('hidden');
            menuGrid.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            menuGrid.classList.remove('hidden');
        }

        if (hideTargets.length > 0) {
            window.gsap.to(hideTargets, {
                opacity: 0,
                scale: 0.92,
                y: 15,
                duration: 0.25,
                overwrite: 'auto',
                display: 'none',
                ease: 'power2.in'
            });
        }

        if (showTargets.length > 0) {
            window.gsap.killTweensOf(showTargets);
            window.gsap.set(showTargets, { display: 'flex' });
            window.gsap.fromTo(showTargets, 
                { opacity: 0, scale: 0.95, y: -10 },
                { 
                    opacity: 1, 
                    scale: 1, 
                    y: 0,
                    duration: 0.35, 
                    stagger: 0.03, 
                    overwrite: 'auto',
                    ease: 'power3.out'
                }
            );
        }
    }

    // انیمیشن کارت‌ها موقع فعال شدن صفحه اصلی منو
    function animateCardsOnLoad() {
        const visibleCards = document.querySelectorAll('.menu-item-card[style*="display: flex"]');
        if (visibleCards.length === 0) return;

        window.gsap.fromTo(visibleCards, 
            { opacity: 0, scale: 0.95, y: 30 },
            {
                opacity: 1,
                scale: 1,
                y: 0,
                duration: 0.6,
                stagger: 0.04,
                ease: 'power4.out'
            }
        );
    }

    // عملکرد کلیک روی کارت‌های دسته‌بندی اولیه صفحه اول
    categorySelectCards.forEach(card => {
        card.addEventListener('click', () => {
            const selectedCategory = card.dataset.categorySelect;
            currentCategory = selectedCategory;

            // سوئیچ بصری دکمه‌های اسلایدر ناوبری چسبان بالای صفحه
            categoryButtons.forEach(b => {
                if (b.dataset.categoryTarget === selectedCategory) {
                    b.classList.remove('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                    b.classList.add('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-sm', 'shadow-[#bc1c24]/20');
                    
                    // اسکرول اسلایدر به سمت دکمه فعال شده
                    const btnIndex = Array.from(categoryButtons).indexOf(b);
                    setTimeout(() => { categorySwiper.slideTo(btnIndex); }, 100);
                } else {
                    b.classList.remove('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-[#bc1c24]/20');
                    b.classList.add('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                }
            });

            // پنهان کردن صفحه دسته‌بندی و بالا آوردن صفحه منو
            categoryPage.classList.add('hidden');
            menuPage.classList.remove('hidden');

            // بروزرسانی محاسبات Swiper به دلیل تغییر وضعیت نمایش
            categorySwiper.update();

            // اجرای فیلتر و اعمال انیمیشن ورود
            filterEngine();
            setTimeout(() => { animateCardsOnLoad(); }, 50);
        });
    });

    // بازگشت به صفحه دسته‌بندی‌ها
    if (backToCategoriesBtn) {
        backToCategoriesBtn.addEventListener('click', () => {
            menuPage.classList.add('hidden');
            categoryPage.classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // رویدادهای فیلتر قیمت و جستجو
    if (priceSlider) priceSlider.addEventListener('input', filterEngine);
    if (searchInput) searchInput.addEventListener('input', filterEngine);

    // رویداد تغییر دسته‌بندی از داخل اسلایدر چسبان بالای صفحه (Nav)
    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            categoryButtons.forEach(b => {
                b.classList.remove('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-[#bc1c24]/20');
                b.classList.add('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
            });

            btn.classList.remove('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
            btn.classList.add('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white', 'shadow-sm', 'shadow-[#bc1c24]/20');

            currentCategory = btn.dataset.categoryTarget;
            filterEngine();
        });
    });
});

// ==========================================
// اسکرول ناوبری چسبان (sticky nav)
// ==========================================
window.addEventListener('scroll', () => {
    const nav = document.getElementById('sticky-nav');
    if (nav) {
        if (window.scrollY > 50) {
            nav.classList.add('is-scrolled');
        } else {
            nav.classList.remove('is-scrolled');
        }
    }
});

// ==========================================
// کدهای صفحه سازمانی (resources\views\front\pages\organizational.blade.php)
// ==========================================
document.addEventListener('DOMContentLoaded', () => {
    // فقط اگر در صفحه سازمانی هستیم اجرا کن
    const menuContainer = document.getElementById('menu-container');
    if (!menuContainer) return;

    // ==========================================
    // بخش اول: اسلایدر دسته‌بندی و ناوبری
    // ==========================================
    const categorySwiper = new window.Swiper('.categories-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        freeMode: true,
        watchOverflow: true
    });

    const categoryButtons = document.querySelectorAll('.cat-btn');
    const categorySections = document.querySelectorAll('.category-section');

    let isAutoScrolling = false;
    let autoScrollTimeout = null;

    function activateCategoryButton(targetCategory) {
        categoryButtons.forEach(btn => {
            btn.classList.remove('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white');
            btn.classList.add('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
            
            if (btn.dataset.categoryTarget === targetCategory) {
                btn.classList.add('active', 'bg-[#bc1c24]', 'border-[#bc1c24]', 'text-white');
                btn.classList.remove('bg-[#140e10]', 'border-[#dfb15b]/10', 'text-gray-400');
                categorySwiper.slideTo(Array.from(categoryButtons).indexOf(btn), 300);
            }
        });
    }

    categoryButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetCategory = btn.dataset.categoryTarget;
            isAutoScrolling = true;
            
            if (autoScrollTimeout) {
                clearTimeout(autoScrollTimeout);
            }
            
            activateCategoryButton(targetCategory);
            
            const targetSection = document.querySelector(`.category-section[data-category="${targetCategory}"]`);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            
            autoScrollTimeout = setTimeout(() => {
                isAutoScrolling = false;
                autoScrollTimeout = null;
            }, 1000);
        });
    });

    // Intersection Observer برای تشخیص بخش فعال
    const observerOptions = {
        root: null,
        rootMargin: '-30% 0px -60% 0px',
        threshold: 0
    };

    const observerCallback = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !isAutoScrolling) {
                const category = entry.target.dataset.category;
                if (category) {
                    activateCategoryButton(category);
                }
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    categorySections.forEach(section => observer.observe(section));

    // ==========================================
    // بخش دوم: فیلتر و جستجوی منو
    // ==========================================
    const searchInput = document.getElementById('search-input');
    const priceSlider = document.getElementById('price-slider');
    const priceVal = document.getElementById('price-val');
    const itemsCountBadge = document.getElementById('items-count');
    const emptyState = document.getElementById('empty-state');

    function toPersianNumber(num) {
        const persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return num.toString().replace(/\d/g, x => persianDigits[x]);
    }

    function formatSliderPrice(price) {
        return new Intl.NumberFormat('fa-IR').format(price) + ' تومان';
    }

    function filterEngine() {
        const query = searchInput.value.toLowerCase().trim();
        const maxPrice = parseInt(priceSlider.value);
        
        priceVal.textContent = formatSliderPrice(maxPrice);
        let totalVisibleItems = 0;

        categorySections.forEach(section => {
            const mobileItems = section.querySelectorAll('.menu-item-mobile');
            const desktopItems = section.querySelectorAll('.menu-item-desktop');
            let sectionHasVisibleItem = false;

            const processItems = (items) => {
                items.forEach(item => {
                    const itemPrice = parseInt(item.dataset.price);
                    const searchKeys = item.dataset.searchKeys;

                    const matchPrice = itemPrice <= maxPrice;
                    const matchSearch = !query || searchKeys.includes(query);

                    if (matchPrice && matchSearch) {
                        item.style.display = '';
                        sectionHasVisibleItem = true;
                        totalVisibleItems++;
                    } else {
                        item.style.display = 'none';
                    }
                });
            };

            processItems(mobileItems);
            processItems(desktopItems);

            if (sectionHasVisibleItem) {
                section.style.display = 'block';
                section.style.opacity = '1';
            } else {
                section.style.display = 'none';
                section.style.opacity = '0';
            }
        });

        const actualVisibleCount = totalVisibleItems / 2;
        itemsCountBadge.textContent = toPersianNumber(actualVisibleCount);

        if (actualVisibleCount === 0) {
            emptyState.classList.remove('hidden');
            menuContainer.classList.add('hidden');
        } else {
            emptyState.classList.add('hidden');
            menuContainer.classList.remove('hidden');
        }
    }

    if (priceSlider) priceSlider.addEventListener('input', filterEngine);
    if (searchInput) searchInput.addEventListener('input', filterEngine);

    // انیمیشن اولیه بخش‌ها
    if (typeof window.gsap !== 'undefined') {
        window.gsap.from('.category-section', {
            opacity: 0,
            y: 40,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out'
        });
    }
});

// ==========================================
// resources\views\front\pages\reserve.blade.php
// ==========================================

// --- 1. تعریف Alpine Store اصلی فرم رزرو (باید قبل از کامپوننت‌های وابسته باشد) ---
document.addEventListener('alpine:init', () => {
    window.Alpine.store('reserveForm', {
        name: '',
        phone: '',
        email: '',
        event_type: '',
        guest_count: '',
        reservation_date: '',
        entry_time: '',
        exit_time: '',
        description: ''
    });
});

// --- 2. کامپوننت‌های انیمیشن تایید، فرم و textarea ---
document.addEventListener('alpine:init', () => {
    window.Alpine.data('confirmationComponent', () => ({
        confirmedDate: '',
        confirmedEntryTime: '',
        confirmedExitTime: '',
        isAnimating: false,

        init() {
            // همگام‌سازی با input‌های اصلی
            this.$watch('confirmedDate', val => {
                window.Alpine.store('reserveForm').reservation_date = val;
                const input = document.getElementById('reservation_date_input');
                if (input) input.value = val;
            });
            this.$watch('confirmedEntryTime', val => {
                window.Alpine.store('reserveForm').entry_time = val;
                const input = document.getElementById('entry_time_input');
                if (input) input.value = val;
            });
            this.$watch('confirmedExitTime', val => {
                window.Alpine.store('reserveForm').exit_time = val;
                const input = document.getElementById('exit_time_input');
                if (input) input.value = val;
            });
        },
        
        triggerAnimation(el) {
            if (this.isAnimating) return;
            this.isAnimating = true;

            const runGsap = (selector, context = document) => {
                // پیدا کردن تمام المان‌های مشابه و بررسی اینکه کدامشان در صفحه (دسکتاپ یا موبایل) Visible است
                const targets = context.querySelectorAll(selector);
                targets.forEach(target => {
                    // offsetParent === null به این معنی است که المان مخفی (display: none) است
                    if(target.offsetParent !== null || window.getComputedStyle(target).display !== 'none') {
                        window.gsap.set(target, { opacity: 1 });
                        window.gsap.fromTo(target, 
                            { strokeDashoffset: 729.22 }, 
                            { strokeDashoffset: -1458.44, duration: 6, ease: 'none', onComplete: () => { window.gsap.set(target, { opacity: 0 }); } }
                        );
                    }
                });
            };

            // ۱. فیلد فعلی
            runGsap('.light-rect', el.parentElement);

            // ۲. پیدا کردن المان‌های قابل مشاهده تقویم و ساعت
            runGsap('.light-rect-calendar', document);
            runGsap('.light-rect-time', document);

            setTimeout(() => { this.isAnimating = false; }, 6000);
        },

        get displayText() {
            if (this.confirmedDate && this.confirmedEntryTime && this.confirmedExitTime) return `${this.confirmedDate} - ${this.confirmedEntryTime} الی ${this.confirmedExitTime}`;
            if (this.confirmedDate && this.confirmedEntryTime) return `${this.confirmedDate} - ${this.confirmedEntryTime} الی ---`;
            if (this.confirmedDate && this.confirmedExitTime) return `${this.confirmedDate} - --- الی ${this.confirmedExitTime}`;
            if (this.confirmedDate) return `${this.confirmedDate} - ورودی و خروجی ساعت را ثبت کنید`;
            if (this.confirmedEntryTime || this.confirmedExitTime) return `تاریخ را ثبت کنید - ${this.confirmedEntryTime || '---'} الی ${this.confirmedExitTime || '---'}`;
            return 'تاریخ را ثبت کنید';
        }
    }));

    window.Alpine.data('formAnimation', () => ({
        isAnimating: false,
        triggerAnimation(el) {
            if (this.isAnimating) return;
            this.isAnimating = true;
            const target = el.querySelector('.light-rect-input');
            if (target) {
                window.gsap.set(target, { strokeDasharray: 729.22 });
                window.gsap.fromTo(target, 
                    { strokeDashoffset: 729.22 }, 
                    { strokeDashoffset: -1458.44, duration: 6, ease: 'none', onComplete: () => { window.gsap.set(target, { clearProps: "strokeDashoffset, strokeDasharray" }); } }
                );
            }
            setTimeout(() => { this.isAnimating = false; }, 6000);
        }
    }));

    window.Alpine.data('textareaAnimation', () => ({
        isAnimating: false,
        triggerAnimation(el) {
            if (this.isAnimating) return;
            this.isAnimating = true;
            const target = el.querySelector('.light-rect-textarea');
            if (!target) { this.isAnimating = false; return; }

            const perimeter = 2511.46;
            window.gsap.set(target, { strokeDasharray: perimeter });
            window.gsap.fromTo(target, 
                { strokeDashoffset: perimeter }, 
                { strokeDashoffset: -perimeter, duration: 6, ease: 'none', onComplete: () => { window.gsap.set(target, { clearProps: "strokeDashoffset, strokeDasharray" }); } }
            );
            setTimeout(() => { this.isAnimating = false; }, 6000);
        }
    }));
});

// --- 3. کامپوننت DatePicker (تقویم شمسی) ---
document.addEventListener('alpine:init', () => {
    window.Alpine.data('datePicker', () => ({
        showCalendar: false,
        selectedDate: '',
        finalDate: '',
        year: new window.persianDate().year(),
        month: new window.persianDate().month(),
        blockedDates: ['1406/4/4', '1406/4/5'],
        
        get viewDate() { return new window.persianDate([this.year, this.month, 1]); },
        get currentYear() { return this.viewDate.year(); },
        get currentMonthName() { return this.viewDate.format('MMMM'); },
        get daysInMonth() { return this.viewDate.daysInMonth(); },
        get startDayOffset() { return this.viewDate.day(); },

        changeMonth(amount) {
            let newDate = this.viewDate.add('months', amount);
            this.year = newDate.year();
            this.month = newDate.month();
        },
        selectDate(day) {
            if (this.isBlocked(day)) return;
            this.selectedDate = `${this.year}/${this.month}/${day}`;
        },
        confirmDate() {
            if (!this.selectedDate) return;
            this.finalDate = this.selectedDate;
            this.$dispatch('date-confirmed', { date: this.finalDate });
            this.showCalendar = false;
        },
        isSelected(day) { return this.selectedDate === `${this.year}/${this.month}/${day}`; },
        isBlocked(day) { return this.blockedDates.includes(`${this.year}/${this.month}/${day}`); }
    }));
});

// --- 4. Dropdown سفارشی (نوع رویداد و تعداد مهمان) ---
document.addEventListener('alpine:init', () => {
    document.querySelectorAll('.custom-dropdown-container').forEach(container => {
        const trigger = container.querySelector('.dropdown-trigger');
        const menu = container.querySelector('.dropdown-menu');
        const arrow = trigger.querySelector('svg');
        const selectedText = container.querySelector('.selected-text');
        const items = container.querySelectorAll('li');

        if (!trigger || !menu || !arrow || !selectedText) {
            console.warn('Dropdown container incomplete:', container);
            return;
        }

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            
            // بستن سایر dropdownها
            document.querySelectorAll('.dropdown-menu').forEach(m => {
                if (m !== menu) m.classList.add('hidden');
            });
            document.querySelectorAll('.dropdown-trigger svg').forEach(svg => {
                if (svg !== arrow) svg.classList.remove('rotate-180');
            });
            
            // toggle dropdown جاری
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        });

        items.forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();
                
                const value = item.getAttribute('data-value');
                const containerType = container.getAttribute('data-type'); // 'guest' یا 'event'
                const fieldName = containerType === 'guest' ? 'guest_count' : 'event_type';
                
                // به‌روزرسانی input اصلی
                const mainInput = document.getElementById(fieldName + '_input');
                if (mainInput) mainInput.value = value;
                
                // به‌روزرسانی Alpine Store
                try {
                    const store = window.Alpine.store('reserveForm');
                    if (store) store[fieldName] = value;
                } catch (error) {
                    console.warn('Store not accessible:', error);
                }
                
                // به‌روزرسانی UI
                selectedText.textContent = item.textContent;
                trigger.classList.remove('text-gray-400', 'text-gray-500');
                trigger.classList.add('text-gray-800', 'font-bold');
                menu.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            });
        });
    });

    // بستن همه dropdownها با کلیک خارج
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.custom-dropdown-container')) {
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.add('hidden'));
            document.querySelectorAll('.dropdown-trigger svg').forEach(svg => svg.classList.remove('rotate-180'));
        }
    });
});

// --- 5. TimePicker Inline (انتخاب ساعت ورود/خروج) ---
window.timePickerInline = function() {
    const ITEM_HEIGHT = 40; // ارتفاع هر آیتم به پیکسل
    
    return {
        mode: 'split', 
        entryTime: null, 
        exitTime: null, 
        hourIndex: 8, 
        minuteIndex: 0,
        editingType: null, 
        editingOriginalTime: null,
        dragging: { active: false, type: null, startY: 0, startScroll: 0 },
        scrollTimeout: { hour: null, minute: null },

        _boundPointerMove: null,
        _boundPointerUp: null,
        lastScrollTime: 0,

        init() {
            this._boundPointerMove = this.onPointerMove.bind(this);
            this._boundPointerUp = this.stopDrag.bind(this);

            window.addEventListener('pointermove', this._boundPointerMove);
            window.addEventListener('pointerup', this._boundPointerUp);
            window.addEventListener('pointercancel', this._boundPointerUp);
            
            console.log("Picker Initialized"); 
        },

        openPicker(type) {
            this.editingType = type;
            this.editingOriginalTime = type === 'entry' ? this.entryTime : this.exitTime;
            const currentTime = this.editingOriginalTime;

            if (currentTime && currentTime.includes(':')) {
                const [h, m] = currentTime.split(':').map(Number);
                this.hourIndex = isNaN(h) ? 0 : Math.min(23, Math.max(0, h));
                this.minuteIndex = isNaN(m) ? 0 : Math.min(59, Math.max(0, m));
            } else {
                const now = new Date();
                this.hourIndex = now.getHours();
                this.minuteIndex = now.getMinutes();
            }

            this.mode = type === 'entry' ? 'entry-edit' : 'exit-edit';
            
            this.$nextTick(() => {
                this.scrollToIndex('hour', false);
                this.scrollToIndex('minute', false);
            });
        },

        scrollToIndex(type, smooth = true) {
            const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
            const index = type === 'hour' ? this.hourIndex : this.minuteIndex;
            
            if (scrollRef) {
                scrollRef.scrollTo({
                    top: index * ITEM_HEIGHT,
                    behavior: smooth ? 'smooth' : 'auto'
                });
            }
        },

        onScroll(type) {
            const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
            if (!scrollRef || this.dragging.active) return;

            clearTimeout(this.scrollTimeout[type]);
            
            const rawIndex = Math.round(scrollRef.scrollTop / ITEM_HEIGHT);
            if (type === 'hour') {
                this.hourIndex = Math.min(23, Math.max(0, rawIndex));
            } else {
                this.minuteIndex = Math.min(59, Math.max(0, rawIndex));
            }

            this.scrollTimeout[type] = setTimeout(() => {
                this.scrollToIndex(type, true);
            }, 150);
        },

        startDrag(event, type) {
            if (event.pointerType === 'mouse' && event.button !== 0) return;
            
            const scrollRef = type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
            if (!scrollRef) return;

            event.preventDefault();
            this.dragging.active = true;
            this.dragging.type = type;
            this.dragging.startY = event.clientY;
            this.dragging.startScroll = scrollRef.scrollTop;
        },

        onPointerMove(event) {
            if (!this.dragging.active) return;
            
            const deltaY = event.clientY - this.dragging.startY;
            let newScrollTop = this.dragging.startScroll - deltaY;
            
            const maxScroll = (this.dragging.type === 'hour' ? 23 : 59) * ITEM_HEIGHT;
            newScrollTop = Math.max(0, Math.min(maxScroll, newScrollTop));
            
            const scrollRef = this.dragging.type === 'hour' ? this.$refs.hourScroll : this.$refs.minuteScroll;
            if (scrollRef) {
                scrollRef.scrollTop = newScrollTop;
                
                const rawIndex = Math.round(newScrollTop / ITEM_HEIGHT);
                if (this.dragging.type === 'hour') {
                    this.hourIndex = Math.min(23, Math.max(0, rawIndex));
                } else {
                    this.minuteIndex = Math.min(59, Math.max(0, rawIndex));
                }
            }
        },

        stopDrag() {
            if (!this.dragging.active) return;
            const type = this.dragging.type;
            this.dragging.active = false;
            this.dragging.type = null;
            
            this.$nextTick(() => {
                this.scrollToIndex(type, true);
            });
        },

        onWheel(event, type) {
            event.preventDefault();
            
            const THROTTLE_TIME = 200; 
            const now = Date.now();
            
            if (now - this.lastScrollTime < THROTTLE_TIME) return;
            
            this.lastScrollTime = now;
            const direction = Math.sign(event.deltaY); 
            
            if (type === 'hour') {
                this.hourIndex = (this.hourIndex + direction + 24) % 24;
            } else {
                this.minuteIndex = (this.minuteIndex + direction + 60) % 60;
            }
            this.scrollToIndex(type, true);
        },

        clickItem(index, type) {
            if (type === 'hour') this.hourIndex = index; else this.minuteIndex = index;
            this.scrollToIndex(type, true);
        },

        onKeydown(event, type) {
            const keys = ['ArrowUp', 'ArrowDown', 'Enter', 'Escape'];
            if (!keys.includes(event.key)) return;
            event.preventDefault();

            if (event.key === 'ArrowUp') {
                if (type === 'hour') this.hourIndex = (this.hourIndex - 1 + 24) % 24;
                else this.minuteIndex = (this.minuteIndex - 1 + 60) % 60;
                this.scrollToIndex(type, true);
            } else if (event.key === 'ArrowDown') {
                if (type === 'hour') this.hourIndex = (this.hourIndex + 1) % 24;
                else this.minuteIndex = (this.minuteIndex + 1) % 60; 
                this.scrollToIndex(type, true);
            } else if (event.key === 'Enter') { 
                this.confirmTime(); 
            } else if (event.key === 'Escape') { 
                this.cancelEdit(); 
            }
        },

        cancelEdit() {
            const rollbackTime = this.editingOriginalTime || '';
            if (this.editingType === 'entry') {
                this.entryTime = rollbackTime;
                this.$dispatch('entry-time-confirmed', { time: rollbackTime });
            } else {
                this.exitTime = rollbackTime;
                this.$dispatch('exit-time-confirmed', { time: rollbackTime });
            }
            this.mode = 'split';
        },

        confirmTime() {
            const formattedHour = String(this.hourIndex).padStart(2, '0');
            const formattedMinute = String(this.minuteIndex).padStart(2, '0');
            const timeStr = `${formattedHour}:${formattedMinute}`;

            if (this.editingType === 'entry' || this.mode === 'entry-edit') {
                this.entryTime = timeStr;
                this.$dispatch('entry-time-confirmed', { time: timeStr });
            } else {
                this.exitTime = timeStr;
                this.$dispatch('exit-time-confirmed', { time: timeStr });
            }
            this.mode = 'split';
        },

        destroy() {
            window.removeEventListener('pointermove', this._boundPointerMove);
            window.removeEventListener('pointerup', this._boundPointerUp);
            window.removeEventListener('pointercancel', this._boundPointerUp);
            clearTimeout(this.scrollTimeout.hour);
            clearTimeout(this.scrollTimeout.minute);
        }
    }
};

// --- 6. Ripple Effect برای دکمه‌ها ---
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ripple-effect').forEach(button => {
        button.addEventListener('click', function(e) {
            // حذف rippleهای قبلی
            const existingRipple = this.querySelector('.ripple');
            if (existingRipple) {
                existingRipple.remove();
            }
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            const rect = this.getBoundingClientRect();
            const size = Math.sqrt(rect.width ** 2 + rect.height ** 2);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 110);
        });
    });
});

// ==========================================
// کامپوننت گردونه شانس (Spin Wheel)
// ==========================================
document.addEventListener('alpine:init', () => {
    // توجه: prizes و total باید از طریق data attributes یا متغیر گلوبال به کامپوننت منتقل شوند
    window.Alpine.data('spinWheel', (prizesData = [], totalCount = 0) => ({
        spinning: false,
        currentRotation: 0,
        activeSegmentIndex: 0,
        prizes: prizesData,
        total: totalCount,
        sliceAngle: totalCount > 0 ? 360 / totalCount : 0,

        init() {
            // محاسبه sliceAngle اگر total تغییر کند
            if (this.total > 0) {
                this.sliceAngle = 360 / this.total;
            }
            // اعمال استایل فعال در لحظه لود صفحه
            this.$nextTick(() => {
                this.updateActiveSegment();
            });
        },

        // تابع محاسبه قطعه‌ای که هم‌اکنون در زاویه صفر (بالا/فلش) قرار دارد
        updateActiveSegment() {
            // گرفتن چرخش فعلی، چه در حال انیمیشن باشد و چه ثابت
            let rotation = this.spinning 
                ? window.gsap.getProperty(this.$refs.wheel, "rotation") 
                : this.currentRotation;
            
            if (rotation === undefined) rotation = 0;

            // تبدیل چرخش‌های منفی و اعداد بزرگ به بازه استاندارد 0 تا 360
            let normalizedRotation = rotation % 360;
            if (normalizedRotation < 0) normalizedRotation += 360;
            
            // محاسبه زاویه معادل روی گردونه ثابت (چرخش برعکس عقربه‌ها)
            let pointingAngle = (360 - normalizedRotation) % 360;
            
            // به دست آوردن ایندکس
            if (this.sliceAngle > 0) {
                this.activeSegmentIndex = Math.floor(pointingAngle / this.sliceAngle);
            }
        },

        spin() {
            if (this.spinning) return;
            this.spinning = true;

            // نرمالایز کردن موقعیت فعلی قبل از شروع
            this.currentRotation = ((this.currentRotation % 360) + 360) % 360;
            window.gsap.set(this.$refs.wheel, { rotation: this.currentRotation });

            // انتخاب تصادفی گزینه برنده
            const winnerIndex = Math.floor(Math.random() * this.prizes.length);
            const winner = this.prizes[winnerIndex];
            
            // محاسبه زاویه وسط گزینه برنده
            const sliceMiddleAngle = (winnerIndex * this.sliceAngle) + (this.sliceAngle / 2);
            
            // محاسبه فاصله تا گزینه برنده
            let distance = (360 - sliceMiddleAngle - this.currentRotation + 360) % 360;
            if (distance < 0) distance += 360;
            
            // اضافه کردن تعداد دور کامل
            const fullSpins = (5 + Math.floor(Math.random() * 4)) * 360;
            const targetRotation = this.currentRotation + distance + fullSpins;

            const tl = window.gsap.timeline({
                // در هر فریم انیمیشن، استایل قطعه فعال آپدیت می‌شود
                onUpdate: () => {
                    this.updateActiveSegment();
                },
                onComplete: () => {
                    // ذخیره موقعیت نهایی نرمالایز شده
                    this.currentRotation = ((targetRotation % 360) + 360) % 360;
                    window.gsap.set(this.$refs.wheel, { rotation: this.currentRotation });
                    
                    this.spinning = false;
                    this.updateActiveSegment(); // همگام‌سازی نهایی
                    
                    setTimeout(() => {
                        alert('🎉 تبریک! شما برنده شدید: ' + winner.name);
                    }, 100);
                }
            });

            // 1. حرکت نرم به عقب
            tl.to(this.$refs.wheel, {
                rotation: this.currentRotation - 40,
                duration: 0.6,
                ease: "power1.inOut"
            })
            // 2. چرخش اصلی
            .to(this.$refs.wheel, {
                rotation: targetRotation + 12,
                duration: 30,
                ease: "cubic-bezier(0.25, 0.1, 0.6, 1.0)"
            })
            // 3. برگشت نرم به نقطه نهایی
            .to(this.$refs.wheel, {
                rotation: targetRotation,
                duration: 0.6,
                ease: "back.out(1.5)"
            });
        }
    }));
});

