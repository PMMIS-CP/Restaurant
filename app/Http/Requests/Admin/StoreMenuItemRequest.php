<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام غذا الزامی است',
            'price.required' => 'قیمت الزامی است',
            'price.min' => 'قیمت نمی‌تواند منفی باشد',
            'category.required' => 'دسته‌بندی الزامی است',
            'image.image' => 'فایل باید تصویر باشد',
            'image.mimes' => 'فرمت‌های مجاز: jpeg, png, jpg, webp',
            'image.max' => 'حداکثر حجم تصویر ۲ مگابایت است',
        ];
    }
}