<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuManagementController extends Controller
{
    public function index()
    {
        $menuItems = Menu::with('category')  // eager load category
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.menu.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = MenuCategory::all(); // دریافت تمام دسته‌بندی‌ها

        $defaultName = ['fa' => '', 'en' => '', 'ar' => ''];
        $defaultDesc = ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.menu.create', [
            'categories'  => $categories,
            'name'        => $defaultName,
            'description' => $defaultDesc,
        ]);
    }

    public function store(StoreMenuItemRequest $request)
    {
        $validated = $request->validated();
        unset($validated['at_least_one_name']);

        // ادغام فیلدهای زبان
        $validated['name'] = [
            'fa' => $validated['name_fa'] ?? '',
            'en' => $validated['name_en'] ?? '',
            'ar' => $validated['name_ar'] ?? '',
        ];
        $validated['description'] = [
            'fa' => $validated['description_fa'] ?? '',
            'en' => $validated['description_en'] ?? '',
            'ar' => $validated['description_ar'] ?? '',
        ];

        unset(
            $validated['name_fa'], $validated['name_en'], $validated['name_ar'],
            $validated['description_fa'], $validated['description_en'], $validated['description_ar']
        );

        // مدیریت تصویر
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('menu-images', 'public');
        }

        Menu::create($validated);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت ایجاد شد');
    }

    public function edit(Menu $menu)
    {
        $categories = MenuCategory::all();

        $name = is_array($menu->name) ? $menu->name : ['fa' => '', 'en' => '', 'ar' => ''];
        $description = is_array($menu->description) ? $menu->description : ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.menu.edit', compact('menu', 'categories', 'name', 'description'));
    }

    public function update(StoreMenuItemRequest $request, Menu $menu)
    {
        $validated = $request->validated();
        unset($validated['at_least_one_name']);

        $validated['name'] = [
            'fa' => $validated['name_fa'] ?? '',
            'en' => $validated['name_en'] ?? '',
            'ar' => $validated['name_ar'] ?? '',
        ];
        $validated['description'] = [
            'fa' => $validated['description_fa'] ?? '',
            'en' => $validated['description_en'] ?? '',
            'ar' => $validated['description_ar'] ?? '',
        ];

        unset(
            $validated['name_fa'], $validated['name_en'], $validated['name_ar'],
            $validated['description_fa'], $validated['description_en'], $validated['description_ar']
        );

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')
                ->store('menu-images', 'public');
        }

        $menu->update($validated);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت بروزرسانی شد');
    }

    /**
     * حذف آیتم
     */
    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت حذف شد');
    }

    /**
     * تغییر وضعیت فعال/غیرفعال
     */
    public function toggleActive(Menu $menu)
    {
        $menu->update([
            'is_active' => !$menu->is_active
        ]);

        return response()->json([
            'success'   => true,
            'is_active' => $menu->is_active,
        ]);
    }
}