@extends('front.layouts.auth')
@section('meta_description', __('auth.login.meta_description'))

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
            {{-- بخش تأیید اولیه --}}
            <div id="reset-confirm-section">
                <p class="text-sm text-gray-600">{{ __('auth.login.reset_code_confirm_message') }}</p>
                <p class="text-sm font-medium text-gray-800 dir-ltr mt-2" id="reset-phone-display"></p>
                <button type="button" id="confirm-reset-btn"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition mt-4">
                    {{ __('auth.login.confirm_send_code') }}
                </button>
                <p id="reset-confirm-error" class="text-sm text-red-600 hidden mt-2"></p>
            </div>
            
            {{-- بخش ورود کد (مخفی در ابتدا) --}}
            <div id="reset-code-section" class="hidden space-y-4">
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
            </div>
            
            {{-- بخش رمز جدید (بدون تغییر) --}}
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
@endsection
@push('scripts')
<script>
window.AuthConfig={csrfToken:'{{ csrf_token() }}',routes:{checkPhone:'{{ route("check.phone") }}',validateRegistration:'{{ route("validate.registration") }}',sendOtp:'{{ route("send.otp") }}',verifyOtp:'{{ route("verify.otp") }}',loginPhone:'{{ route("login.phone") }}',verifyResetOtp:'{{ route("verify.reset.otp") }}',resetPasswordSms:'{{ route("reset.password.sms") }}'},translations:{invalidPhone:'{{ __("auth.login.js_invalid_phone") }}',checking:'{{ __("auth.login.js_checking") }}',serverError:'{{ __("auth.login.js_server_error") }}',continue:'{{ __("auth.login.js_continue") }}',nameFamilyRequired:'{{ __("auth.login.js_name_family_required") }}',passwordRequired:'{{ __("auth.login.js_password_required") }}',passwordMin:'{{ __("auth.login.js_password_min") }}',passwordMismatch:'{{ __("auth.login.js_password_mismatch") }}',invalidEmail:'{{ __("auth.login.js_invalid_email") }}',validating:'{{ __("auth.login.js_validating") }}',getCode:'{{ __("auth.login.js_get_code") }}',sendingCode:'{{ __("auth.login.js_sending_code") }}',codeSent:'{{ __("auth.login.js_code_sent") }}',wait:'{{ __("auth.login.js_wait") }}',sendCodeError:'{{ __("auth.login.js_send_code_error") }}',codeRequired:'{{ __("auth.login.js_code_required") }}',verifying:'{{ __("auth.login.js_verifying") }}',invalidCode:'{{ __("auth.login.js_invalid_code") }}',networkError:'{{ __("auth.login.js_network_error") }}',verifyRegister:'{{ __("auth.login.js_verify_register") }}',enterPassword:'{{ __("auth.login.js_enter_password") }}',loggingIn:'{{ __("auth.login.js_logging_in") }}',wrongCredentials:'{{ __("auth.login.js_wrong_credentials") }}',login:'{{ __("auth.login.js_login") }}',sendResetCodeError:'{{ __("auth.login.js_send_reset_code_error") }}',fillBothFields:'{{ __("auth.login.js_fill_both_fields") }}',saving:'{{ __("auth.login.js_saving") }}',passwordChangeError:'{{ __("auth.login.js_password_change_error") }}',setPassword:'{{ __("auth.login.js_set_password") }}',resendCode:'{{ __("auth.login.resend_code") }}',verifyCode:'{{ __("auth.login.verify_code") }}',invalidData:'{{ __("auth.login.js_invalid_data") }}',email:'{{ __("auth.login.js_email") }}',password:'{{ __("auth.login.js_password") }}',name:'{{ __("auth.login.js_name") }}',family:'{{ __("auth.login.js_family") }}',code:'{{ __("auth.login.js_code") }}',expired:'{{ __("auth.login.js_expired") }}'}};
</script>
@endpush