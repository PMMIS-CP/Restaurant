<?php
// app/Http/Controllers/Admin/Dashboard/MenuCategoryController.php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    /**
     * لیست تمام دسته‌بندی‌ها
     */
    public function index()
    {
        $categories = MenuCategory::withCount('menus')->get();
        return view('admin.menu-categories.index', compact('categories'));
    }

    /**
     * فرم ایجاد دسته جدید
     */
    public function create()
    {
        return view('admin.menu-categories.create');
    }

    /**
     * ذخیره دسته جدید
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', 'unique:menu_categories,name_fa'],
            'name_en' => ['required', 'string', 'max:255', 'unique:menu_categories,name_en'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:menu_categories,name_ar'],
        ]);

        MenuCategory::create($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'دسته‌بندی جدید با موفقیت اضافه شد.');
    }

    /**
     * فرم ویرایش دسته‌بندی
     */
    public function edit(MenuCategory $menuCategory)
    {
        return view('admin.menu-categories.edit', compact('menuCategory'));
    }

    /**
     * بروزرسانی دسته‌بندی
     */
    public function update(Request $request, MenuCategory $menuCategory)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', 'unique:menu_categories,name_fa,' . $menuCategory->id],
            'name_en' => ['required', 'string', 'max:255', 'unique:menu_categories,name_en,' . $menuCategory->id],
            'name_ar' => ['required', 'string', 'max:255', 'unique:menu_categories,name_ar,' . $menuCategory->id],
        ]);

        $menuCategory->update($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته‌بندی (با هشدار در view)
     * تمام غذاهای مربوطه به‌دلیل cascadeOnDelete حذف می‌شوند
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete();

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'دسته‌بندی و تمام غذاهای مرتبط با آن حذف شدند.');
    }
}