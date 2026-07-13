<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuOrganizationalCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuOrganizationalCategoryController extends Controller
{
    /**
     * لیست تمام دسته‌بندی‌ها
     */
    public function index()
    {
        $categories = MenuOrganizationalCategory::withCount('organizationals')->get();
        return view('admin.organizational-categories.index', compact('categories'));
    }

    /**
     * فرم ایجاد دسته جدید
     */
    public function create()
    {
        return view('admin.organizational-categories.create');
    }

    /**
     * ذخیره دسته جدید
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', 'unique:menu_organizational_categories,name_fa'],
            'name_en' => ['required', 'string', 'max:255', 'unique:menu_organizational_categories,name_en'],
            'name_ar' => ['required', 'string', 'max:255', 'unique:menu_organizational_categories,name_ar'],
        ]);

        MenuOrganizationalCategory::create($validated);

        return redirect()
            ->route('admin.organizational-categories.index')
            ->with('success', 'دسته‌بندی جدید با موفقیت اضافه شد.');
    }

    /**
     * فرم ویرایش دسته‌بندی
     */
    public function edit(MenuOrganizationalCategory $organizationalCategory)
    {
        return view('admin.organizational-categories.edit', compact('organizationalCategory'));
    }

    /**
     * بروزرسانی دسته‌بندی
     */
    public function update(Request $request, MenuOrganizationalCategory $organizationalCategory)
    {
        $validated = $request->validate([
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('menu_organizational_categories')->ignore($organizationalCategory->id)],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('menu_organizational_categories')->ignore($organizationalCategory->id)],
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('menu_organizational_categories')->ignore($organizationalCategory->id)],
        ]);

        $organizationalCategory->update($validated);

        return redirect()
            ->route('admin.organizational-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy(MenuOrganizationalCategory $organizationalCategory)
    {
        $organizationalCategory->delete();

        return redirect()
            ->route('admin.organizational-categories.index')
            ->with('success', 'دسته‌بندی و تمام غذاهای مرتبط با آن حذف شدند.');
    }
}