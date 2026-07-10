<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Requests\Admin\StoreMenuItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuManagementController extends Controller
{
    /**
     * Display a listing of menu items.
     */
    public function index()
    {
        $menuItems = Menu::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.menu.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created menu item.
     */
    public function store(StoreMenuItemRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('menu-images', 'public');
        }

        Menu::create($data);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت ایجاد شد');
    }

    /**
     * Show the form for editing a menu item.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified menu item.
     */
    public function update(StoreMenuItemRequest $request, Menu $menu)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')
                ->store('menu-images', 'public');
        }

        $menu->update($data);

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified menu item.
     */
    public function destroy(Menu $menu)
    {
        // Delete image
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()
            ->route('admin.menu.index')
            ->with('success', 'آیتم منو با موفقیت حذف شد');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Menu $menu)
    {
        $menu->update([
            'is_active' => !$menu->is_active
        ]);

        return response()->json([
            'success' => true,
            'is_active' => $menu->is_active,
        ]);
    }
}