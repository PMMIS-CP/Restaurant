@extends('admin.layouts.app')

@section('title', 'ویرایش جایزه شماره ' . $spin->id)

@section('content')
<div class="p-6">
    {{-- هدر صفحه --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">ویرایش جایزه شماره {{ $spin->id }}</h1>
            <p class="text-sm text-gray-500 mt-1">تنظیم نام، رنگ و وضعیت جایزه</p>
        </div>
        <a href="{{ route('admin.spins.index') }}" 
           class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            بازگشت به لیست جوایز
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        {{-- کارت preview جایزه --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <h3 class="text-sm font-medium text-gray-500 mb-4">پیش‌نمایش جایزه</h3>
            <div class="flex items-center gap-4">
                <div id="colorPreview" 
                     class="w-16 h-16 rounded-full border-4 border-gray-200 shadow-lg transition-all duration-300"
                     style="background-color: {{ old('color', $spin->color) }}">
                </div>
                <div>
                    <p id="namePreview" class="text-lg font-bold text-gray-800">
                        {{ old('name', $spin->name) ?: 'نام جایزه تعیین نشده' }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($spin->is_active)
                            <span class="text-green-600">وضعیت: فعال</span>
                        @else
                            <span class="text-red-600">وضعیت: غیرفعال</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- فرم ویرایش --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.spins.update', $spin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- نام جایزه --}}
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            نام جایزه
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $spin->name) }}"
                               class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror"
                               placeholder="مثال: آیفون ۱۵، شارژ ۱۰ هزار تومانی، ...">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-400">نام جایزه‌ای که در گردونه نمایش داده می‌شود.</p>
                    </div>

                    {{-- رنگ جایزه --}}
                    <div class="mb-6">
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                            رنگ جایزه
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="color" 
                                   id="color" 
                                   name="color" 
                                   value="{{ old('color', $spin->color) }}"
                                   class="h-10 w-20 border rounded-lg cursor-pointer @error('color') border-red-500 @enderror">
                            <input type="text" 
                                   id="colorHex" 
                                   value="{{ old('color', $spin->color) }}"
                                   class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 font-mono text-sm"
                                   readonly>
                            <button type="button" 
                                    onclick="resetColor()"
                                    class="px-3 py-2.5 text-sm text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                                رنگ پیش‌فرض
                            </button>
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- وضعیت فعال/غیرفعال --}}
                    <div class="mb-6 p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <label for="is_active" class="text-sm font-medium text-gray-700">
                                    وضعیت جایزه
                                </label>
                                <p class="text-xs text-gray-500 mt-1">
                                    با فعال‌سازی، درصد شانس به صورت خودکار محاسبه می‌شود.
                                </p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       {{ old('is_active', $spin->is_active) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:inset-s-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        <div id="activeStatus" class="mt-2 text-sm font-medium">
                            @if(old('is_active', $spin->is_active))
                                <span class="text-green-600">✓ جایزه فعال است</span>
                            @else
                                <span class="text-red-600">✗ جایزه غیرفعال است</span>
                            @endif
                        </div>
                    </div>

                    {{-- درصد شانس (فقط نمایشی) --}}
                    <div class="mb-6 p-4 bg-blue-50 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    درصد شانس (محاسبه خودکار)
                                </label>
                                <p class="text-xs text-gray-500 mt-1">
                                    پس از ذخیره، درصد شانس بر اساس تعداد جوایز فعال محاسبه می‌شود.
                                </p>
                            </div>
                            <div class="text-center">
                                <span class="text-3xl font-bold text-blue-600">
                                    {{ $spin->probability ?? 0 }}
                                </span>
                                <span class="text-lg text-blue-600">%</span>
                            </div>
                        </div>
                    </div>

                    {{-- دکمه‌های فرم --}}
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.spins.index') }}" 
                           class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                            انصراف
                        </a>
                        <button type="submit" 
                                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // ذخیره رنگ پیش‌فرض
    const defaultColor = '{{ $spin->color }}';
    
    // همگام‌سازی color picker با input متنی و preview
    const colorInput = document.getElementById('color');
    const colorHex = document.getElementById('colorHex');
    const colorPreview = document.getElementById('colorPreview');
    
    colorInput.addEventListener('input', function() {
        const color = this.value;
        colorHex.value = color;
        colorPreview.style.backgroundColor = color;
    });
    
    // به‌روزرسانی preview نام
    const nameInput = document.getElementById('name');
    const namePreview = document.getElementById('namePreview');
    
    nameInput.addEventListener('input', function() {
        const name = this.value.trim();
        if (name) {
            namePreview.textContent = name;
            namePreview.classList.remove('text-gray-400');
            namePreview.classList.add('text-gray-800');
        } else {
            namePreview.textContent = 'نام جایزه تعیین نشده';
            namePreview.classList.add('text-gray-400');
            namePreview.classList.remove('text-gray-800');
        }
    });
    
    // به‌روزرسانی وضعیت فعال/غیرفعال
    const isActiveCheckbox = document.getElementById('is_active');
    const activeStatus = document.getElementById('activeStatus');
    
    isActiveCheckbox.addEventListener('change', function() {
        if (this.checked) {
            activeStatus.innerHTML = '<span class="text-green-600">✓ جایزه فعال است</span>';
        } else {
            activeStatus.innerHTML = '<span class="text-red-600">✗ جایزه غیرفعال است</span>';
        }
    });
    
    // بازنشانی رنگ به پیش‌فرض
    function resetColor() {
        colorInput.value = defaultColor;
        colorHex.value = defaultColor;
        colorPreview.style.backgroundColor = defaultColor;
    }
    
    // مقداردهی اولیه
    colorHex.value = colorInput.value;
</script>
@endpush
@endsection