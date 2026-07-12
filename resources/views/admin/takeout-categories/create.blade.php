{{-- resources/views/admin/takeout-categories/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'ایجاد دسته‌بندی جدید')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">ایجاد دسته‌بندی جدید</h2>
                <a href="{{ route('admin.takeout-categories.index') }}" 
                   class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.takeout-categories.store') }}" method="POST" class="p-6 space-y-6" id="category-form">
            @csrf

            {{-- فیلدهای نام (فارسی، انگلیسی، عربی) --}}
            <div>
                <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">نام فارسی *</label>
                <input type="text" name="name_fa" id="name_fa" value="{{ old('name_fa') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_fa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی *</label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_en')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">نام عربی *</label>
                <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}"
                       class="w-full px-4 py-2 border rounded-lg ..." dir="rtl" required>
                @error('name_ar')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- دکمه‌های ثبت --}}
            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.takeout-categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    انصراف
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">
                    ذخیره دسته‌بندی
                </button>
            </div>
        </form>
    </div>
</div>
@endsection