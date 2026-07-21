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
        $spins = Spin::all();
        
        $displaySpins = $this->prepareSpinsForDisplay($spins);
        
        return view('admin.spin.index', compact('displaySpins'));
    }

    /**
     * نمایش فرم ویرایش جایزه
     */
    public function edit($spinId)
    {
        $spin = Spin::find($spinId);
        
        if (!$spin) {
            $spin = $this->createDefaultSpinData($spinId);
        }
        
        return view('admin.spin.edit', compact('spin'));
    }

    /**
     * بروزرسانی اطلاعات جایزه
     */
    public function update(Request $request, $spinId)
    {
        // اعتبارسنجی ساده‌تر
        $validated = $request->validate([
            'name'      => ['nullable', 'string', 'max:255'],
            'color'     => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        // پیدا کردن یا ایجاد جایزه
        $spin = Spin::find($spinId);
        
        if (!$spin) {
            $spin = new Spin();
            $spin->id = $spinId;
        }

        // تنظیم مقادیر
        $spin->name = $request->input('name', '');
        $spin->color = $request->input('color') ?: $this->getDefaultColor($spinId);
        $spin->is_active = $request->has('is_active') && $request->input('is_active') === 'on';
        
        // ذخیره جایزه
        $spin->save();

        // محاسبه مجدد درصدها
        $this->recalculateProbabilities();

        return redirect()->route('admin.spins.index')->with('success', 'جایزه با موفقیت بروزرسانی شد.');
    }

    /**
     * غیرفعال کردن متدهای create, store و destroy
     */
    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function destroy(Spin $spin)
    {
        abort(404);
    }

    /**
     * آماده‌سازی 10 جایزه برای نمایش
     */
    private function prepareSpinsForDisplay($existingSpins)
    {
        $displaySpins = [];
        
        for ($i = 1; $i <= 10; $i++) {
            $existingSpin = $existingSpins->where('id', $i)->first();
            
            if ($existingSpin) {
                $displaySpins[$i] = $existingSpin;
            } else {
                $displaySpins[$i] = $this->createDefaultSpinData($i);
            }
        }
        
        return $displaySpins;
    }

    /**
     * ایجاد داده‌های پیش‌فرض برای یک جایزه
     */
    private function createDefaultSpinData($id)
    {
        return (object)[
            'id'          => $id,
            'name'        => '',
            'color'       => $this->getDefaultColor($id),
            'probability' => 0,
            'is_active'   => false,
            'exists'      => false,
        ];
    }

    /**
     * دریافت رنگ پیش‌فرض بر اساس ID
     */
    private function getDefaultColor($id)
    {
        $defaultColors = [
            1  => '#FF6B6B', // قرمز
            2  => '#4ECDC4', // فیروزه‌ای
            3  => '#45B7D1', // آبی
            4  => '#96CEB4', // سبز
            5  => '#FFEAA7', // زرد
            6  => '#DDA0DD', // بنفش
            7  => '#FF8C42', // نارنجی
            8  => '#98D8C8', // سبز روشن
            9  => '#F7DC6F', // طلایی
            10 => '#BB8FCE', // بنفش روشن
        ];
        
        return $defaultColors[$id] ?? '#CCCCCC';
    }

    /**
     * محاسبه مجدد درصدهای شانس بر اساس جوایز فعال
     */
    private function recalculateProbabilities()
    {
        $activeSpins = Spin::where('is_active', true)->get();
        $activeCount = $activeSpins->count();
        
        if ($activeCount > 0) {
            // محاسبه درصد مساوی برای هر جایزه فعال
            $probability = round(100 / $activeCount, 2);
            
            // تنظیم درصد برای جوایز فعال
            foreach ($activeSpins as $spin) {
                $spin->probability = $probability;
                $spin->save();
            }
            
            // تنظیم درصد 0 برای جوایز غیرفعال
            Spin::where('is_active', false)->update(['probability' => 0]);
        }
    }
}