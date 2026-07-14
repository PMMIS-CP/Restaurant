<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * ادغام سبد خرید مهمان با سبد خرید کاربر لاگین‌شده.
     *
     * @param string $sessionId
     * @param int $userId
     * @return Cart سبد کاربر
     */
    public function mergeGuestCart(string $sessionId, int $userId): Cart
    {
        $guestCart = Cart::where('session_id', $sessionId)->first();

        if (!$guestCart || $guestCart->items()->count() === 0) {
            return Cart::firstOrCreate(['user_id' => $userId]);
        }

        $userCart = Cart::firstOrCreate(['user_id' => $userId]);

        DB::transaction(function () use ($guestCart, $userCart) {
            foreach ($guestCart->items as $guestItem) {
                $existingItem = $userCart->items()
                    ->where('product_id', $guestItem->product_id)
                    ->where('product_type', $guestItem->product_type)
                    ->first();

                if ($existingItem) {
                    $existingItem->update([
                        'quantity' => $existingItem->quantity + $guestItem->quantity,
                        'price'    => max($existingItem->price, $guestItem->price),
                    ]);
                } else {
                    $userCart->items()->create([
                        'product_id'   => $guestItem->product_id,
                        'product_type' => $guestItem->product_type,
                        'quantity'     => $guestItem->quantity,
                        'price'        => $guestItem->price,
                    ]);
                }
            }

            $guestCart->delete();
        });

        return $userCart;
    }
}