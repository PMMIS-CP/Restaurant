@extends('admin.layouts.app')

@section('title', 'افزودن غذای جدید')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">افزودن غذای جدید</h2>
                <a href="{{ route('admin.menu.index') }}" 
                   class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    نام غذا *
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    دسته‌بندی *
                </label>
                <select name="category" 
                        id="category" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('category') border-red-500 @enderror"
                        required>
                    <option value="">انتخاب دسته‌بندی</option>
                    <option value="پیش غذا" {{ old('category') == 'پیش غذا' ? 'selected' : '' }}>پیش غذا</option>
                    <option value="غذای اصلی" {{ old('category') == 'غذای اصلی' ? 'selected' : '' }}>غذای اصلی</option>
                    <option value="دسر" {{ old('category') == 'دسر' ? 'selected' : '' }}>دسر</option>
                    <option value="نوشیدنی" {{ old('category') == 'نوشیدنی' ? 'selected' : '' }}>نوشیدنی</option>
                    <option value="مخلفات" {{ old('category') == 'مخلفات' ? 'selected' : '' }}>مخلفات</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                    قیمت (تومان) *
                </label>
                <input type="number" 
                       name="price" 
                       id="price" 
                       value="{{ old('price') }}"
                       step="0.01"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('price') border-red-500 @enderror"
                       required>
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    توضیحات
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description') border-red-500 @enderror"
                          placeholder="توضیحات غذا...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    تصویر غذا
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-rose-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-rose-600 hover:text-rose-500">
                                <span>آپلود تصویر</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pr-1">یا بکشید و رها کنید</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, WebP تا ۲ مگابایت</p>
                    </div>
                </div>
                <div id="image-preview" class="mt-3 hidden">
                    <img id="preview" src="#" alt="پیش‌نمایش" class="w-32 h-32 object-cover rounded-lg">
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                    ترتیب نمایش
                </label>
                <input type="number" 
                       name="sort_order" 
                       id="sort_order" 
                       value="{{ old('sort_order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('sort_order') border-red-500 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Active -->
            <div class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="w-4 h-4 text-rose-600 border-gray-300 rounded focus:ring-rose-500">
                <label for="is_active" class="mr-2 text-sm text-gray-700">
                    فعال باشد
                </label>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.menu.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    انصراف
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition-colors">
                    ذخیره غذا
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('image-preview');
    
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.classList.remove('hidden');
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endpush
@endsection