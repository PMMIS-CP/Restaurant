<?php

namespace App\Http\Controllers;

use App\Models\PhoneVerification;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SmsController extends Controller
{
    /**
     * ارسال کد تأیید به شماره موبایل
     */
    public function sendVerificationCode(Request $request)
    {
        try {
            $request->validate([
                'phone'        => 'required|regex:/^09[0-9]{9}$/',
                'name'         => 'sometimes|string|max:255',
                'family_name'  => 'sometimes|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'شماره موبایل نامعتبر است.',
            ], 422);
        }

        $phone = $request->input('phone');
        
        // API پنل پیامک شماره بدون صفر می‌خواهد
        $phoneForAPI = ltrim($phone, '0');

        // محدودیت ۶۰ ثانیه برای ارسال مجدد
        $recent = PhoneVerification::where('phone', $phone)
            ->where('created_at', '>=', Carbon::now()->subSeconds(60))
            ->exists();

        if ($recent) {
            return response()->json([
                'message' => 'لطفاً ۶۰ ثانیه دیگر مجدداً درخواست دهید.',
            ], 429);
        }

        // تولید کد ۴ رقمی
        $code = random_int(1000, 9999);

        // ذخیره در دیتابیس
        PhoneVerification::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes(2),
        ]);

        // ذخیره نام و نام‌خانوادگی برای ثبت‌نام
        if ($request->has('name') && $request->has('family_name')) {
            session([
                'register_name'   => $request->input('name'),
                'register_family' => $request->input('family_name'),
            ]);
        } else {
            session()->forget(['register_name', 'register_family']);
        }

        // متن پیامک
        $message = "رستوران سنتی کاخ موراکو\nکد ثبت‌نام/ورود شما:\n#{$code}\nلغو11";

        // ارسال پیامک
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
                    Log::info("پیامک با موفقیت به {$phone} ارسال شد. ID: {$data['Value']}");
                    
                    return response()->json([
                        'message'    => 'کد تأیید ارسال شد.',
                        'expires_at' => Carbon::now()->addMinutes(2)->toDateTimeString(),
                    ]);
                }
                
                // خطاهای مستند پنل
                $errorMessages = [
                    0 => 'نام کاربری یا رمز عبور اشتباه است.',
                    2 => 'اعتبار کافی نیست.',
                    4 => 'محدودیت در حجم ارسال.',
                    5 => 'شماره فرستنده معتبر نیست.',
                    7 => 'متن حاوی کلمات فیلتر شده است.',
                    9 => 'ارسال از خطوط عمومی امکان‌پذیر نیست.',
                    14 => 'متن حاوی لینک است.',
                    15 => 'عدم وجود لغو11 در انتهای پیامک.',
                ];
                
                $errorCode = $data['RetStatus'] ?? 'نامشخص';
                $errorMsg = $errorMessages[$errorCode] ?? "خطای {$errorCode}";
                
                Log::error("خطا در ارسال پیامک: {$errorMsg}", $data);
                
                return response()->json([
                    'message' => $errorMsg,
                ], 500);
            }
            
            Log::error('خطای HTTP از API پیامک', ['status' => $response->status()]);
            
            return response()->json([
                'message' => 'خطا در ارتباط با سرور پیامک.',
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('خطای ارسال پیامک: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'خطا در ارسال پیامک. لطفاً دوباره تلاش کنید.',
            ], 500);
        }
    }

    /**
     * تأیید کد و ورود کاربر
     */
    public function verifyCode(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'code'  => 'required|digits:4',
        ]);

        $phone = $request->input('phone');
        $code  = $request->input('code');

        // جستجوی کد معتبر
        $verification = PhoneVerification::where('phone', $phone)
            ->where('code', $code)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$verification) {
            return back()->withErrors([
                'code' => 'کد وارد شده نامعتبر یا منقضی شده است.',
            ])->withInput();
        }

        // علامت‌گذاری به عنوان استفاده‌شده
        $verification->update(['used' => true]);

        // یافتن یا ایجاد کاربر
        $user = User::where('phone', $phone)->first();

        if (!$user) {
            // دریافت نام از session (برای ثبت‌نام)
            $name   = session('register_name', 'کاربر');
            $family = session('register_family', '');
            $fullName = trim($name . ' ' . $family) ?: 'کاربر ' . $phone;
            
            session()->forget(['register_name', 'register_family']);

            $user = User::create([
                'name'              => $fullName,
                'phone'             => $phone,
                'phone_verified_at' => now(),
            ]);
        } else {
            if (!$user->phone_verified_at) {
                $user->update(['phone_verified_at' => now()]);
            }
        }

        // احراز هویت
        Auth::login($user);

        // بازسازی session
        $request->session()->regenerate();

        // ریدایرکت به مسیر مورد نظر
        $redirect = redirect()->intended(route('dashboard', absolute: false));

        // ادغام سبد خرید مهمان
        if ($request->hasCookie('cart_session_id')) {
            try {
                $cartService = app(CartService::class);
                $cartService->mergeGuestCart(
                    $request->cookie('cart_session_id'),
                    auth()->id()
                );
                $redirect->withoutCookie('cart_session_id');
            } catch (\Exception $e) {
                report($e);
            }
        }

        return $redirect;
    }
}