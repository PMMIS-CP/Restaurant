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

            <!-- Names Section -->
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">نام‌های غذا (هر سه زبان الزامی است)</h3>
                
                <!-- Persian Name -->
                <div>
                    <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">
                        نام فارسی <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name_fa" 
                           id="name_fa" 
                           value="{{ old('name_fa') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_fa') border-red-500 @enderror"
                           placeholder="مثال: استیک با سس قارچ"
                           required>
                    @error('name_fa')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- English Name -->
                <div>
                    <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                        نام انگلیسی <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name_en" 
                           id="name_en" 
                           value="{{ old('name_en') }}"
                           dir="ltr"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_en') border-red-500 @enderror"
                           placeholder="Example: Steak with Mushroom Sauce"
                           required>
                    @error('name_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Arabic Name -->
                <div>
                    <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">
                        نام عربی <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name_ar" 
                           id="name_ar" 
                           value="{{ old('name_ar') }}"
                           dir="rtl"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_ar') border-red-500 @enderror"
                           placeholder="مثال: شريحة لحم مع صلصة الفطر"
                           required>
                    @error('name_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Category -->
            <div>
                <label for="menu_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    دسته‌بندی *
                </label>
                <select name="menu_category_id" 
                        id="menu_category_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('menu_category_id') border-red-500 @enderror"
                        required>
                    <option value="">انتخاب دسته‌بندی</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('menu_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_fa }}
                        </option>
                    @endforeach
                </select>
                @error('menu_category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if($categories->isEmpty())
                    <p class="mt-2 text-sm text-yellow-600">
                        هیچ دسته‌بندی‌ای وجود ندارد. 
                        <a href="{{ route('admin.menu-categories.create') }}" class="underline text-rose-500">یک دسته جدید بسازید</a>.
                    </p>
                @endif
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
                       step="1"
                       min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('price') border-red-500 @enderror"
                       placeholder="مثال: 1800000"
                       required>
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500" id="price-preview"></p>
            </div>

            <!-- Descriptions Section -->
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">توضیحات (اختیاری)</h3>
                
                <!-- Persian Description -->
                <div>
                    <label for="description_fa" class="block text-sm font-medium text-gray-700 mb-2">
                        توضیحات فارسی
                    </label>
                    <textarea name="description_fa" 
                              id="description_fa" 
                              rows="3"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_fa') border-red-500 @enderror"
                              placeholder="توضیحات غذا به فارسی...">{{ old('description_fa') }}</textarea>
                    @error('description_fa')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- English Description -->
                <div>
                    <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                        توضیحات انگلیسی
                    </label>
                    <textarea name="description_en" 
                              id="description_en" 
                              rows="3"
                              dir="ltr"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_en') border-red-500 @enderror"
                              placeholder="Food description in English...">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Arabic Description -->
                <div>
                    <label for="description_ar" class="block text-sm font-medium text-gray-700 mb-2">
                        توضیحات عربی
                    </label>
                    <textarea name="description_ar" 
                              id="description_ar" 
                              rows="3"
                              dir="rtl"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_ar') border-red-500 @enderror"
                              placeholder="وصف الطعام بالعربية...">{{ old('description_ar') }}</textarea>
                    @error('description_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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
// پیش‌نمایش تصویر
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

// پیش‌نمایش قیمت به صورت خوانا
document.getElementById('price').addEventListener('input', function(e) {
    const price = parseInt(this.value);
    const preview = document.getElementById('price-preview');
    
    if (price && !isNaN(price)) {
        const formatted = new Intl.NumberFormat('fa-IR').format(price);
        if (price >= 1000000) {
            const millions = price / 1000000;
            preview.textContent = `معادل: ${formatted} تومان (${millions.toFixed(1)} میلیون تومان)`;
        } else if (price >= 1000) {
            const thousands = price / 1000;
            preview.textContent = `معادل: ${formatted} تومان (${thousands.toFixed(0)} هزار تومان)`;
        } else {
            preview.textContent = `معادل: ${formatted} تومان`;
        }
    } else {
        preview.textContent = '';
    }
});

// اعتبارسنجی سمت کلاینت: هر سه نام الزامی
document.querySelector('form').addEventListener('submit', function(e) {
    const nameFa = document.getElementById('name_fa').value.trim();
    const nameEn = document.getElementById('name_en').value.trim();
    const nameAr = document.getElementById('name_ar').value.trim();
    
    if (!nameFa || !nameEn || !nameAr) {
        e.preventDefault();
        alert('هر سه نام (فارسی، انگلیسی و عربی) الزامی هستند.');
        return false;
    }
});
</script>
@endpush
@endsection