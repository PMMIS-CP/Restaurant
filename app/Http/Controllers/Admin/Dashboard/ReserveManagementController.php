<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveManagementController extends Controller
{
    /**
     * نمایش لیست تمام رزروهای ثبت‌شده
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
     * حذف رزرو
     */
    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('admin.reserves.index')
            ->with('success', 'رزرو با موفقیت حذف شد.');
    }
}