<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuTakeoutCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuTakeoutCategoryController extends Controller
{
    /**
     * لیست تمام دسته‌بندی‌ها
     */
    public function index()
    {
        $categories = MenuTakeoutCategory::withCount('takeouts')->get();
        return view('admin.takeout-categories.index', compact('categories'));
    }

    /**
     * فرم ایجاد دسته جدید
     */
    public function create()
    {
        return view('admin.takeout-categories.create');
    }

    /**
     * ذخیره دسته جدید
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', 'unique:menu_takeout_categories,name_fa'],
            'name_en' => ['required', 'string', 'max:255', 'unique:menu_takeout_categories,name_en'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:menu_takeout_categories,name_ar'],
        ]);

        MenuTakeoutCategory::create($validated);

        return redirect()
            ->route('admin.takeout-categories.index')
            ->with('success', 'دسته‌بندی جدید با موفقیت اضافه شد.');
    }

    /**
     * فرم ویرایش دسته‌بندی
     */
    public function edit(MenuTakeoutCategory $takeoutCategory)
    {
        return view('admin.takeout-categories.edit', compact('takeoutCategory'));
    }

    /**
     * بروزرسانی دسته‌بندی
     */
    public function update(Request $request, MenuTakeoutCategory $takeoutCategory)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('menu_takeout_categories')->ignore($takeoutCategory->id)],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('menu_takeout_categories')->ignore($takeoutCategory->id)],
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('menu_takeout_categories')->ignore($takeoutCategory->id)],
        ]);

        $takeoutCategory->update($validated);

        return redirect()
            ->route('admin.takeout-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy(MenuTakeoutCategory $takeoutCategory)
    {
        $takeoutCategory->delete();

        return redirect()
            ->route('admin.takeout-categories.index')
            ->with('success', 'دسته‌بندی و تمام غذاهای مرتبط با آن حذف شدند.');
    }
}