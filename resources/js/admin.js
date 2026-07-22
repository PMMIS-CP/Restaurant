import Alpine from 'alpinejs';
// import axios from 'axios';
import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';
import { Image } from 'cross-image';
// import Swal from 'sweetalert2';
import { gregorianToHijri } from '@tabby_ai/hijri-converter';

window.Alpine = Alpine;
// window.axios = axios;
window.Cropper = Cropper;
window.CrossImage = { Image };
// window.Swal = Swal;

import './Amain.js';

Alpine.start();