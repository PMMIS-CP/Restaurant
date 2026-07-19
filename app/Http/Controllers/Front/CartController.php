<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * دریافت یا ساخت سبد جاری
     */
    private function getOrCreateCart(): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = request()->cookie('cart_session_id');

        if (!$sessionId) {
            $sessionId = (string) Str::uuid();
        }

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    /**
     * نمایش سبد خرید
     */
    public function index(Request $request)
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        // فقط صفحه Blade، بدون هیچ JSON
        $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        return view('front.pages.cart-page', [
            'cart'  => $cart,
            'total' => $total,
            'count' => $cart->items->sum('quantity'),
            'hideHeader' => true,
            'hideFooter' => true,
        ]);
    }

    /**
     * API: دریافت اطلاعات سبد خرید
     */
    public function data(Request $request)
    {
        $cart = $this->getOrCreateCart();
        $cart->load('items.product');

        $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        $response = response()->json([
            'cart_id' => $cart->id,
            'items'   => $cart->items->map(function ($item) {
                $product = $item->product;
                $imageUrl = null;
                if ($product) {
                    $urls = $product->getImagesUrls();
                    $imageUrl = !empty($urls) ? $urls[0] : null;
                }

                return [
                    'id'           => $item->id,
                    'product_id'   => $item->product_id,
                    'product_type' => class_basename($item->product_type),
                    'name'         => $product?->getNameInLocale() ?? $product?->name ?? __('cart.product_deleted'),
                    'price'        => (int) $item->price,
                    'quantity'     => $item->quantity,
                    'subtotal'     => (int) ($item->price * $item->quantity),
                    'image'        => $imageUrl,
                ];
            }),
            'total' => (int) $total,
            'count' => $cart->items->sum('quantity'),
        ]);

        if (!auth()->check() && !request()->cookie('cart_session_id')) {
            $response->cookie('cart_session_id', $cart->session_id, 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * اضافه کردن آیتم به سبد
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'product_type' => 'required|string|in:Menu,MenuTakeout,MenuOrganizational',
            'product_id'   => 'required|integer',
            'quantity'     => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        $productClass = $this->getProductClass($request->product_type);
        $product = $productClass::findOrFail($request->product_id);

        if (isset($product->is_active) && !$product->is_active) {
            return response()->json(['message' => __('cart.product_unavailable')], 400);
        }

        $cart = $this->getOrCreateCart();

        // پیدا کردن آیتم موجود
        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->where('product_type', get_class($product))
            ->first();

        if ($cartItem) {
            // آیتم وجود دارد: فقط quantity را افزایش بده
            $cartItem->increment('quantity', $quantity);
            // قیمت را هم به‌روز کن (طبق منطق قیمت داینامیک)
            $cartItem->update(['price' => (int) (string) $product->price]);
            $cartItem->refresh();
        } else {
            // آیتم جدید: create کن
            $cartItem = $cart->items()->create([
                'product_id'   => $product->id,
                'product_type' => get_class($product),
                'quantity'     => $quantity,
                'price'        => (int) (string) $product->price,
            ]);
        }

        $cart->load('items.product');

        $response = response()->json([
            'message' => __('cart.item_added'),
            'item'    => [
                'id'       => $cartItem->id,
                'name'     => $product->getNameInLocale() ?? $product->name,
                'price'    => (int) $cartItem->price,
                'quantity' => $cartItem->quantity,
            ],
            'total' => (int) $cart->items->sum(fn($i) => $i->price * $i->quantity),
            'count' => $cart->items->sum('quantity'),
        ]);

        if (!auth()->check() && !request()->cookie('cart_session_id')) {
            $response->cookie('cart_session_id', $cart->session_id, 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * آپدیت تعداد آیتم
     */
    public function updateItem(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $this->getOrCreateCart();

        if ($cartItem->cart_id !== $cart->id) {
            return response()->json(['message' => __('cart.unauthorized_access')], 403);
        }

        if ($request->quantity == 0) {
            $cartItem->delete();
            $message = __('cart.item_removed');
        } else {
            $cartItem->update(['quantity' => $request->quantity]);
            $message = __('cart.item_updated');
        }

        $cart->load('items.product');

        return response()->json([
            'message' => $message,
            'total'   => (int) $cart->items->sum(fn($i) => $i->price * $i->quantity),
            'count'   => $cart->items->sum('quantity'),
        ]);
    }

    /**
     * حذف آیتم از سبد
     */
    public function removeItem(CartItem $cartItem)
    {
        $cart = $this->getOrCreateCart();

        if ($cartItem->cart_id !== $cart->id) {
            return response()->json(['message' => __('cart.unauthorized_access')], 403);
        }

        $cartItem->delete();
        $cart->load('items.product');

        return response()->json([
            'message' => __('cart.item_deleted'),
            'total'   => (int) $cart->items->sum(fn($i) => $i->price * $i->quantity),
            'count'   => $cart->items->sum('quantity'),
        ]);
    }

    /**
     * خالی کردن سبد خرید
     */
    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return response()->json([
            'message' => __('cart.cart_cleared'),
            'total'   => 0,
            'count'   => 0,
        ]);
    }

    /**
     * ادغام سبد مهمان با کاربر لاگین‌شده
     */
    public function merge(Request $request)
    {
        $sessionId = $request->cookie('cart_session_id');

        if (!$sessionId || !auth()->check()) {
            return response()->json(['message' => __('cart.no_cart_to_merge')], 400);
        }

        $userCart = $this->cartService->mergeGuestCart($sessionId, auth()->id());
        $userCart->load('items.product');

        $response = response()->json([
            'message' => __('cart.cart_merged'),
            'total'   => (int) $userCart->items->sum(fn($i) => $i->price * $i->quantity),
            'count'   => $userCart->items->sum('quantity'),
        ]);

        $response->withoutCookie('cart_session_id');

        return $response;
    }

    /**
     * تبدیل product_type دریافتی به کلاس کامل مدل
     */
    private function getProductClass(string $type): string
    {
        return match ($type) {
            'Menu'              => \App\Models\Menu::class,
            'MenuTakeout'       => \App\Models\MenuTakeout::class,
            'MenuOrganizational' => \App\Models\MenuOrganizational::class,
            default             => throw new \InvalidArgumentException(__('cart.invalid_product_type')),
        };
    }
}