<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuOrganizationalCategory extends Model
{
    protected $fillable = ['name_fa', 'name_en', 'name_ar'];

    /**
     * رابطه با آیتم‌های منوی سازمانی
     */
    public function organizationals()
    {
        return $this->hasMany(MenuOrganizational::class);
    }
}