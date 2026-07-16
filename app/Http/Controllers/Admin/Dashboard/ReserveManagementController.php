<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;
use App\Http\Controllers\Front\ReserveController;

class ReserveManagementController extends Controller
{
    /**
     * نمایش لیست تمام رزروها
     */
    public function index()
    {
        $reserves = Reserve::latest()->paginate(15);
        return view('admin.reserves.index', compact('reserves'));
    }

    /**
     * نمایش جزئیات یک رزرو
     */
    public function show(Reserve $reserve)
    {
        return view('admin.reserves.show', compact('reserve'));
    }

    /**
     * نمایش فرم ویرایش رزرو (فقط در صورتی که تأیید نهایی نشده باشد)
     */
    public function edit(Reserve $reserve)
    {
        if ($reserve->status === 'confirmed') {
            return redirect()->route('admin.reserves.show', $reserve->id)
                ->with('error', 'امکان ویرایش رزرو تأیید شده وجود ندارد.');
        }

        return view('admin.reserves.edit', compact('reserve'));
    }

    /**
     * به‌روزرسانی اطلاعات رزرو (جزئیات)
     */
    public function update(Request $request, Reserve $reserve)
    {
        if ($reserve->status === 'confirmed') {
            return redirect()->route('admin.reserves.show', $reserve->id)
                ->with('error', 'امکان ویرایش رزرو تأیید شده وجود ندارد.');
        }

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

        $reserve->update($validated);

        return redirect()->route('admin.reserves.show', $reserve->id)
            ->with('success', 'اطلاعات رزرو با موفقیت به‌روزرسانی شد.');
    }

    /**
     * تغییر وضعیت رزرو (مثلاً تأیید نهایی)
     */
    public function updateStatus(Request $request, Reserve $reserve)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reserve->update(['status' => $validated['status']]);

        // اگر وضعیت به confirmed تغییر کرد، پیامک تأیید نهایی ارسال شود
        if ($validated['status'] === 'confirmed') {
            ReserveController::sendStatusSms($reserve);
        }

        return redirect()->route('admin.reserves.index')
            ->with('success', 'وضعیت رزرو با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف رزرو
     */
    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('admin.reserves.index')
            ->with('success', 'رزرو با موفقیت حذف شد.');
    }
}