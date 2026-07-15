@extends('front.layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">ورود به حساب</h2>

        {{-- نمایش خطاهای سمت سرور (مثلاً کد اشتباه) --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- فرم اصلی --}}
        <form id="login-form" action="{{ route('verify.otp') }}" method="POST" class="space-y-6">
            @csrf

            {{-- فیلد شماره موبایل --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">شماره موبایل</label>
                <input type="text" name="phone" id="phone" 
                       placeholder="09xxxxxxxxx"
                       required
                       pattern="09[0-9]{9}"
                       title="شماره موبایل باید 11 رقم و با 09 شروع شود"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>

            {{-- دکمه دریافت کد (در ابتدا فعال است) --}}
            <div id="send-otp-section">
                <button type="button" id="send-otp-btn" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    دریافت کد تأیید
                </button>
                <p id="otp-sent-message" class="mt-2 text-sm text-green-600 hidden">کد تأیید ارسال شد.</p>
                <p id="otp-error-message" class="mt-2 text-sm text-red-600 hidden"></p>
            </div>

            {{-- بخش وارد کردن کد (ابتدا مخفی) --}}
            <div id="verify-otp-section" class="hidden space-y-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">کد ۴ رقمی</label>
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
                    ورود
                </button>
                <button type="button" id="resend-otp-btn" 
                        class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline disabled:text-gray-400 disabled:no-underline" disabled>
                    ارسال مجدد کد (<span id="resend-timer">60</span> ثانیه)
                </button>
            </div>
        </form>
    </div>
</div>

{{-- اسکریپت مدیریت Ajax --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sendBtn = document.getElementById('send-otp-btn');
    const resendBtn = document.getElementById('resend-otp-btn');
    const phoneInput = document.getElementById('phone');
    const codeInput = document.getElementById('code');
    const sendSection = document.getElementById('send-otp-section');
    const verifySection = document.getElementById('verify-otp-section');
    const otpSentMsg = document.getElementById('otp-sent-message');
    const otpErrorMsg = document.getElementById('otp-error-message');
    const timerSpan = document.getElementById('resend-timer');
    let countdownInterval;

    // اعتبارسنجی اولیه شماره
    function isValidPhone(phone) {
        return /^09\d{9}$/.test(phone);
    }

    // تایمر ارسال مجدد
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

    // ارسال درخواست کد
    async function sendOtp() {
        const phone = phoneInput.value.trim();
        if (!isValidPhone(phone)) {
            alert('لطفاً یک شماره موبایل معتبر وارد کنید.');
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
                body: JSON.stringify({ phone: phone })
            });

            const data = await response.json();

            if (response.ok && data.message) {
                // موفقیت
                sendSection.classList.add('hidden');
                verifySection.classList.remove('hidden');
                otpSentMsg.classList.remove('hidden');
                startResendTimer();
            } else {
                // خطا از سمت سرور
                otpErrorMsg.textContent = data.message || 'خطایی رخ داد، دوباره تلاش کنید.';
                otpErrorMsg.classList.remove('hidden');
                sendBtn.disabled = false;
                sendBtn.textContent = 'دریافت کد تأیید';
            }
        } catch (error) {
            console.error(error);
            otpErrorMsg.textContent = 'خطای شبکه، دوباره تلاش کنید.';
            otpErrorMsg.classList.remove('hidden');
            sendBtn.disabled = false;
            sendBtn.textContent = 'دریافت کد تأیید';
        }
    }

    // کلیک روی دکمه دریافت کد
    sendBtn.addEventListener('click', sendOtp);

    // ارسال مجدد
    resendBtn.addEventListener('click', sendOtp);

    // قبل از ارسال فرم ورود (verify-otp) اعتبار کد سمت کلاینت
    const form = document.getElementById('login-form');
    form.addEventListener('submit', function(e) {
        if (codeInput.value.trim().length !== 4) {
            e.preventDefault();
            alert('کد ۴ رقمی را وارد کنید.');
        }
    });
});
</script>
@endpush