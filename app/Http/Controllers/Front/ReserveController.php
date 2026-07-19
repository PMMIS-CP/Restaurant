<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use App\Models\User;
use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReserveController extends Controller
{
    /**
     * نمایش صفحه رزرو
     */
    public function index()
    {
        return view('front.pages.reserve', [
            'hideHeader' => true,
            'hideFooter' => false,
        ]);
    }

    /**
     * بررسی وجود شماره موبایل در سیستم
     */
    public function checkPhone(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
        ]);

        $exists = User::where('phone', $request->phone)->exists();

        return response()->json([
            'exists' => $exists,
        ]);
    }

    /**
     * ثبت مستقیم رزرو برای کاربران لاگین (بدون نیاز به OTP)
     */
    public function directSubmit(Request $request): JsonResponse
    {
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

        // رزرو فقط برای کاربر لاگین
        if (!auth()->check()) {
            return response()->json([
                'message' => __('reserve.controller_messages.login_required_direct'),
            ], 403);
        }

        $validated['user_id'] = auth()->id();

        if (empty($validated['email'])) {
            $validated['email'] = auth()->user()->email;
        }

        $reserve = Reserve::create($validated + ['status' => 'pending']);

        Log::info('رزرو مستقیم ایجاد شد', ['id' => $reserve->id]);

        // ارسال پیامک وضعیت (pending)
        self::sendStatusSms($reserve);

        return response()->json([
            'success' => true,
            'message' => __('reserve.controller_messages.reservation_success'),
        ]);
    }

    /**
     * ثبت رزرو (endpoint قدیمی – در صورت نیاز نگه داشته شود)
     */
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

        // ارسال پیامک وضعیت
        self::sendStatusSms($reserve);

        return response()->json([
            'success' => true,
            'message' => __('reserve.controller_messages.reservation_success'),
        ]);
    }

    /**
     * ارسال کد تأیید برای رزرو (پشتیبانی از سناریوهای لاگین خودکار و لینک دو اکانت)
     */
    public function sendOtp(Request $request): JsonResponse
    {
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
            // پارامترهای جدید
            'auto_login'       => 'sometimes|boolean',
            'link_to_both'     => 'sometimes|boolean',
            'logged_in_user_id' => 'sometimes|integer|exists:users,id',
        ]);

        $phone = $validated['phone'];

        // محدودیت ۶۰ ثانیه
        $recent = PhoneVerification::where('phone', $phone)
            ->where('created_at', '>=', Carbon::now()->subSeconds(60))
            ->exists();

        if ($recent) {
            return response()->json([
                'message' => __('reserve.controller_messages.otp_wait_60_seconds'),
            ], 429);
        }

        // تولید کد ۴ رقمی
        $code = random_int(1000, 9999);
        PhoneVerification::create([
            'phone'      => $phone,
            'code'       => $code,
            'expires_at' => Carbon::now()->addMinutes(2),
        ]);

        // ذخیره اطلاعات رزرو + گزینه‌های اضافه در سشن
        session([
            'reserve_data'    => $validated,
            'reserve_options' => [
                'auto_login'       => $request->boolean('auto_login'),
                'link_to_both'     => $request->boolean('link_to_both'),
                'logged_in_user_id' => $request->input('logged_in_user_id'),
            ],
        ]);

        // ارسال پیامک
        $phoneForAPI = ltrim($phone, '0');
        $message = __('reserve.controller_messages.otp_sms_template', ['code' => $code]);

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
                    return response()->json(['message' => __('reserve.controller_messages.otp_sent')]);
                }

                $errors = [
                    0  => __('reserve.controller_messages.sms_error_0'),
                    2  => __('reserve.controller_messages.sms_error_2'),
                    4  => __('reserve.controller_messages.sms_error_4'),
                    5  => __('reserve.controller_messages.sms_error_5'),
                    7  => __('reserve.controller_messages.sms_error_7'),
                    9  => __('reserve.controller_messages.sms_error_9'),
                    14 => __('reserve.controller_messages.sms_error_14'),
                    15 => __('reserve.controller_messages.sms_error_15'),
                ];

                $errCode = $data['RetStatus'] ?? __('reserve.controller_messages.unknown_code');
                $msg     = $errors[$errCode] ?? __('reserve.controller_messages.sms_error_unknown', ['code' => $errCode]);
                Log::error("خطای پنل پیامک: {$msg}", $data);

                return response()->json(['message' => $msg], 500);
            }

            Log::error('خطای HTTP از API پیامک', ['status' => $response->status()]);

            return response()->json(['message' => __('reserve.controller_messages.sms_connection_error')], 500);
        } catch (\Exception $e) {
            Log::error('خطای ارسال پیامک: ' . $e->getMessage());

            return response()->json(['message' => __('reserve.controller_messages.sms_send_error')], 500);
        }
    }

    /**
     * تأیید کد OTP و ثبت رزرو (با پشتیبانی از لاگین خودکار و لینک دو اکانت)
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'phone'             => 'required|regex:/^09[0-9]{9}$/',
            'code'              => 'required|digits:4',
            'auto_login'        => 'sometimes|boolean',
            'link_to_both'      => 'sometimes|boolean',
            'logged_in_user_id' => 'sometimes|integer|exists:users,id',
        ]);

        // بررسی کد
        $verification = PhoneVerification::where('phone', $request->phone)
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if (!$verification) {
            return response()->json(['message' => __('reserve.controller_messages.invalid_or_expired_code')], 422);
        }

        $verification->update(['used' => true]);

        // بازیابی اطلاعات از سشن
        $reserveData = session('reserve_data');
        $options     = session('reserve_options', []);

        if (!$reserveData) {
            return response()->json(['message' => __('reserve.controller_messages.reserve_data_not_found')], 400);
        }

        // حذف فیلدهای اضافه از دیتای رزرو
        unset(
            $reserveData['auto_login'],
            $reserveData['link_to_both'],
            $reserveData['logged_in_user_id']
        );

        $basePayload = $reserveData + ['status' => 'pending'];

        $shouldAutoLogin = $request->boolean('auto_login', $options['auto_login'] ?? false);
        $linkToBoth      = $request->boolean('link_to_both', $options['link_to_both'] ?? false);
        $loggedInUserId  = $request->input('logged_in_user_id', $options['logged_in_user_id'] ?? null);

        // سناریوی لاگین خودکار (کاربر مهمان با شماره موجود)
        if ($shouldAutoLogin) {
            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                Auth::login($user);
                $request->session()->regenerate();
                $basePayload['user_id'] = $user->id;
                Log::info("کاربر با شماره {$request->phone} به‌طور خودکار وارد شد.");
            } else {
                // این حالت نباید رخ دهد چون قبلاً وجود شماره بررسی شده
                return response()->json(['message' => __('reserve.controller_messages.user_not_found_with_phone')], 404);
            }
        }
        // سناریوی لینک کردن دو اکانت (کاربر لاگین + شماره متعلق به کاربر دیگر)
        elseif ($linkToBoth && $loggedInUserId) {
            $otherUser = User::where('phone', $request->phone)->first();

            if (!$otherUser) {
                return response()->json(['message' => __('reserve.controller_messages.target_user_not_found')], 404);
            }

            // ایجاد دو رزرو جداگانه برای هر دو کاربر
            $reserveA = Reserve::create($basePayload + ['user_id' => $loggedInUserId]);
            $reserveB = Reserve::create($basePayload + ['user_id' => $otherUser->id]);

            session()->forget(['reserve_data', 'reserve_options']);

            Log::info('رزرو برای هر دو کاربر ایجاد شد.', [
                'user_a' => $loggedInUserId,
                'user_b' => $otherUser->id,
            ]);

            // ارسال پیامک وضعیت برای هر دو رزرو
            self::sendStatusSms($reserveA);
            self::sendStatusSms($reserveB);

            return response()->json([
                'success' => true,
                'message' => __('reserve.controller_messages.reservation_success_linked'),
            ]);
        }
        // سناریوی کاربر لاگین شده که شماره خودش را زده (یا سایر موارد)
        else {
            if (auth()->check()) {
                $basePayload['user_id'] = auth()->id();
                if (empty($basePayload['email'])) {
                    $basePayload['email'] = auth()->user()->email;
                }
            } elseif ($loggedInUserId) {
                $basePayload['user_id'] = $loggedInUserId;
            }
        }

        // ایجاد رزرو برای سناریوهای غیر از link_to_both
        $reserve = Reserve::create($basePayload);

        session()->forget(['reserve_data', 'reserve_options']);

        Log::info('رزرو با تأیید OTP ایجاد شد.', ['id' => $reserve->id]);

        // ارسال پیامک وضعیت
        self::sendStatusSms($reserve);

        return response()->json([
            'success' => true,
            'message' => __('reserve.controller_messages.reservation_success'),
        ]);
    }

    /**
     * ارسال پیامک اطلاع‌رسانی وضعیت رزرو
     * (هم برای وضعیت pending و هم confirmed)
     *
     * این متد public static تعریف شده تا از پنل ادمین نیز فراخوانی شود.
     */
    public static function sendStatusSms(Reserve $reserve): void
    {
        // شماره حساب کاربری (در صورت وجود)
        $accountPhone = null;
        if ($reserve->user_id) {
            $user = User::find($reserve->user_id);
            if ($user && !empty($user->phone)) {
                $accountPhone = $user->phone;
            }
        }

        // شماره درج‌شده در خود رزرو
        $reservationPhone = $reserve->phone;

        // یکتاسازی شماره‌ها
        $phones = array_values(array_unique(array_filter([$accountPhone, $reservationPhone])));

        if (empty($phones)) {
            Log::warning('هیچ شماره‌ای برای ارسال پیامک وضعیت یافت نشد.', ['reserve_id' => $reserve->id]);
            return;
        }

        // لینک پیگیری (همیشه /dashboard)
        $trackingUrl = url('/dashboard');

        // تعیین متن متناسب با وضعیت
        $statusText = match ($reserve->status) {
            'pending'   => __('reserve.controller_messages.status_pending'),
            'confirmed' => __('reserve.controller_messages.status_confirmed'),
            default     => __('reserve.controller_messages.status_other', ['status' => $reserve->status]),
        };

        // ساخت پیام نهایی
        $message = __('reserve.controller_messages.sms_reservation_registered', [
            'name'        => $reserve->name,
            'date'        => $reserve->reservation_date,
            'entry_time'  => $reserve->entry_time,
            'exit_time'   => $reserve->exit_time,
            'status_text' => $statusText,
        ]);

        // ارسال به هر شماره
        foreach ($phones as $phone) {
            $phoneForAPI = ltrim($phone, '0');

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
                        Log::info("پیامک وضعیت رزرو به {$phone} ارسال شد.", ['reserve_id' => $reserve->id, 'status' => $reserve->status]);
                    } else {
                        Log::error("خطای پنل پیامک برای شماره {$phone}", [
                            'reserve_id' => $reserve->id,
                            'response'   => $data,
                        ]);
                    }
                } else {
                    Log::error("خطای HTTP در ارسال پیامک وضعیت به {$phone}", [
                        'reserve_id' => $reserve->id,
                        'status'     => $response->status(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("استثناء در ارسال پیامک وضعیت به {$phone}: " . $e->getMessage(), [
                    'reserve_id' => $reserve->id,
                ]);
            }
        }
    }
}