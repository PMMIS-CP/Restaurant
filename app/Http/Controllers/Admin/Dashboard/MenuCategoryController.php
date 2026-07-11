<?php
// app/Http/Controllers/Admin/Dashboard/MenuCategoryController.php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            'image'   => [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,webp,gif,bmp,tiff,heic,heif',
                'max:20480', // 20MB
                function ($attribute, $value, $fail) {
                    // بررسی ابعاد تصویر فقط برای فرمت‌هایی که PHP می‌تواند بخواند
                    $supported = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/tiff'];
                    if (in_array($value->getMimeType(), $supported)) {
                        $dimensions = getimagesize($value->path());
                        if ($dimensions) {
                            $width  = $dimensions[0];
                            $height = $dimensions[1];
                            if ($width !== $height) {
                                $fail('ابعاد تصویر باید 1:1 (مربع) باشد.');
                            }
                            if ($width > 1024 || $height > 1024) {
                                $fail('حداکثر ابعاد مجاز 1024×1024 پیکسل است.');
                            }
                        }
                    }
                    // برای HEIC/HEIF ابعاد چک نمی‌شود (وابسته به اعتبارسنجی سمت کلاینت)
                },
            ],
        ], [
            'image.mimes' => 'فرمت فایل مجاز نیست. فرمت‌های پشتیبانی‌شده: JPEG, PNG, WebP, GIF, BMP, TIFF, HEIC, HEIF',
            'image.max'   => 'حجم تصویر نباید بیشتر از 20 مگابایت باشد.',
        ]);

        // ذخیره عکس در صورت آپلود
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

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
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('menu_categories')->ignore($menuCategory->id)],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('menu_categories')->ignore($menuCategory->id)],
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('menu_categories')->ignore($menuCategory->id)],
            'image'   => [
                'nullable',
                'file',
                'mimes:jpeg,png,jpg,webp,gif,bmp,tiff,heic,heif',
                'max:20480', // 20MB
                function ($attribute, $value, $fail) {
                    // بررسی ابعاد تصویر فقط برای فرمت‌هایی که PHP می‌تواند بخواند
                    $supported = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/tiff'];
                    if (in_array($value->getMimeType(), $supported)) {
                        $dimensions = getimagesize($value->path());
                        if ($dimensions) {
                            $width  = $dimensions[0];
                            $height = $dimensions[1];
                            if ($width !== $height) {
                                $fail('ابعاد تصویر باید 1:1 (مربع) باشد.');
                            }
                            if ($width > 1024 || $height > 1024) {
                                $fail('حداکثر ابعاد مجاز 1024×1024 پیکسل است.');
                            }
                        }
                    }
                    // برای HEIC/HEIF ابعاد چک نمی‌شود (وابسته به اعتبارسنجی سمت کلاینت)
                },
            ],
            'remove_image' => ['nullable', 'in:1'],
        ], [
            'image.mimes' => 'فرمت فایل مجاز نیست. فرمت‌های پشتیبانی‌شده: JPEG, PNG, WebP, GIF, BMP, TIFF, HEIC, HEIF',
            'image.max'   => 'حجم تصویر نباید بیشتر از 20 مگابایت باشد.',
        ]);

        // 1. مدیریت درخواست حذف تصویر فعلی
        if ($request->has('remove_image') && $request->remove_image == '1') {
            $menuCategory->deleteImage();
            // فقط در صورتی که فایل جدیدی آپلود نشده باشد، همینجا کار تمام است
            if (!$request->hasFile('image')) {
                return redirect()
                    ->route('admin.menu-categories.index')
                    ->with('success', 'تصویر دسته‌بندی با موفقیت حذف شد.');
            }
        }

        // 2. مدیریت آپلود عکس جدید
        if ($request->hasFile('image')) {
            // حذف عکس قبلی (اگر با remove_image حذف نشده باشد، دوباره حذف می‌کنیم - deleteImage چک می‌کند اگر وجود داشت)
            if ($menuCategory->image) {
                $menuCategory->deleteImage();
            }
            
            // ذخیره عکس جدید
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        // 3. حذف remove_image از آرایه validated (چون ستون دیتابیس نیست)
        unset($validated['remove_image']);

        // 4. بروزرسانی دسته‌بندی
        $menuCategory->update($validated);

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy(MenuCategory $menuCategory)
    {
        $menuCategory->delete(); // حذف عکس به‌صورت خودکار در boot مدل انجام می‌شود

        return redirect()
            ->route('admin.menu-categories.index')
            ->with('success', 'دسته‌بندی و تمام غذاهای مرتبط با آن حذف شدند.');
    }
}