<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuOrganizational;
use App\Models\MenuTakeout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FoodModalController extends Controller
{
    /**
     * دریافت اطلاعات کامل یک آیتم منو برای نمایش در مودال
     */
    public function show(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:menu,organizational,takeout',
            'id'   => 'required|integer',
        ]);

        $item = $this->findItem($request->type, $request->id);

        if (!$item) {
            return response()->json(['message' => __('food-modal.item_not_found')], 404);
        }

        // تشخیص زبان فعلی
        $currentLocale = app()->getLocale();
        
        $images = $this->getItemImages($item);

        return response()->json([
            'id'          => $item->id,
            'name'        => $item->getNameInLocale($currentLocale),
            'price'       => (int) $item->price,
            'description' => $item->getDescriptionInLocale($currentLocale),
            'images'      => $images,
            'type'        => $request->type,
        ]);
    }

    /**
     * یافتن آیتم بر اساس نوع و شناسه
     */
    private function findItem(string $type, int $id): Menu|MenuOrganizational|MenuTakeout|null
    {
        return match ($type) {
            'menu'           => Menu::find($id),
            'organizational' => MenuOrganizational::find($id),
            'takeout'        => MenuTakeout::find($id),
            default          => null,
        };
    }

    /**
     * دریافت تصاویر آیتم
     * اگر آیتم تصویر نداشت، آرایه خالی برمی‌گردونه
     */
    private function getItemImages($item): array
    {
        if (empty($item->images) || !is_array($item->images)) {
            return [];
        }

        return collect($item->images)
            ->take(6)
            ->map(fn(string $path) => asset('storage/' . $path))
            ->values()
            ->toArray();
    }
}