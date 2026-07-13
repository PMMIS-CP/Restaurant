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
    formData.append('description', store.description);   // "کپشن"

    // لاگ نهایی
    console.log('📦 Final FormData:');
    for (let [k, v] of formData.entries()) console.log(`  ${k}: ${v}`);

    // 3. ارسال (fetch بدون تغییر، فقط body=formData)
    fetch(event.target.action, {   // یا '{{ route("reserve.store") }}' به صورت مستقیم
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
            Swal.fire('موفق', data.message, 'success').then(() => location.reload());
        } else {
            Swal.fire('خطا', data.message, 'error');
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('خطا', 'ارتباط با سرور برقرار نشد.', 'error');
    });
};
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