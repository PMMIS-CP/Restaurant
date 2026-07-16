@extends('front.layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">ورود به حساب</h2>

        {{-- نمایش خطاهای عمومی --}}
        <div id="general-error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg hidden"></div>

        {{-- مرحله ۱: شماره موبایل (همیشه نمایش دارد) --}}
        <div id="phone-step" class="space-y-6">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">شماره موبایل</label>
                <input type="text" name="phone" id="phone" 
                       placeholder="09xxxxxxxxx"
                       required
                       pattern="09[0-9]{9}"
                       title="شماره موبایل باید 11 رقم و با 09 شروع شود"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="check-phone-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                ادامه
            </button>
            <p id="check-phone-error" class="text-sm text-red-600 hidden"></p>
        </div>
        {{-- نمایش شماره موبایل تأیید شده --}}
        <div id="verified-phone-section" class="hidden bg-gray-50 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 rounded-full">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500 block">شماره موبایل:</span>
                        <span id="verified-phone" class="text-sm font-medium text-gray-900 dir-ltr"></span>
                    </div>
                </div>
                <button type="button" id="change-phone-btn" class="text-sm text-indigo-600 hover:text-indigo-500 underline">
                    ویرایش شماره
                </button>
            </div>
        </div>
        {{-- مرحله ۲: فرم ثبت‌نام (کاربر جدید) --}}
        <div id="register-step" class="hidden space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">نام</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="family" class="block text-sm font-medium text-gray-700">نام خانوادگی</label>
                <input type="text" name="family" id="family" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">ایمیل (اختیاری)</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
                <input type="password" name="password" id="password" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تکرار رمز عبور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="send-register-otp-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                دریافت کد تأیید
            </button>
            <p id="register-otp-message" class="text-sm text-green-600 hidden"></p>
            <p id="register-otp-error" class="text-sm text-red-600 hidden"></p>

            {{-- بخش ورود کد (بعد از ارسال موفق) --}}
            <div id="register-otp-section" class="hidden space-y-4">
                <div>
                    <label for="register-code" class="block text-sm font-medium text-gray-700">کد ۴ رقمی</label>
                    <input type="text" id="register-code" required pattern="[0-9]{4}" maxlength="4" inputmode="numeric" placeholder="کد ۴ رقمی"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <button type="button" id="verify-register-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    تأیید و ثبت‌نام
                </button>
                <button type="button" id="resend-register-otp" class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline disabled:text-gray-400 disabled:no-underline" disabled>
                    ارسال مجدد کد (<span id="resend-register-timer">60</span> ثانیه)
                </button>
            </div>
        </div>

        {{-- مرحله ۲: ورود با رمز عبور (کاربر موجود) --}}
        <div id="login-step" class="hidden space-y-4">
            <div>
                <label for="login-password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
                <input type="password" name="login-password" id="login-password" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="login-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                ورود
            </button>
            <p id="login-error" class="text-sm text-red-600 hidden"></p>
            <button type="button" id="forgot-password-btn" class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline">
                فراموشی رمز عبور
            </button>
        </div>

        {{-- مرحله بازیابی رمز عبور --}}
        <div id="reset-step" class="hidden space-y-4">
            <p class="text-sm text-gray-600">کد تأیید به شماره‌ی شما ارسال شد.</p>
            <div>
                <label for="reset-code" class="block text-sm font-medium text-gray-700">کد ۴ رقمی</label>
                <input type="text" id="reset-code" required pattern="[0-9]{4}" maxlength="4" inputmode="numeric" placeholder="کد ۴ رقمی"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="verify-reset-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                تأیید کد
            </button>
            <p id="reset-code-error" class="text-sm text-red-600 hidden"></p>
            <div id="new-password-section" class="hidden space-y-4">
                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700">رمز عبور جدید</label>
                    <input type="password" id="new-password" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <div>
                    <label for="new-password-confirm" class="block text-sm font-medium text-gray-700">تکرار رمز عبور جدید</label>
                    <input type="password" id="new-password-confirm" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <button type="button" id="set-new-password-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    ثبت رمز عبور جدید
                </button>
                <p id="new-password-error" class="text-sm text-red-600 hidden"></p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone');
    const checkPhoneBtn = document.getElementById('check-phone-btn');
    const checkPhoneError = document.getElementById('check-phone-error');
    const generalError = document.getElementById('general-error');

    const phoneStep = document.getElementById('phone-step');
    const registerStep = document.getElementById('register-step');
    const loginStep = document.getElementById('login-step');
    const resetStep = document.getElementById('reset-step');

    // ذخیره موقت شماره برای استفاده در مراحل بعدی
    let currentPhone = '';

    // توابع کمکی
    function show(el) { el.classList.remove('hidden'); }
    function hide(el) { el.classList.add('hidden'); }
    function setError(el, msg) { el.textContent = msg; show(el); }
    function clearError(el) { el.textContent = ''; hide(el); }

    // بررسی وجود کاربر با شماره موبایل
    checkPhoneBtn.addEventListener('click', async function() {
        const phone = phoneInput.value.trim();
        if (!/^09\d{9}$/.test(phone)) {
            setError(checkPhoneError, 'شماره موبایل معتبر نیست.');
            return;
        }
        clearError(checkPhoneError);
        currentPhone = phone;
        checkPhoneBtn.disabled = true;
        checkPhoneBtn.textContent = 'در حال بررسی...';

        try {
            const response = await fetch('{{ route("check.phone") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ phone: phone })
            });
            const data = await response.json();
            
            // مخفی کردن مرحله شماره موبایل
            hide(phoneStep);
            
            // نمایش شماره تأیید شده
            document.getElementById('verified-phone').textContent = phone;
            show(document.getElementById('verified-phone-section'));
            
            if (data.exists) {
                // کاربر موجود → نمایش فرم ورود با رمز
                hide(registerStep);
                hide(resetStep);
                show(loginStep);
            } else {
                // کاربر جدید → نمایش فرم ثبت‌نام
                hide(loginStep);
                hide(resetStep);
                show(registerStep);
            }
        } catch (err) {
            setError(checkPhoneError, 'خطا در ارتباط با سرور.');
        } finally {
            checkPhoneBtn.disabled = false;
            checkPhoneBtn.textContent = 'ادامه';
        }
    });

    // دکمه ویرایش شماره - برگشت به مرحله اول
    document.getElementById('change-phone-btn').addEventListener('click', function() {
        hide(registerStep);
        hide(loginStep);
        hide(resetStep);
        hide(document.getElementById('verified-phone-section'));
        show(phoneStep);
        phoneInput.focus();
    });

    // ----- بخش ثبت‌نام کاربر جدید -----
    const sendRegOtp = document.getElementById('send-register-otp-btn');
    const regOtpMsg = document.getElementById('register-otp-message');
    const regOtpError = document.getElementById('register-otp-error');
    const regOtpSection = document.getElementById('register-otp-section');
    const regCodeInput = document.getElementById('register-code');
    const verifyRegBtn = document.getElementById('verify-register-btn');
    const resendRegBtn = document.getElementById('resend-register-otp');
    const resendRegTimer = document.getElementById('resend-register-timer');
    let regTimerInterval;

    function startRegResendTimer(seconds = 60) {
        let rem = seconds;
        resendRegBtn.disabled = true;
        resendRegTimer.textContent = rem;
        if (regTimerInterval) clearInterval(regTimerInterval);
        regTimerInterval = setInterval(() => {
            rem--;
            resendRegTimer.textContent = rem;
            if (rem <= 0) {
                clearInterval(regTimerInterval);
                resendRegBtn.disabled = false;
                resendRegTimer.textContent = '';
                resendRegBtn.innerHTML = 'ارسال مجدد کد';
            }
        }, 1000);
    }

    function stopRegResendTimer() {
        if (regTimerInterval) {
            clearInterval(regTimerInterval);
            regTimerInterval = null;
        }
    }

    async function sendRegisterOtp() {
        const name = document.getElementById('name').value.trim();
        const family = document.getElementById('family').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const passwordConf = document.getElementById('password_confirmation').value;

        // پاک کردن خطاهای قبلی
        clearError(regOtpError);
        hide(regOtpMsg);
        
        // اعتبارسنجی اولیه
        if (!name || !family) {
            setError(regOtpError, 'نام و نام خانوادگی الزامی است.');
            if (!name) document.getElementById('name').focus();
            else document.getElementById('family').focus();
            return;
        }
        
        if (!password) {
            setError(regOtpError, 'رمز عبور الزامی است.');
            document.getElementById('password').focus();
            return;
        }
        
        if (password.length < 6) {
            setError(regOtpError, 'رمز عبور حداقل ۶ کاراکتر باشد.');
            document.getElementById('password').focus();
            return;
        }
        
        if (password !== passwordConf) {
            setError(regOtpError, 'رمز عبور و تکرار آن یکسان نیستند.');
            document.getElementById('password_confirmation').focus();
            return;
        }
        
        // اگر ایمیل وارد شده، فرمت آن را چک کن
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                setError(regOtpError, 'فرمت ایمیل معتبر نیست.');
                document.getElementById('email').focus();
                return;
            }
        }

        sendRegOtp.disabled = true;
        sendRegOtp.textContent = 'در حال اعتبارسنجی...';

        try {
            // مرحله ۱: اعتبارسنجی اطلاعات (بررسی ایمیل تکراری)
            const validateResponse = await fetch('{{ route("validate.registration") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    family_name: family,
                    email: email,
                    password: password,
                    password_confirmation: passwordConf
                })
            });

            const validateData = await validateResponse.json();
            
            if (!validateResponse.ok) {
                // خطا در اعتبارسنجی - نمایش پیام و فوکوس روی فیلد مربوطه
                const errorMsg = validateData.message || 'اطلاعات وارد شده معتبر نیست.';
                
                if (errorMsg.includes('ایمیل')) {
                    setError(regOtpError, errorMsg);
                    document.getElementById('email').focus();
                } else if (errorMsg.includes('رمز عبور')) {
                    setError(regOtpError, errorMsg);
                    document.getElementById('password').focus();
                } else if (errorMsg.includes('نام')) {
                    setError(regOtpError, errorMsg);
                    if (errorMsg.includes('خانوادگی')) document.getElementById('family').focus();
                    else document.getElementById('name').focus();
                } else {
                    setError(regOtpError, errorMsg);
                }
                
                sendRegOtp.disabled = false;
                sendRegOtp.textContent = 'دریافت کد تأیید';
                return;
            }

            // مرحله ۲: ارسال کد تأیید
            sendRegOtp.textContent = 'در حال ارسال کد...';
            
            const otpResponse = await fetch('{{ route("send.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    name: name,
                    family_name: family,
                    email: email,
                    password: password,
                    password_confirmation: passwordConf,
                    purpose: 'register'
                })
            });
            
            const otpData = await otpResponse.json();
            
            if (otpResponse.ok && otpData.message) {
                // موفقیت - نمایش بخش ورود کد
                hide(sendRegOtp);
                show(regOtpMsg);
                regOtpMsg.textContent = 'کد تأیید به شماره ' + currentPhone + ' ارسال شد.';
                show(regOtpSection);
                startRegResendTimer();
                regCodeInput.value = '';
                regCodeInput.focus();
                clearError(regOtpError);
            } else {
                // خطا در ارسال کد
                if (otpResponse.status === 429) {
                    setError(regOtpError, otpData.message || 'لطفاً کمی صبر کنید.');
                } else {
                    setError(regOtpError, otpData.message || 'خطا در ارسال کد تأیید.');
                }
                sendRegOtp.disabled = false;
                sendRegOtp.textContent = 'دریافت کد تأیید';
            }
        } catch (err) {
            console.error('Error:', err);
            setError(regOtpError, 'خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.');
            sendRegOtp.disabled = false;
            sendRegOtp.textContent = 'دریافت کد تأیید';
        }
    }

    sendRegOtp.addEventListener('click', sendRegisterOtp);
    resendRegBtn.addEventListener('click', sendRegisterOtp);

    // تأیید کد ثبت‌نام
    verifyRegBtn.addEventListener('click', async function() {
        const code = regCodeInput.value.trim();
        if (!/^\d{4}$/.test(code)) {
            setError(regOtpError, 'کد ۴ رقمی را وارد کنید.');
            regCodeInput.focus();
            return;
        }
        
        clearError(regOtpError);
        verifyRegBtn.disabled = true;
        verifyRegBtn.textContent = 'در حال تأیید...';

        try {
            const response = await fetch('{{ route("verify.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    code: code,
                    purpose: 'register'
                })
            });
            
            const data = await response.json();
            
            if (response.ok && data.redirect) {
                stopRegResendTimer();
                window.location.href = data.redirect;
            } else {
                const errorMsg = data.message || 'کد نامعتبر است.';
                
                // مدیریت خطاهای خاص
                if (errorMsg.includes('ایمیل')) {
                    // خطای ایمیل تکراری - برگشت به فرم ثبت‌نام
                    setError(regOtpError, errorMsg);
                    show(sendRegOtp);
                    hide(regOtpSection);
                    hide(regOtpMsg);
                    document.getElementById('email').focus();
                    document.getElementById('email').value = '';
                    stopRegResendTimer();
                } else if (errorMsg.includes('کد') || errorMsg.includes('نامعتبر') || errorMsg.includes('منقضی')) {
                    setError(regOtpError, errorMsg);
                    regCodeInput.value = '';
                    regCodeInput.focus();
                } else {
                    setError(regOtpError, errorMsg);
                }
                
                verifyRegBtn.disabled = false;
                verifyRegBtn.textContent = 'تأیید و ثبت‌نام';
            }
        } catch (err) {
            console.error('Error:', err);
            setError(regOtpError, 'خطای شبکه. لطفاً دوباره تلاش کنید.');
            verifyRegBtn.disabled = false;
            verifyRegBtn.textContent = 'تأیید و ثبت‌نام';
        }
    });

    // پاک کردن تایمر هنگام خروج از صفحه
    window.addEventListener('beforeunload', function() {
        stopRegResendTimer();
    });

    // ----- بخش ورود با رمز عبور (کاربر موجود) -----
    const loginBtn = document.getElementById('login-btn');
    const loginPassword = document.getElementById('login-password');
    const loginError = document.getElementById('login-error');
    const forgotBtn = document.getElementById('forgot-password-btn');

    loginBtn.addEventListener('click', async function() {
        const password = loginPassword.value;
        if (!password) {
            setError(loginError, 'رمز عبور را وارد کنید.');
            loginPassword.focus();
            return;
        }
        clearError(loginError);
        loginBtn.disabled = true;
        loginBtn.textContent = 'در حال ورود...';

        try {
            const response = await fetch('{{ route("login.phone") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    password: password
                })
            });
            const data = await response.json();
            if (response.ok && data.redirect) {
                window.location.href = data.redirect;
            } else {
                setError(loginError, data.message || 'اطلاعات ورود اشتباه است.');
                loginPassword.value = '';
                loginPassword.focus();
            }
        } catch (err) {
            console.error('Error:', err);
            setError(loginError, 'خطای شبکه. لطفاً دوباره تلاش کنید.');
        } finally {
            loginBtn.disabled = false;
            loginBtn.textContent = 'ورود';
        }
    });

    // ورود با زدن Enter در فیلد رمز عبور
    loginPassword.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            loginBtn.click();
        }
    });

    // ----- بازیابی رمز عبور -----
    const resetCodeInput = document.getElementById('reset-code');
    const verifyResetBtn = document.getElementById('verify-reset-btn');
    const resetCodeError = document.getElementById('reset-code-error');
    const newPasswordSection = document.getElementById('new-password-section');
    const setNewPasswordBtn = document.getElementById('set-new-password-btn');
    const newPassword = document.getElementById('new-password');
    const newPasswordConfirm = document.getElementById('new-password-confirm');
    const newPasswordError = document.getElementById('new-password-error');

    forgotBtn.addEventListener('click', async function() {
        hide(loginStep);
        show(resetStep);
        clearError(resetCodeError);
        
        // ارسال کد بازیابی
        try {
            const response = await fetch('{{ route("send.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    purpose: 'reset'
                })
            });
            const data = await response.json();
            if (!response.ok) {
                setError(resetCodeError, data.message || 'خطا در ارسال کد.');
            }
        } catch (err) {
            console.error('Error:', err);
            setError(resetCodeError, 'خطای شبکه. لطفاً دوباره تلاش کنید.');
        }
    });

    // تأیید کد بازیابی
    verifyResetBtn.addEventListener('click', async function() {
        const code = resetCodeInput.value.trim();
        if (!/^\d{4}$/.test(code)) {
            setError(resetCodeError, 'کد ۴ رقمی را وارد کنید.');
            resetCodeInput.focus();
            return;
        }
        clearError(resetCodeError);
        verifyResetBtn.disabled = true;
        verifyResetBtn.textContent = 'در حال بررسی...';

        try {
            const response = await fetch('{{ route("verify.reset.otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    code: code
                })
            });
            const data = await response.json();
            if (response.ok && data.valid) {
                // کد درست بود → نمایش فیلدهای رمز جدید
                hide(verifyResetBtn.parentElement);
                show(newPasswordSection);
                newPassword.focus();
            } else {
                setError(resetCodeError, data.message || 'کد نامعتبر است.');
                resetCodeInput.value = '';
                resetCodeInput.focus();
            }
        } catch (err) {
            console.error('Error:', err);
            setError(resetCodeError, 'خطای شبکه. لطفاً دوباره تلاش کنید.');
        } finally {
            verifyResetBtn.disabled = false;
            verifyResetBtn.textContent = 'تأیید کد';
        }
    });

    // ثبت رمز عبور جدید
    setNewPasswordBtn.addEventListener('click', async function() {
        const pwd = newPassword.value;
        const pwdConf = newPasswordConfirm.value;
        
        if (!pwd || !pwdConf) {
            setError(newPasswordError, 'هر دو فیلد را پر کنید.');
            if (!pwd) newPassword.focus();
            else newPasswordConfirm.focus();
            return;
        }
        if (pwd.length < 6) {
            setError(newPasswordError, 'رمز عبور حداقل ۶ کاراکتر باشد.');
            newPassword.focus();
            return;
        }
        if (pwd !== pwdConf) {
            setError(newPasswordError, 'رمز عبور و تکرار آن یکسان نیستند.');
            newPasswordConfirm.focus();
            return;
        }
        
        clearError(newPasswordError);
        setNewPasswordBtn.disabled = true;
        setNewPasswordBtn.textContent = 'در حال ثبت...';

        try {
            const response = await fetch('{{ route("reset.password.sms") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    phone: currentPhone,
                    code: resetCodeInput.value.trim(),
                    password: pwd,
                    password_confirmation: pwdConf
                })
            });
            const data = await response.json();
            if (response.ok && data.redirect) {
                window.location.href = data.redirect;
            } else {
                setError(newPasswordError, data.message || 'خطا در تغییر رمز.');
            }
        } catch (err) {
            console.error('Error:', err);
            setError(newPasswordError, 'خطای شبکه. لطفاً دوباره تلاش کنید.');
        } finally {
            setNewPasswordBtn.disabled = false;
            setNewPasswordBtn.textContent = 'ثبت رمز عبور جدید';
        }
    });

    // فوکوس خودکار روی اولین فیلد هنگام لود صفحه
    phoneInput.focus();
});
</script>
@endpush