<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class MenuOrganizational extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'menu_organizational_category_id',
        'images',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'name'        => 'array',
        'description' => 'array',
        'price'       => 'decimal:2',
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
        'images'      => 'array',
    ];

    /**
     * رابطه با دسته‌بندی سازمانی
     */
    public function category()
    {
        return $this->belongsTo(MenuOrganizationalCategory::class, 'menu_organizational_category_id');
    }

    /**
     * نام غذا با اولویت زبان درخواستی
     */
    public function getNameInLocale(?string $locale = null): string
    {
        $names = $this->name;
        if (!is_array($names)) {
            return '';
        }
        $locale = $locale ?? app()->getLocale();
        return $names[$locale] ?? reset($names) ?? '';
    }

    /**
     * توضیحات چندزبانه
     */
    public function getDescriptionInLocale(?string $locale = null): string
    {
        $descriptions = $this->description;
        if (!is_array($descriptions)) {
            return '';
        }
        $locale = $locale ?? app()->getLocale();
        return $descriptions[$locale] ?? reset($descriptions) ?? '';
    }

    /**
     * دریافت URL کامل تصاویر
     */
    public function getImagesUrls(): array
    {
        return collect($this->images)->map(function ($path) {
            return Storage::disk('public')->url($path);
        })->toArray();
    }

    /**
     * حذف تمام تصاویر از حافظه
     */
    public function deleteImagesFromStorage(): void
    {
        if (!empty($this->images)) {
            foreach ($this->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }
    public function cartItems(): MorphMany
    {
        return $this->morphMany(CartItem::class, 'product');
    }
}