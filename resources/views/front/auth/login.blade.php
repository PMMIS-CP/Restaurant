@extends('front.layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">{{ __('auth.login.page_title') }}</h2>

        {{-- نمایش خطاهای عمومی --}}
        <div id="general-error" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg hidden"></div>

        {{-- مرحله ۱: شماره موبایل (همیشه نمایش دارد) --}}
        <div id="phone-step" class="space-y-6">
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('auth.login.phone_label') }}</label>
                <input type="text" name="phone" id="phone" 
                       placeholder="{{ __('auth.login.phone_placeholder') }}"
                       required
                       pattern="09[0-9]{9}"
                       title="{{ __('auth.login.phone_title') }}"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="check-phone-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                {{ __('auth.login.continue_button') }}
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
                        <span class="text-sm text-gray-500 block">{{ __('auth.login.verified_phone_label') }}</span>
                        <span id="verified-phone" class="text-sm font-medium text-gray-900 dir-ltr"></span>
                    </div>
                </div>
                <button type="button" id="change-phone-btn" class="text-sm text-indigo-600 hover:text-indigo-500 underline">
                    {{ __('auth.login.edit_phone') }}
                </button>
            </div>
        </div>
        {{-- مرحله ۲: فرم ثبت‌نام (کاربر جدید) --}}
        <div id="register-step" class="hidden space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">{{ __('auth.login.name_label') }}</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="family" class="block text-sm font-medium text-gray-700">{{ __('auth.login.family_label') }}</label>
                <input type="text" name="family" id="family" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth.login.email_label_optional') }}</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('auth.login.password_label') }}</label>
                <input type="password" name="password" id="password" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('auth.login.password_confirmation_label') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="send-register-otp-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                {{ __('auth.login.get_verification_code') }}
            </button>
            <p id="register-otp-message" class="text-sm text-green-600 hidden"></p>
            <p id="register-otp-error" class="text-sm text-red-600 hidden"></p>

            {{-- بخش ورود کد (بعد از ارسال موفق) --}}
            <div id="register-otp-section" class="hidden space-y-4">
                <div>
                    <label for="register-code" class="block text-sm font-medium text-gray-700">{{ __('auth.login.code_4_digit_label') }}</label>
                    <input type="text" id="register-code" required pattern="[0-9]{4}" maxlength="4" inputmode="numeric" placeholder="{{ __('auth.login.code_4_digit_placeholder') }}"
                           class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <button type="button" id="verify-register-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    {{ __('auth.login.verify_and_register') }}
                </button>
                <button type="button" id="resend-register-otp" class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline disabled:text-gray-400 disabled:no-underline" disabled>
                    {{ __('auth.login.resend_code') }} (<span id="resend-register-timer">60</span>)
                </button>
            </div>
        </div>

        {{-- مرحله ۲: ورود با رمز عبور (کاربر موجود) --}}
        <div id="login-step" class="hidden space-y-4">
            <div>
                <label for="login-password" class="block text-sm font-medium text-gray-700">{{ __('auth.login.password_label') }}</label>
                <input type="password" name="login-password" id="login-password" required class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="login-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                {{ __('auth.login.login_button') }}
            </button>
            <p id="login-error" class="text-sm text-red-600 hidden"></p>
            <button type="button" id="forgot-password-btn" class="w-full text-sm text-indigo-600 hover:text-indigo-500 underline">
                {{ __('auth.login.forgot_password') }}
            </button>
        </div>

        {{-- مرحله بازیابی رمز عبور --}}
        <div id="reset-step" class="hidden space-y-4">
            <p class="text-sm text-gray-600">{{ __('auth.login.reset_code_sent') }}</p>
            <div>
                <label for="reset-code" class="block text-sm font-medium text-gray-700">{{ __('auth.login.code_4_digit_label') }}</label>
                <input type="text" id="reset-code" required pattern="[0-9]{4}" maxlength="4" inputmode="numeric" placeholder="{{ __('auth.login.code_4_digit_placeholder') }}"
                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
            </div>
            <button type="button" id="verify-reset-btn"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                {{ __('auth.login.verify_code') }}
            </button>
            <p id="reset-code-error" class="text-sm text-red-600 hidden"></p>
            <div id="new-password-section" class="hidden space-y-4">
                <div>
                    <label for="new-password" class="block text-sm font-medium text-gray-700">{{ __('auth.login.new_password_label') }}</label>
                    <input type="password" id="new-password" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <div>
                    <label for="new-password-confirm" class="block text-sm font-medium text-gray-700">{{ __('auth.login.new_password_confirmation_label') }}</label>
                    <input type="password" id="new-password-confirm" required minlength="6" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-left dir-ltr">
                </div>
                <button type="button" id="set-new-password-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                    {{ __('auth.login.set_new_password') }}
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

    const __auth = {
        invalidPhone: '{{ __("auth.login.js_invalid_phone") }}',
        checking: '{{ __("auth.login.js_checking") }}',
        serverError: '{{ __("auth.login.js_server_error") }}',
        continue: '{{ __("auth.login.js_continue") }}',
        nameFamilyRequired: '{{ __("auth.login.js_name_family_required") }}',
        passwordRequired: '{{ __("auth.login.js_password_required") }}',
        passwordMin: '{{ __("auth.login.js_password_min") }}',
        passwordMismatch: '{{ __("auth.login.js_password_mismatch") }}',
        invalidEmail: '{{ __("auth.login.js_invalid_email") }}',
        validating: '{{ __("auth.login.js_validating") }}',
        getCode: '{{ __("auth.login.js_get_code") }}',
        sendingCode: '{{ __("auth.login.js_sending_code") }}',
        codeSent: '{{ __("auth.login.js_code_sent") }}',
        wait: '{{ __("auth.login.js_wait") }}',
        sendCodeError: '{{ __("auth.login.js_send_code_error") }}',
        codeRequired: '{{ __("auth.login.js_code_required") }}',
        verifying: '{{ __("auth.login.js_verifying") }}',
        invalidCode: '{{ __("auth.login.js_invalid_code") }}',
        networkError: '{{ __("auth.login.js_network_error") }}',
        verifyRegister: '{{ __("auth.login.js_verify_register") }}',
        enterPassword: '{{ __("auth.login.js_enter_password") }}',
        loggingIn: '{{ __("auth.login.js_logging_in") }}',
        wrongCredentials: '{{ __("auth.login.js_wrong_credentials") }}',
        login: '{{ __("auth.login.js_login") }}',
        sendResetCodeError: '{{ __("auth.login.js_send_reset_code_error") }}',
        fillBothFields: '{{ __("auth.login.js_fill_both_fields") }}',
        saving: '{{ __("auth.login.js_saving") }}',
        passwordChangeError: '{{ __("auth.login.js_password_change_error") }}',
        setPassword: '{{ __("auth.login.js_set_password") }}',
        resendCode: '{{ __("auth.login.resend_code") }}',
        verifyCode: '{{ __("auth.login.verify_code") }}',
        invalidData: '{{ __("auth.login.js_invalid_data") }}',
        email: '{{ __("auth.login.js_email") }}',
        password: '{{ __("auth.login.js_password") }}',
        name: '{{ __("auth.login.js_name") }}',
        family: '{{ __("auth.login.js_family") }}',
        code: '{{ __("auth.login.js_code") }}',
        expired: '{{ __("auth.login.js_expired") }}',
    };

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
            setError(checkPhoneError, __auth.invalidPhone);
            return;
        }
        clearError(checkPhoneError);
        currentPhone = phone;
        checkPhoneBtn.disabled = true;
        checkPhoneBtn.textContent = __auth.checking;

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
            setError(checkPhoneError, __auth.serverError);
        } finally {
            checkPhoneBtn.disabled = false;
            checkPhoneBtn.textContent = __auth.continue;
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
                resendRegBtn.innerHTML = __auth.resendCode;
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
            setError(regOtpError, __auth.nameFamilyRequired);
            if (!name) document.getElementById('name').focus();
            else document.getElementById('family').focus();
            return;
        }
        
        if (!password) {
            setError(regOtpError, __auth.passwordRequired);
            document.getElementById('password').focus();
            return;
        }
        
        if (password.length < 6) {
            setError(regOtpError, __auth.passwordMin);
            document.getElementById('password').focus();
            return;
        }
        
        if (password !== passwordConf) {
            setError(regOtpError, __auth.passwordMismatch);
            document.getElementById('password_confirmation').focus();
            return;
        }
        
        // اگر ایمیل وارد شده، فرمت آن را چک کن
        if (email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                setError(regOtpError, __auth.invalidEmail);
                document.getElementById('email').focus();
                return;
            }
        }

        sendRegOtp.disabled = true;
        sendRegOtp.textContent = __auth.validating;

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
                const errorMsg = validateData.message || __auth.invalidData;
                
                if (errorMsg.includes(__auth.email)) {
                    setError(regOtpError, errorMsg);
                    document.getElementById('email').focus();
                } else if (errorMsg.includes(__auth.password)) {
                    setError(regOtpError, errorMsg);
                    document.getElementById('password').focus();
                } else if (errorMsg.includes(__auth.name)) {
                    setError(regOtpError, errorMsg);
                    if (errorMsg.includes(__auth.family)) document.getElementById('family').focus();
                    else document.getElementById('name').focus();
                } else {
                    setError(regOtpError, errorMsg);
                }
                
                sendRegOtp.disabled = false;
                sendRegOtp.textContent = __auth.getCode;
                return;
            }

            // مرحله ۲: ارسال کد تأیید
            sendRegOtp.textContent = __auth.sendingCode;
            
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
                regOtpMsg.textContent = __auth.codeSent.replace(':phone', currentPhone);
                show(regOtpSection);
                startRegResendTimer();
                regCodeInput.value = '';
                regCodeInput.focus();
                clearError(regOtpError);
            } else {
                // خطا در ارسال کد
                if (otpResponse.status === 429) {
                    setError(regOtpError, otpData.message || __auth.wait);
                } else {
                    setError(regOtpError, otpData.message || __auth.sendCodeError);
                }
                sendRegOtp.disabled = false;
                sendRegOtp.textContent = __auth.getCode;
            }
        } catch (err) {
            console.error('Error:', err);
            setError(regOtpError, __auth.serverError);
            sendRegOtp.disabled = false;
            sendRegOtp.textContent = __auth.getCode;
        }
    }

    sendRegOtp.addEventListener('click', sendRegisterOtp);
    resendRegBtn.addEventListener('click', sendRegisterOtp);

    // تأیید کد ثبت‌نام
    verifyRegBtn.addEventListener('click', async function() {
        const code = regCodeInput.value.trim();
        if (!/^\d{4}$/.test(code)) {
            setError(regOtpError, __auth.codeRequired);
            regCodeInput.focus();
            return;
        }
        
        clearError(regOtpError);
        verifyRegBtn.disabled = true;
        verifyRegBtn.textContent = __auth.verifying;

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
                const errorMsg = data.message || __auth.invalidCode;
                
                // مدیریت خطاهای خاص
                if (errorMsg.includes(__auth.email)) {
                    // خطای ایمیل تکراری - برگشت به فرم ثبت‌نام
                    setError(regOtpError, errorMsg);
                    show(sendRegOtp);
                    hide(regOtpSection);
                    hide(regOtpMsg);
                    document.getElementById('email').focus();
                    document.getElementById('email').value = '';
                    stopRegResendTimer();
                } else if (errorMsg.includes(__auth.code) || errorMsg.includes(__auth.invalidCode) || errorMsg.includes(__auth.expired)) {
                    setError(regOtpError, errorMsg);
                    regCodeInput.value = '';
                    regCodeInput.focus();
                } else {
                    setError(regOtpError, errorMsg);
                }
                
                verifyRegBtn.disabled = false;
                verifyRegBtn.textContent = __auth.verifyRegister;
            }
        } catch (err) {
            console.error('Error:', err);
            setError(regOtpError, __auth.networkError);
            verifyRegBtn.disabled = false;
            verifyRegBtn.textContent = __auth.verifyRegister;
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
            setError(loginError, __auth.enterPassword);
            loginPassword.focus();
            return;
        }
        clearError(loginError);
        loginBtn.disabled = true;
        loginBtn.textContent = __auth.loggingIn;

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
                setError(loginError, data.message || __auth.wrongCredentials);
                loginPassword.value = '';
                loginPassword.focus();
            }
        } catch (err) {
            console.error('Error:', err);
            setError(loginError, __auth.networkError);
        } finally {
            loginBtn.disabled = false;
            loginBtn.textContent = __auth.login;
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
                setError(resetCodeError, data.message || __auth.sendResetCodeError);
            }
        } catch (err) {
            console.error('Error:', err);
            setError(resetCodeError, __auth.networkError);
        }
    });

    // تأیید کد بازیابی
    verifyResetBtn.addEventListener('click', async function() {
        const code = resetCodeInput.value.trim();
        if (!/^\d{4}$/.test(code)) {
            setError(resetCodeError, __auth.codeRequired);
            resetCodeInput.focus();
            return;
        }
        clearError(resetCodeError);
        verifyResetBtn.disabled = true;
        verifyResetBtn.textContent = __auth.checking;

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
                setError(resetCodeError, data.message || __auth.invalidCode);
                resetCodeInput.value = '';
                resetCodeInput.focus();
            }
        } catch (err) {
            console.error('Error:', err);
            setError(resetCodeError, __auth.networkError);
        } finally {
            verifyResetBtn.disabled = false;
            verifyResetBtn.textContent = __auth.verifyCode;
        }
    });

    // ثبت رمز عبور جدید
    setNewPasswordBtn.addEventListener('click', async function() {
        const pwd = newPassword.value;
        const pwdConf = newPasswordConfirm.value;
        
        if (!pwd || !pwdConf) {
            setError(newPasswordError, __auth.fillBothFields);
            if (!pwd) newPassword.focus();
            else newPasswordConfirm.focus();
            return;
        }
        if (pwd.length < 6) {
            setError(newPasswordError, __auth.passwordMin);
            newPassword.focus();
            return;
        }
        if (pwd !== pwdConf) {
            setError(newPasswordError, __auth.passwordMismatch);
            newPasswordConfirm.focus();
            return;
        }
        
        clearError(newPasswordError);
        setNewPasswordBtn.disabled = true;
        setNewPasswordBtn.textContent = __auth.saving;

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
                setError(newPasswordError, data.message || __auth.passwordChangeError);
            }
        } catch (err) {
            console.error('Error:', err);
            setError(newPasswordError, __auth.networkError);
        } finally {
            setNewPasswordBtn.disabled = false;
            setNewPasswordBtn.textContent = __auth.setPassword;
        }
    });

    // فوکوس خودکار روی اولین فیلد هنگام لود صفحه
    phoneInput.focus();
});
</script>
@endpush