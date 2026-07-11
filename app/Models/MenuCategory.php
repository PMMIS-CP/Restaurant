<?php
// app/Models/MenuCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = ['name_fa', 'name_en', 'name_ar'];

    /**
     * رابطه با آیتم‌های منو
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}