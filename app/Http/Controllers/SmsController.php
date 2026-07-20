<?php

namespace App\Http\Controllers;

use App\Models\PhoneVerification;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SmsController extends Controller
{
    /**
     * بررسی وجود کاربر با شماره موبایل
     */
    public function checkPhone(Request $request)
    {
        $request->validate(['phone' => 'required|regex:/^09[0-9]{9}$/']);
        $exists = User::where('phone', $request->phone)->exists();
        return response()->json(['exists' => $exists]);
    }

    /**
     * اعتبارسنجی اطلاعات ثبت‌نام قبل از ارسال کد
     */
    public function validateRegistration(Request $request)
    {
        $validator = validator($request->all(), [
            'name'        => 'required|string|max:255',
            'family_name' => 'required|string|max:255',
            'email'       => 'nullable|email|max:255',
            'password'    => 'required|string|min:6|confirmed',
        ], [
            'name.required'         => 'نام الزامی است.',
            'family_name.required'  => 'نام خانوادگی الزامی است.',
            'email.email'           => 'فرمت ایمیل معتبر نیست.',
            'password.required'     => 'رمز عبور الزامی است.',
            'password.min'          => 'رمز عبور حداقل ۶ کاراکتر باشد.',
            'password.confirmed'    => 'رمز عبور و تکرار آن یکسان نیستند.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        // بررسی یکتایی ایمیل (اگر وارد شده باشد)
        if ($request->filled('email')) {
            $emailExists = User::where('email', $request->email)->exists();
            if ($emailExists) {
                return response()->json([
                    'message' => 'این ایمیل قبلاً ثبت شده است. لطفاً ایمیل دیگری وارد کنید.',
                    'errors' => ['email' => 'ایمیل تکراری']
                ], 422);
            }
        }

        return response()->json(['valid' => true]);
    }

    /**
     * ارسال کد تأیید (ثبت‌نام یا بازیابی رمز)
     */
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'phone'       => 'required|regex:/^09[0-9]{9}$/',
            'purpose'     => 'required|in:register,reset',
            // فیلدهای ثبت‌نام
            'name'        => 'required_if:purpose,register|string|max:255',
            'family_name' => 'required_if:purpose,register|string|max:255',
            'email'       => 'nullable|email|max:255',
            'password'    => 'required_if:purpose,register|string|min:6|confirmed',
        ]);

        $phone = $request->phone;
        $purpose = $request->purpose;

        // اعتبارسنجی اضافه برای ایمیل تکراری
        if ($purpose === 'register' && $request->filled('email')) {
            $emailExists = User::where('email', $request->email)->exists();
            if ($emailExists) {
                return response()->json([
                    'message' => 'این ایمیل قبلاً ثبت شده است. لطفاً ایمیل دیگری وارد کنید.'
                ], 422);
            }
        }

        // محدودیت ۶۰ ثانیه
        $recent = PhoneVerification::where('phone', $phone)
            ->where('created_at', '>=', Carbon::now()->subSeconds(60))
            ->exists();
        if ($recent) {
            return response()->json(['message' => 'لطفاً ۶۰ ثانیه دیگر مجدداً درخواست دهید.'], 429);
        }

        // تولید کد
        $code = random_int(1000, 9999);
        PhoneVerification::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes(2),
        ]);

        // ذخیره اطلاعات ثبت‌نام در session
        if ($purpose === 'register') {
            session([
                'register_name'     => $request->name,
                'register_family'   => $request->family_name,
                'register_email'    => $request->email,
                'register_password' => $request->password,
                'register_purpose'  => 'register'
            ]);
        } else {
            session(['register_purpose' => 'reset']);
            session()->forget(['register_name','register_family','register_email','register_password']);
        }

        // ارسال پیامک
        $phoneForAPI = ltrim($phone, '0');
        $message = "رستوران سنتی کاخ موراکو\nکد شما:\n#{$code}\nلغو11";
        try {
            $response = Http::timeout(10)->post(config('services.sms.api_url'), [
                'username' => config('services.sms.username'),
                'password' => config('services.sms.api_key'),
                'to'       => $phoneForAPI,
                'from'     => config('services.sms.from_number'),
                'text'     => $message,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (($data['RetStatus'] ?? null) == 1) {
                    Log::info("پیامک ارسال شد به {$phone}");
                    return response()->json(['message' => 'کد تأیید ارسال شد.']);
                }
                $errors = [
                    0 => 'نام کاربری یا رمز عبور اشتباه است.',
                    2 => 'اعتبار کافی نیست.',
                    4 => 'محدودیت در حجم ارسال.',
                    5 => 'شماره فرستنده معتبر نیست.',
                    7 => 'متن حاوی کلمات فیلتر شده است.',
                    9 => 'ارسال از خطوط عمومی امکان‌پذیر نیست.',
                    14 => 'متن حاوی لینک است.',
                    15 => 'عدم وجود لغو11 در انتهای پیامک.',
                ];
                $errCode = $data['RetStatus'] ?? 'نامشخص';
                $msg = $errors[$errCode] ?? "خطای {$errCode}";
                Log::error("خطای پنل پیامک: {$msg}", $data);
                return response()->json(['message' => $msg], 500);
            }
            Log::error('خطای HTTP از API پیامک', ['status' => $response->status()]);
            return response()->json(['message' => 'خطا در ارتباط با سرور پیامک.'], 500);
        } catch (\Exception $e) {
            Log::error('خطای ارسال پیامک: ' . $e->getMessage());
            return response()->json(['message' => 'خطا در ارسال پیامک.'], 500);
        }
    }

    /**
     * تأیید کد ثبت‌نام و ایجاد کاربر
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'code'  => 'required|digits:4',
        ]);

        $phone = $request->phone;
        $code  = $request->code;

        $verification = PhoneVerification::where('phone', $phone)
            ->where('code', $code)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json(['message' => 'کد نامعتبر یا منقضی شده است.'], 422);
        }

        $verification->update(['used' => true]);

        if (session('register_purpose') !== 'register') {
            return response()->json(['message' => 'درخواست نامعتبر.'], 400);
        }

        $name     = session('register_name', 'کاربر');
        $family   = session('register_family', '');
        $email    = session('register_email');
        $password = session('register_password');

        $fullName = trim($name . ' ' . $family) ?: 'کاربر ' . $phone;

        // بررسی نهایی ایمیل تکراری قبل از ایجاد کاربر
        if ($email && User::where('email', $email)->exists()) {
            return response()->json([
                'message' => 'این ایمیل در لحظه ثبت‌نام توسط کاربر دیگری ثبت شد. لطفاً ایمیل دیگری وارد کنید.'
            ], 422);
        }

        // ایجاد کاربر
        $user = User::create([
            'name'              => $fullName,
            'phone'             => $phone,
            'email'             => $email,
            'password'          => Hash::make($password),
            'phone_verified_at' => now(),
        ]);

        session()->forget(['register_name','register_family','register_email','register_password','register_purpose']);

        Auth::login($user);
        $request->session()->regenerate();

        $redirect = redirect()->intended(route('dashboard'))->getTargetUrl();

        if ($request->hasCookie('cart_session_id')) {
            try {
                $cartService = app(CartService::class);
                $cartService->mergeGuestCart($request->cookie('cart_session_id'), $user->id);
            } catch (\Exception $e) {
                report($e);
            }
        }

        return response()->json(['redirect' => $redirect]);
    }

    /**
     * بررسی صحت کد برای بازیابی رمز (بدون ورود کاربر)
     */
    public function verifyResetOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'code'  => 'required|digits:4',
        ]);

        $verification = PhoneVerification::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json(['message' => 'کد نامعتبر است.', 'valid' => false], 422);
        }

        return response()->json(['valid' => true]);
    }

    /**
     * ثبت رمز عبور جدید پس از بازیابی
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone'    => 'required|regex:/^09[0-9]{9}$/',
            'code'     => 'required|digits:4',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $verification = PhoneVerification::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json(['message' => 'کد نامعتبر یا منقضی شده است.'], 422);
        }

        $verification->update(['used' => true]);

        $user = User::where('phone', $request->phone)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        $redirect = redirect()->intended(route('dashboard'))->getTargetUrl();
        return response()->json(['redirect' => $redirect]);
    }
}