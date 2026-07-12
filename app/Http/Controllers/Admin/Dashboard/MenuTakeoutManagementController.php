<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuTakeout;
use App\Models\MenuTakeoutCategory;
use App\Http\Requests\Admin\StoreTakeoutMenuItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuTakeoutManagementController extends Controller
{
    public function index()
    {
        $menuItems = MenuTakeout::with('category')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.takeout.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = MenuTakeoutCategory::all();

        $defaultName = ['fa' => '', 'en' => '', 'ar' => ''];
        $defaultDesc = ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.takeout.create', [
            'categories'  => $categories,
            'name'        => $defaultName,
            'description' => $defaultDesc,
        ]);
    }

    public function store(StoreTakeoutMenuItemRequest $request)
    {
        $validated = $request->validated();

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

        // مدیریت آپلود چند تصویر
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('takeout-images', 'public');
            }
        }
        $validated['images'] = $imagePaths;

        MenuTakeout::create($validated);

        return redirect()
            ->route('admin.takeout.index')
            ->with('success', 'آیتم منوی بیرون‌بر با موفقیت ایجاد شد');
    }

    public function edit(MenuTakeout $takeout)
    {
        $categories = MenuTakeoutCategory::all();

        $name = is_array($takeout->name) ? $takeout->name : ['fa' => '', 'en' => '', 'ar' => ''];
        $description = is_array($takeout->description) ? $takeout->description : ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.takeout.edit', compact('takeout', 'categories', 'name', 'description'));
    }

    public function update(StoreTakeoutMenuItemRequest $request, MenuTakeout $takeout)
    {
        $validated = $request->validated();

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

        // مدیریت تصاویر جدید
        if ($request->hasFile('images')) {
            // حذف تصاویر قبلی
            $takeout->deleteImagesFromStorage();

            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('takeout-images', 'public');
            }
            $validated['images'] = $imagePaths;
        } else {
            unset($validated['images']);
        }

        $takeout->update($validated);

        return redirect()
            ->route('admin.takeout.index')
            ->with('success', 'آیتم منوی بیرون‌بر با موفقیت بروزرسانی شد');
    }

    /**
     * حذف آیتم
     */
    public function destroy(MenuTakeout $takeout)
    {
        $takeout->deleteImagesFromStorage();
        $takeout->delete();

        return redirect()
            ->route('admin.takeout.index')
            ->with('success', 'آیتم منوی بیرون‌بر با موفقیت حذف شد');
    }

    /**
     * تغییر وضعیت فعال/غیرفعال
     */
    public function toggleActive(MenuTakeout $takeout)
    {
        $takeout->update([
            'is_active' => !$takeout->is_active
        ]);

        return response()->json([
            'success'   => true,
            'is_active' => $takeout->is_active,
        ]);
    }
}