<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Spin;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    /**
     * نمایش لیست جوایز گردونه
     */
    public function index()
    {
        $spins = Spin::latest()->paginate(10);
        return view('admin.spin.index', compact('spins'));
    }

    /**
     * نمایش فرم ایجاد جایزه جدید
     */
    public function create()
    {
        return view('admin.spin.create');
    }

    /**
     * ذخیره جایزه جدید در دیتابیس
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'color'       => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'probability' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        // کنترل وضعیت فعال بودن (اگر چک‌باکس تیک نخورده باشد، false ارسال می‌شود)
        $validated['is_active'] = $request->has('is_active');

        Spin::create($validated);

        return redirect()->route('admin.spins.index')->with('success', 'جایزه با موفقیت ایجاد شد.');
    }

    /**
     * نمایش فرم ویرایش جایزه
     */
    public function edit(Spin $spin)
    {
        return view('admin.spin.edit', compact('spin'));
    }

    /**
     * بروزرسانی اطلاعات جایزه
     */
    public function update(Request $request, Spin $spin)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'color'       => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'probability' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $spin->update($validated);

        return redirect()->route('admin.spins.index')->with('success', 'جایزه با موفقیت بروزرسانی شد.');
    }

    /**
     * حذف جایزه از دیتابیس
     */
    public function destroy(Spin $spin)
    {
        $spin->delete();
        return redirect()->route('admin.spins.index')->with('success', 'جایزه با موفقیت حذف شد.');
    }
}