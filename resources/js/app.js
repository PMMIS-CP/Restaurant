import Alpine from 'alpinejs';
import Swiper from 'swiper';
import { EffectCards, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/effect-cards';

import { gsap } from "gsap";
import persianDate from 'persian-date';

import Swal from 'sweetalert2';
import { gregorianToHijri } from '@tabby_ai/hijri-converter';

window.Swal = Swal;
window.persianDate = persianDate;
window.gsap = gsap;
window.gregorianToHijri = gregorianToHijri;

window.Swiper = Swiper;
window.SwiperEffectCards = EffectCards;
window.SwiperAutoplay = Autoplay;

window.Alpine = Alpine;

import './main.js';

Alpine.start();