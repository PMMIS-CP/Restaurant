<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('=== Dashboard Debug Start ===');
        Log::info('User ID: ' . auth()->id());

        // دریافت همه رزروهای کاربر (به جز کنسل‌شده) - بدون هیچ فیلتر زمانی
        $upcomingReservations = Reserve::where('user_id', auth()->id())
            ->where('status', '!=', 'cancelled')
            ->orderBy('id', 'desc')  // جدیدترین‌ها اول
            ->get();

        Log::info('Reserves found: ' . $upcomingReservations->count());

        foreach ($upcomingReservations as $r) {
            Log::info("Reserve #{$r->id} | Date: {$r->reservation_date} | Status: {$r->status}");
        }

        // تعداد کل رزروهای غیر کنسل شده
        $activeReservationsCount = $upcomingReservations->count();

        // تعداد رزروهای امروز را بر اساس تاریخ شمسی (به صورت رشته) حساب می‌کنیم
        // اینجا فقط برای نمایش آماده‌ست، منطقش دست شماست
        $todayReservationsCount = 0; // می‌توانید بعداً منطق خودتان را اضافه کنید

        Log::info('Active count: ' . $activeReservationsCount);
        Log::info('=== Dashboard Debug End ===');

        return view('front.user.dashboard', [
            'hideHeader'            => true,
            'hideFooter'            => true,
            'upcomingReservations'  => $upcomingReservations,
            'todayReservationsCount'=> $todayReservationsCount,
            'activeReservationsCount'=> $activeReservationsCount,
        ]);
    }
}