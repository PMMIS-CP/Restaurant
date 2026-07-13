<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationalMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name_fa'                         => ['required', 'string', 'max:255'],
            'name_en'                         => ['required', 'string', 'max:255'],
            'name_ar'                         => ['required', 'string', 'max:255'],

            'description_fa'                  => ['nullable', 'string', 'max:1000'],
            'description_en'                  => ['nullable', 'string', 'max:1000'],
            'description_ar'                  => ['nullable', 'string', 'max:1000'],

            'price'                           => ['required', 'numeric', 'min:0'],
            'menu_organizational_category_id' => ['required', 'integer', 'exists:menu_organizational_categories,id'],

            'images'                          => ['nullable', 'array', 'max:6'],
            'images.*'                        => ['image', 'mimes:jpeg,png,jpg,webp,gif,bmp,tiff,heic,heif,raw', 'max:20480'],

            'is_active'                       => ['boolean'],
            'sort_order'                      => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name_fa.required'                          => 'نام فارسی غذا الزامی است.',
            'name_en.required'                          => 'نام انگلیسی غذا الزامی است.',
            'name_ar.required'                          => 'نام عربی غذا الزامی است.',
            'price.required'                            => 'قیمت الزامی است.',
            'price.min'                                 => 'قیمت نمی‌تواند منفی باشد.',
            'menu_organizational_category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'menu_organizational_category_id.exists'   => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'images.max'                                => 'حداکثر ۶ تصویر مجاز است.',
            'images.*.image'                            => 'فایل باید تصویر باشد.',
            'images.*.mimes'                            => 'فرمت‌های مجاز: jpeg,png,jpg,webp,gif,bmp,tiff,heic,heif,raw',
            'images.*.max'                              => 'حداکثر حجم هر تصویر ۲۰ مگابایت است.',
        ];
    }
}