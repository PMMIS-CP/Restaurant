import Alpine from 'alpinejs';
import axios from 'axios';
import Splide from '@splidejs/splide';
import 'lazysizes';
import IMask from 'imask';
import dayjs from 'dayjs';

import '@splidejs/splide/css'; 

window.Alpine = Alpine;
window.axios = axios;
window.Splide = Splide;
window.IMask = IMask;
window.dayjs = dayjs;

Alpine.start();