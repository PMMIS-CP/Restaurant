<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MenuOrganizational;
use App\Models\MenuOrganizationalCategory;
use App\Http\Requests\Admin\StoreOrganizationalMenuItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuOrganizationalManagementController extends Controller
{
    public function index()
    {
        $menuItems = MenuOrganizational::with('category')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.organizational.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = MenuOrganizationalCategory::all();

        $defaultName = ['fa' => '', 'en' => '', 'ar' => ''];
        $defaultDesc = ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.organizational.create', [
            'categories'  => $categories,
            'name'        => $defaultName,
            'description' => $defaultDesc,
        ]);
    }

    public function store(StoreOrganizationalMenuItemRequest $request)
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
                $imagePaths[] = $file->store('organizational-images', 'public');
            }
        }
        $validated['images'] = $imagePaths;

        MenuOrganizational::create($validated);

        return redirect()
            ->route('admin.organizational.index')
            ->with('success', 'آیتم منوی سازمانی با موفقیت ایجاد شد');
    }

    public function edit(MenuOrganizational $organizational)
    {
        $categories = MenuOrganizationalCategory::all();

        $name = is_array($organizational->name) ? $organizational->name : ['fa' => '', 'en' => '', 'ar' => ''];
        $description = is_array($organizational->description) ? $organizational->description : ['fa' => '', 'en' => '', 'ar' => ''];

        return view('admin.organizational.edit', compact('organizational', 'categories', 'name', 'description'));
    }

    public function update(StoreOrganizationalMenuItemRequest $request, MenuOrganizational $organizational)
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
            $organizational->deleteImagesFromStorage();

            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('organizational-images', 'public');
            }
            $validated['images'] = $imagePaths;
        } else {
            unset($validated['images']);
        }

        $organizational->update($validated);

        return redirect()
            ->route('admin.organizational.index')
            ->with('success', 'آیتم منوی سازمانی با موفقیت بروزرسانی شد');
    }

    /**
     * حذف آیتم
     */
    public function destroy(MenuOrganizational $organizational)
    {
        $organizational->deleteImagesFromStorage();
        $organizational->delete();

        return redirect()
            ->route('admin.organizational.index')
            ->with('success', 'آیتم منوی سازمانی با موفقیت حذف شد');
    }

    /**
     * تغییر وضعیت فعال/غیرفعال
     */
    public function toggleActive(MenuOrganizational $organizational)
    {
        $organizational->update([
            'is_active' => !$organizational->is_active
        ]);

        return response()->json([
            'success'   => true,
            'is_active' => $organizational->is_active,
        ]);
    }
}