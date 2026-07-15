@extends('front.layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">ثبت‌نام</h2>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="register-form" action="{{ route('verify.otp') }}" method="POST" class="space-y-6">
            @csrf

            {{-- فیلدهای اطلاعات کاربر (قبل از ارسال کد) --}}
            <div id="user-info-section">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">نام</label>
                    <input type="text" name="name" id="name" required
                           placeholder="نام"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="family_name" class="block text-sm font-medium text-gray-700">نام خانوادگی</label>
                    <input type="text" name="family_name" id="family_name" required
                           placeholder="نام خانوادگی"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">شماره موبایل</label>
                    <input type="text" name="phone" id="phone" 
                           placeholder="09xxxxxxxxx"
                           required
                           pattern="09[0-9]{9}"
                           title="شماره موبایل باید 11 رقم و با 09 شروع شود"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>

                <button type="button" id="send-otp-btn" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    ادامه (دریافت کد تأیید)
                </button>
                <p id="otp-sent-message" class="mt-2 text-sm text-green-600 hidden">کد تأیید به شماره شما ارسال شد.</p>
                <p id="otp-error-message" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            {{-- بخش تأیید کد (ابتدا مخفی) --}}
            <div id="verify-otp-section" class="hidden space-y-4">
                <p class="text-sm text-gray-600">لطفاً کد ۴ رقمی ارسال‌شده به شماره <span id="shown-phone" class="font-semibold"></span> را وارد کنید.</p>
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">کد تأیید</label>
                    <input type="text" name="code" id="code" 
                           required
                           pattern="[0-9]{4}"
                           maxlength="4"
                           inputmode="numeric"
                           placeholder="کد ۴ رقمی"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    تکمیل ثبت‌نام
                </button>
                <button type="button" id="resend-otp-btn" 
                        class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline disabled:text-gray-400 disabled:no-underline" disabled>
                    ارسال مجدد کد (<span id="resend-timer">60</span> ثانیه)
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sendBtn = document.getElementById('send-otp-btn');
    const resendBtn = document.getElementById('resend-otp-btn');
    const nameInput = document.getElementById('name');
    const familyInput = document.getElementById('family_name');
    const phoneInput = document.getElementById('phone');
    const codeInput = document.getElementById('code');
    const infoSection = document.getElementById('user-info-section');
    const verifySection = document.getElementById('verify-otp-section');
    const otpSentMsg = document.getElementById('otp-sent-message');
    const otpErrorMsg = document.getElementById('otp-error-message');
    const shownPhone = document.getElementById('shown-phone');
    const timerSpan = document.getElementById('resend-timer');
    let countdownInterval;

    function isValidPhone(phone) {
        return /^09\d{9}$/.test(phone);
    }

    function startResendTimer(seconds = 60) {
        let remaining = seconds;
        resendBtn.disabled = true;
        timerSpan.textContent = remaining;
        if (countdownInterval) clearInterval(countdownInterval);
        countdownInterval = setInterval(() => {
            remaining--;
            timerSpan.textContent = remaining;
            if (remaining <= 0) {
                clearInterval(countdownInterval);
                resendBtn.disabled = false;
                timerSpan.textContent = '';
                resendBtn.innerHTML = 'ارسال مجدد کد';
            }
        }, 1000);
    }

    async function sendOtp() {
        const phone = phoneInput.value.trim();
        const name = nameInput.value.trim();
        const family = familyInput.value.trim();

        if (!isValidPhone(phone)) {
            alert('لطفاً شماره موبایل معتبر وارد کنید.');
            return;
        }
        if (!name || !family) {
            alert('لطفاً نام و نام خانوادگی را وارد کنید.');
            return;
        }

        sendBtn.disabled = true;
        sendBtn.textContent = 'در حال ارسال...';
        otpErrorMsg.classList.add('hidden');
        otpSentMsg.classList.add('hidden');

        try {
            const response = await fetch('{{ route("send.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    phone: phone,
                    name: name,
                    family_name: family
                })
            });

            const data = await response.json();

            if (response.ok && data.message) {
                // نمایش بخش تأیید کد
                infoSection.classList.add('hidden');
                verifySection.classList.remove('hidden');
                otpSentMsg.classList.remove('hidden');
                shownPhone.textContent = phone;
                startResendTimer();
            } else {
                otpErrorMsg.textContent = data.message || 'خطا در ارسال پیامک، لطفاً دوباره تلاش کنید.';
                otpErrorMsg.classList.remove('hidden');
                sendBtn.disabled = false;
                sendBtn.textContent = 'ادامه (دریافت کد تأیید)';
            }
        } catch (error) {
            console.error(error);
            otpErrorMsg.textContent = 'خطای شبکه. دوباره تلاش کنید.';
            otpErrorMsg.classList.remove('hidden');
            sendBtn.disabled = false;
            sendBtn.textContent = 'ادامه (دریافت کد تأیید)';
        }
    }

    sendBtn.addEventListener('click', sendOtp);
    resendBtn.addEventListener('click', sendOtp);

    const form = document.getElementById('register-form');
    form.addEventListener('submit', function(e) {
        if (codeInput.value.trim().length !== 4) {
            e.preventDefault();
            alert('کد ۴ رقمی را وارد کنید.');
        }
    });
});
</script>
@endpush