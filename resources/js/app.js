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
flatpickr.localize(flatpickr.l10ns.fa);

Alpine.start();