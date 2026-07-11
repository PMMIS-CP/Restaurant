<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name_fa' => ['nullable', 'string', 'max:255'],
            'name_en' => ['nullable', 'string', 'max:255'],
            'name_ar' => ['nullable', 'string', 'max:255'],
            'at_least_one_name' => [function ($attribute, $value, $fail) {
                if (
                    empty($this->input('name_fa')) &&
                    empty($this->input('name_en')) &&
                    empty($this->input('name_ar'))
                ) {
                    $fail('حداقل یکی از نام‌های غذا (فارسی، انگلیسی یا عربی) الزامی است.');
                }
            }],

            'description_fa' => ['nullable', 'string', 'max:1000'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'description_ar' => ['nullable', 'string', 'max:1000'],

            'price'           => ['required', 'numeric', 'min:0'],
            'menu_category_id' => ['required', 'integer', 'exists:menu_categories,id'], // جایگزین category
            'image'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active'       => ['boolean'],
            'sort_order'      => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'قیمت الزامی است',
            'price.min' => 'قیمت نمی‌تواند منفی باشد',
            'menu_category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'menu_category_id.exists'   => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'image.image' => 'فایل باید تصویر باشد',
            'image.mimes' => 'فرمت‌های مجاز: jpeg, png, jpg, webp',
            'image.max' => 'حداکثر حجم تصویر ۲ مگابایت است',
        ];
    }
}