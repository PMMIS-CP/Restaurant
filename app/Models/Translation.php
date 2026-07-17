<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Translation extends Model
{
    protected $fillable = ['key', 'group', 'locale', 'value'];

    /**
     * Scope برای فیلتر بر اساس گروه
     */
    public function scopeOfGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }

    /**
     * Scope برای فیلتر بر اساس زبان
     */
    public function scopeOfLocale(Builder $query, string $locale): Builder
    {
        return $query->where('locale', $locale);
    }

    /**
     * گرفتن یک ترجمه مشخص از دیتابیس
     */
    public static function getValue(string $key, string $group, string $locale, ?string $default = null): ?string
    {
        return static::where('key', $key)
            ->where('group', $group)
            ->where('locale', $locale)
            ->value('value') ?? $default ?? $key;
    }
}