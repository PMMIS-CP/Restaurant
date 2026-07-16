<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ReserveController extends Controller
{
    public function index()
    {
        return view('front.pages.reserve', [
            'hideHeader' => true,
            'hideFooter' => false,
        ]);
    }

    public function store(Request $request)
    {
        Log::info('Reserve store called', $request->all());

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'event_type'       => 'nullable|string|max:255',
            'guest_count'      => 'nullable|string|max:50',
            'reservation_date' => 'required|string|max:20',
            'entry_time'       => 'required|string|max:5',
            'exit_time'        => 'required|string|max:5',
            'description'      => 'nullable|string|max:2000',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();

            if (empty($validated['email'])) {
                $validated['email'] = auth()->user()->email;
            }
        }

        Log::info('Validated data:', $validated);

        $reserve = Reserve::create($validated + ['status' => 'pending']);

        Log::info('Reserve created:', ['id' => $reserve->id]);

        return response()->json([
            'success' => true,
            'message' => 'درخواست رزرو با موفقیت ثبت شد.'
        ]);
    }

    /**
     * ارسال کد تأیید برای رزرو
     */
    public function sendOtp(Request $request)
    {
        // اعتبارسنجی کامل اطلاعات فرم
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'required|regex:/^09[0-9]{9}$/',
            'email'            => 'nullable|email|max:255',
            'event_type'       => 'nullable|string|max:255',
            'guest_count'      => 'nullable|string|max:50',
            'reservation_date' => 'required|string|max:20',
            'entry_time'       => 'required|string|max:5',
            'exit_time'        => 'required|string|max:5',
            'description'      => 'nullable|string|max:2000',
        ]);

        $phone = $validated['phone'];

        // محدودیت ۶۰ ثانیه بین هر درخواست
        $recent = PhoneVerification::where('phone', $phone)
            ->where('created_at', '>=', Carbon::now()->subSeconds(60))
            ->exists();
        if ($recent) {
            return response()->json([
                'message' => 'لطفاً ۶۰ ثانیه دیگر مجدداً درخواست دهید.'
            ], 429);
        }

        // تولید کد ۴ رقمی
        $code = random_int(1000, 9999);
        PhoneVerification::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes(2),
        ]);

        // ذخیره اطلاعات رزرو در session
        session(['reserve_data' => $validated]);

        // ارسال پیامک (همانند SmsController)
        $phoneForAPI = ltrim($phone, '0');
        $message = "کاخ موراکو\nکد تأیید رزرو: {$code}\nلغو11";
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
                    Log::info("OTP رزرو به {$phone} ارسال شد.");
                    return response()->json(['message' => 'کد تأیید به شماره شما ارسال شد.']);
                }
                // مدیریت خطاهای پنل
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
     * تأیید کد و ثبت رزرو
     */
    public function verifyOtp(Request $request)
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
            return response()->json(['message' => 'کد نامعتبر یا منقضی شده است.'], 422);
        }

        $verification->update(['used' => true]);

        // بازیابی اطلاعات رزرو از session
        $reserveData = session('reserve_data');
        if (!$reserveData) {
            return response()->json(['message' => 'اطلاعات رزرو یافت نشد. لطفاً دوباره فرم را پر کنید.'], 400);
        }

        // ایجاد رزرو
        $reserve = Reserve::create($reserveData + ['status' => 'pending']);

        // پاک کردن session
        session()->forget('reserve_data');

        Log::info('رزرو با تأیید OTP ایجاد شد:', ['id' => $reserve->id]);

        return response()->json([
            'success' => true,
            'message' => 'درخواست رزرو با موفقیت ثبت شد.'
        ]);
    }

}