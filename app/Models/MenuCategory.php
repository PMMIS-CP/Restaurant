<?php
// app/Models/MenuCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MenuCategory extends Model
{
    protected $fillable = ['name_fa', 'name_en', 'name_ar', 'image'];

    /**
     * رابطه با آیتم‌های منو
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * دریافت URL کامل عکس (در صورت وجود)
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }

    /**
     * حذف فایل فیزیکی عکس از دیسک
     */
    public function deleteImage(): void
    {
        if ($this->image) {
            Storage::disk('public')->delete($this->image);
            $this->update(['image' => null]);
        }
    }

    /**
     * هنگام حذف کامل مدل، عکس را هم پاک می‌کند
     */
    protected static function booted()
    {
        static::deleting(function ($category) {
            $category->deleteImage();
        });
    }
}