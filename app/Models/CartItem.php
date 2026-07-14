<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

#[Fillable(['cart_id', 'product_id', 'product_type', 'quantity', 'price'])]
class CartItem extends Model
{
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): MorphTo
    {
        return $this->morphTo();
    }
}