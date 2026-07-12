<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTakeoutCategory extends Model
{
    protected $fillable = ['name_fa', 'name_en', 'name_ar'];

    /**
     * رابطه با آیتم‌های منوی بیرون‌بر
     */
    public function takeouts()
    {
        return $this->hasMany(MenuTakeout::class);
    }

}