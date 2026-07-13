{{-- resources/views/admin/organizational-categories/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'ویرایش دسته‌بندی (سازمانی)')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">ویرایش: {{ $organizationalCategory->name_fa }} - {{ $organizationalCategory->name_en }} - {{ $organizationalCategory->name_ar }}</h2>
        </div>

        <form action="{{ route('admin.organizational-categories.update', $organizationalCategory) }}" method="POST" class="p-6 space-y-6" id="category-form">
            @csrf
            @method('PUT')

            <div>
                <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">نام فارسی *</label>
                <input type="text" name="name_fa" id="name_fa" value="{{ old('name_fa', $organizationalCategory->name_fa) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_fa')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی *</label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $organizationalCategory->name_en) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." required>
                @error('name_en')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">نام عربی *</label>
                <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $organizationalCategory->name_ar) }}"
                       class="w-full px-4 py-2 border rounded-lg ..." dir="rtl" required>
                @error('name_ar')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.organizational-categories.index') }}" class="px-6 py-2 border ...">انصراف</a>
                <button type="submit" class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600">بروزرسانی</button>
            </div>
        </form>
    </div>
</div>
@endsection