import Alpine from 'alpinejs';
import axios from 'axios';
import Splide from '@splidejs/splide';
import 'lazysizes';
import IMask from 'imask';
import dayjs from 'dayjs';
import '@splidejs/splide/css'; 

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.css';
import 'flatpickr/dist/l10n/fa.js';

import Swiper from 'swiper';
import { EffectCards, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-cards';
import { ScrollTrigger } from "gsap/ScrollTrigger";

import { gsap } from "gsap";
import { Flip } from "gsap/Flip";
import persianDate from 'persian-date';

import { Image } from 'cross-image';

import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';
import Swal from 'sweetalert2';
window.Swal = Swal;

// بعد از همه importها و قبل از Alpine.start()
window.handleSubmit = function(event) {
    console.log('🟢 handleSubmit called', { event, target: event.target });
    
    event.preventDefault();
    event.stopPropagation();
    
    const form = event.target;
    console.log('📝 Form element:', form);
    console.log('📝 Form action:', form.action);
    console.log('📝 Form method:', form.method);
    
    const formData = new FormData(form);
    console.log('📦 FormData entries:');
    for (let [key, value] of formData.entries()) {
        console.log(`  ${key}: ${value instanceof File ? value.name : value}`);
    }
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content 
                      || document.querySelector('input[name="_token"]')?.value;
    console.log('🔑 CSRF Token:', csrfToken ? `${csrfToken.substring(0, 10)}...` : 'NOT FOUND');
    
    // دیباگ: بررسی اینکه CSRF token وجود دارد
    if (!csrfToken) {
        console.error('❌ CSRF Token not found! Please check your HTML for meta[name="csrf-token"] or input[name="_token"]');
        Swal.fire('خطا!', 'توکن CSRF یافت نشد.', 'error');
        return;
    }
    
    // دیباگ: لاگ کردن کل request قبل از ارسال
    console.log('🚀 Sending request...', {
        url: form.action,
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken.substring(0, 10) + '...'
        }
    });
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        console.log('📨 Response status:', response.status);
        console.log('📨 Response headers:', [...response.headers.entries()]);
        
        // دیباگ: بررسی اینکه آیا response معتبر است
        if (!response.ok) {
            console.error('❌ Response not OK:', response.status, response.statusText);
            return response.text().then(text => {
                console.error('❌ Response body:', text);
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            });
        }
        
        // دیباگ: بررسی content-type
        const contentType = response.headers.get('content-type');
        console.log('📋 Content-Type:', contentType);
        
        if (!contentType || !contentType.includes('application/json')) {
            console.warn('⚠️ Response is not JSON, content-type:', contentType);
            return response.text().then(text => {
                console.log('📄 Raw response:', text);
                // تلاش برای پارس کردن به عنوان JSON حتی اگر content-type اشتباه باشد
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('❌ Failed to parse response as JSON:', e);
                    throw new Error('Invalid JSON response from server');
                }
            });
        }
        
        return response.json();
    })
    .then(data => {
        console.log('✅ Response data:', data);
        console.log('✅ data.success:', data.success);
        console.log('✅ data.message:', data.message);
        
        if (data.success) {
            console.log('🎉 Success! Showing success modal');
            Swal.fire({
                icon: 'success',
                title: 'درخواست رزرو ارسال شد!',
                text: data.message || 'کارشناسان ما به زودی با شما تماس خواهند گرفت.',
                confirmButtonText: 'متوجه شدم',
                confirmButtonColor: '#B8860B',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                console.log('🍬 SweetAlert result:', result);
                if (result.isConfirmed) {
                    console.log('🔄 Reloading page...');
                    window.location.reload();
                }
            });
        } else {
            console.warn('⚠️ Server returned success: false');
            Swal.fire('خطا!', data.message || 'مشکلی پیش آمد.', 'error');
        }
    })
    .catch(error => {
        console.error('❌ Full error details:', {
            name: error.name,
            message: error.message,
            stack: error.stack,
            error: error
        });
        
        // دیباگ: نمایش خطای جزئی‌تر
        let errorMessage = 'ارتباط با سرور برقرار نشد.';
        if (error.message.includes('HTTP')) {
            errorMessage = `خطای سرور: ${error.message}`;
        } else if (error.message.includes('JSON')) {
            errorMessage = 'پاسخ سرور نامعتبر است.';
        }
        
        Swal.fire('خطا!', errorMessage, 'error');
    });
};

// دیباگ: اطمینان از اینکه تابع به درستی ثبت شده
console.log('✅ handleSubmit function registered globally');
console.log('📍 Current URL:', window.location.href);
console.log('🔍 CSRF meta tag:', document.querySelector('meta[name="csrf-token"]'));
console.log('🔍 CSRF input:', document.querySelector('input[name="_token"]'));

gsap.registerPlugin(ScrollTrigger);
window.ScrollTrigger = ScrollTrigger;
window.persianDate = persianDate;
gsap.registerPlugin(Flip);
window.gsap = gsap;
window.Flip = Flip;

window.Swiper = Swiper;
window.SwiperEffectCards = EffectCards;
window.SwiperAutoplay = Autoplay;

window.Alpine = Alpine;
window.axios = axios;
window.Splide = Splide;
window.IMask = IMask;
window.dayjs = dayjs;
window.flatpickr = flatpickr;

window.CrossImage = { Image };

window.Cropper = Cropper;

flatpickr.localize(flatpickr.l10ns.fa);

Alpine.start();