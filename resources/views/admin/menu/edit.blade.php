{{-- resources/views/admin/menu/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'ویرایش ' . ($menu->getNameInLocale('fa') ?: 'غذا'))

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">
                    ویرایش {{ $menu->getNameInLocale('fa') ?: $menu->getNameInLocale('en') ?: 'غذا' }}
                </h2>
                <a href="{{ route('admin.menu.index') }}" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.menu.update', $menu) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Names, Category, Price, Descriptions (بدون تغییر) -->
            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">نام‌های غذا (هر سه زبان الزامی است)</h3>
                
                <div>
                    <label for="name_fa" class="block text-sm font-medium text-gray-700 mb-2">نام فارسی <span class="text-red-500">*</span></label>
                    <input type="text" name="name_fa" id="name_fa" value="{{ old('name_fa', $name['fa'] ?? '') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_fa') border-red-500 @enderror"
                           placeholder="مثال: استیک با سس قارچ" required>
                    @error('name_fa') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">نام انگلیسی <span class="text-red-500">*</span></label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $name['en'] ?? '') }}" dir="ltr"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_en') border-red-500 @enderror"
                           placeholder="Example: Steak with Mushroom Sauce" required>
                    @error('name_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">نام عربی <span class="text-red-500">*</span></label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $name['ar'] ?? '') }}" dir="rtl"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-colors @error('name_ar') border-red-500 @enderror"
                           placeholder="مثال: شريحة لحم مع صلصة الفطر" required>
                    @error('name_ar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="menu_category_id" class="block text-sm font-medium text-gray-700 mb-2">دسته‌بندی *</label>
                <select name="menu_category_id" id="menu_category_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('menu_category_id') border-red-500 @enderror" required>
                    <option value="">انتخاب دسته‌بندی</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('menu_category_id', $menu->menu_category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name_fa }}
                        </option>
                    @endforeach
                </select>
                @error('menu_category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">قیمت (تومان) *</label>
                <input type="number" name="price" id="price" value="{{ old('price', $menu->price) }}" step="1" min="0"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('price') border-red-500 @enderror"
                       placeholder="مثال: 1800000" required>
                @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1 text-xs text-gray-500" id="price-preview">
                    @php $currentPrice = old('price', $menu->price); @endphp
                    @if($currentPrice) معادل: {{ number_format($currentPrice) }} تومان @endif
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">توضیحات (اختیاری)</h3>
                <div>
                    <label for="description_fa" class="block text-sm font-medium text-gray-700 mb-2">توضیحات فارسی</label>
                    <textarea name="description_fa" id="description_fa" rows="3"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_fa') border-red-500 @enderror"
                              placeholder="توضیحات غذا به فارسی...">{{ old('description_fa', $description['fa'] ?? '') }}</textarea>
                    @error('description_fa') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">توضیحات انگلیسی</label>
                    <textarea name="description_en" id="description_en" rows="3" dir="ltr"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_en') border-red-500 @enderror"
                              placeholder="Food description in English...">{{ old('description_en', $description['en'] ?? '') }}</textarea>
                    @error('description_en') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="description_ar" class="block text-sm font-medium text-gray-700 mb-2">توضیحات عربی</label>
                    <textarea name="description_ar" id="description_ar" rows="3" dir="rtl"
                              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-rose-500 focus:border-rose-500 @error('description_ar') border-red-500 @enderror"
                              placeholder="وصف الطعام بالعربية...">{{ old('description_ar', $description['ar'] ?? '') }}</textarea>
                    @error('description_ar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- ========== بخش تصاویر فعلی + آپلود جدید ========== --}}
            @php $currentImages = $menu->images ?? []; @endphp
            @if(!empty($currentImages))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">تصاویر فعلی</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($currentImages as $img)
                        <div class="relative w-24 h-24 rounded-lg overflow-hidden border group">
                            <img src="{{ Storage::disk('public')->url($img) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 group-hover:bg-opacity-20 transition-all"></div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-1 text-xs text-red-500">در صورت انتخاب تصاویر جدید، تصاویر قبلی حذف خواهند شد.</p>
            </div>
            @endif

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ !empty($currentImages) ? 'آپلود تصاویر جدید' : 'تصاویر غذا' }} (حداکثر ۶ عدد)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-rose-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="images" class="relative cursor-pointer rounded-md font-medium text-rose-600 hover:text-rose-500">
                                <span>آپلود تصاویر</span>
                                <input id="images" name="images[]" type="file" multiple accept="image/*" class="sr-only">
                            </label>
                            <p class="pr-1">یا بکشید و رها کنید</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, WebP - حداکثر ۶ فایل</p>
                    </div>
                </div>
                <div id="images-preview" class="mt-3 flex flex-wrap gap-3"></div>
                <p id="images-status" class="mt-2 text-sm"></p>
                @error('images') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            {{-- ================================================ --}}

            <!-- Submit -->
            <div class="flex justify-end space-x-3 rtl:space-x-reverse">
                <a href="{{ route('admin.menu.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">انصراف</a>
                <button type="submit" class="px-6 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition-colors">بروزرسانی غذا</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // =============================================
    // ۱. پیش‌نمایش چند تصویر + تبدیل WebP (مشابه create)
    // =============================================
    const imagesInput = document.getElementById('images');
    const previewContainer = document.getElementById('images-preview');
    const statusMessage = document.getElementById('images-status');

    imagesInput.addEventListener('change', async function(e) {
        const files = Array.from(e.target.files);
        if (files.length === 0) {
            previewContainer.innerHTML = '';
            previewContainer.classList.add('hidden');
            statusMessage.textContent = '';
            return;
        }
        if (files.length > 6) {
            alert('حداکثر ۶ تصویر مجاز است.');
            imagesInput.value = '';
            previewContainer.innerHTML = '';
            previewContainer.classList.add('hidden');
            return;
        }

        previewContainer.innerHTML = '';
        previewContainer.classList.remove('hidden');
        statusMessage.textContent = 'در حال پردازش و تبدیل تصاویر به WebP...';
        statusMessage.className = 'mt-2 text-sm text-blue-600';

        const webpFiles = [];
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const originalUrl = URL.createObjectURL(file);
            const previewDiv = document.createElement('div');
            previewDiv.className = 'relative w-24 h-24 rounded-lg overflow-hidden border';
            previewDiv.innerHTML = `<img src="${originalUrl}" class="w-full h-full object-cover">`;
            previewContainer.appendChild(previewDiv);

            try {
                const arrayBuffer = await file.arrayBuffer();
                const data = new Uint8Array(arrayBuffer);
                const image = await window.CrossImage.Image.decode(data);
                const webpData = await image.encode('webp', 85);
                const webpBlob = new Blob([webpData], { type: 'image/webp' });
                const originalName = file.name.split('.').slice(0, -1).join('.') || 'image';
                const webpFile = new File([webpBlob], `${originalName}.webp`, {
                    type: 'image/webp',
                    lastModified: Date.now()
                });
                webpFiles.push(webpFile);
                const webpUrl = URL.createObjectURL(webpBlob);
                previewDiv.querySelector('img').src = webpUrl;
            } catch (error) {
                console.error('خطا در تبدیل تصویر:', file.name, error);
                webpFiles.push(file);
            }
        }

        const dataTransfer = new DataTransfer();
        webpFiles.forEach(file => dataTransfer.items.add(file));
        imagesInput.files = dataTransfer.files;

        statusMessage.textContent = `✅ ${webpFiles.length} تصویر جدید آماده شد.`;
        statusMessage.className = 'mt-2 text-sm text-green-600';
    });

    // =============================================
    // ۲. پیش‌نمایش قیمت (بدون تغییر)
    // =============================================
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
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('price');
        if (priceInput.value) {
            priceInput.dispatchEvent(new Event('input'));
        }
    });

    // اعتبارسنجی نام‌ها
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