@extends('admin.layouts.app')

@section('title', 'ویرایش جایزه')

@section('content')
<div class="p-6">
    {{-- هدر صفحه --}}
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.spins.index') }}" 
           class="p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">
            ویرایش جایزه: 
            <span class="text-blue-600">{{ $spin->name }}</span>
        </h1>
    </div>

    <div class="max-w-2xl mx-auto">
        {{-- پیغام‌های خطا --}}
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">لطفاً خطاهای زیر را بررسی کنید:</span>
                </div>
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            {{-- فرم اصلی ویرایش --}}
            <form action="{{ route('admin.spins.update', $spin->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- نام جایزه --}}
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        نام جایزه
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name', $spin->name) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none"
                        placeholder="مثال: تخفیف ۲۰٪"
                    >
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- رنگ --}}
                <div class="mb-6">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                        رنگ جایزه
                    </label>
                    <div class="flex items-center gap-3">
                        <input 
                            type="color" 
                            name="color" 
                            id="color"
                            value="{{ old('color', $spin->color) }}"
                            class="h-12 w-20 rounded-lg border border-gray-300 cursor-pointer p-1"
                        >
                        <div class="flex-1">
                            <input 
                                type="text" 
                                id="colorHex"
                                value="{{ old('color', $spin->color) }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-gray-800 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none"
                                placeholder="#ef4444"
                                readonly
                            >
                        </div>
                        {{-- پیش‌نمایش رنگ --}}
                        <div id="colorPreview" 
                             class="w-12 h-12 rounded-full border-2 border-gray-200 shadow-sm transition-all duration-200"
                             style="background-color: {{ old('color', $spin->color) }}">
                        </div>
                    </div>
                    @error('color')
                        <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- احتمال --}}
                <div class="mb-6">
                    <label for="probability" class="block text-sm font-medium text-gray-700 mb-2">
                        احتمال برنده شدن (درصد)
                    </label>
                    <div class="relative">
                        <input 
                            type="number" 
                            name="probability" 
                            id="probability"
                            value="{{ old('probability', $spin->probability) }}"
                            min="0"
                            max="100"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none"
                        >
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">%</span>
                    </div>
                    <p class="mt-1.5 text-xs text-gray-400">عددی بین ۰ تا ۱۰۰ وارد کنید</p>
                    @error('probability')
                        <p class="mt-1.5 text-sm text-red-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- وضعیت فعال --}}
                <div class="mb-8">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1"
                            {{ old('is_active', $spin->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
                        >
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition">
                            فعال بودن جایزه
                        </span>
                    </label>
                    <p class="mt-1.5 mr-8 text-xs text-gray-400">در صورت فعال بودن، این جایزه در گردونه شانس نمایش داده می‌شود</p>
                </div>

                {{-- دکمه‌ها --}}
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    {{-- دکمه حذف (نوع button معمولی برای جلوگیری از submit فرم اصلی) --}}
                    <button type="button" 
                            onclick="confirmDelete()"
                            class="px-5 py-2.5 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        حذف جایزه
                    </button>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.spins.index') }}" 
                           class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                            انصراف
                        </a>
                        <button type="submit" 
                                class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-xl transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            بروزرسانی جایزه
                        </button>
                    </div>
                </div>
            </form>

            {{-- فرم حذف (خارج از فرم اصلی) --}}
            <form id="deleteForm" action="{{ route('admin.spins.destroy', $spin->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>

{{-- اسکریپت‌ها --}}
<script>
    // هماهنگ‌سازی رنگ
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('color');
        const colorHex = document.getElementById('colorHex');
        const colorPreview = document.getElementById('colorPreview');
        
        colorInput.addEventListener('input', function() {
            colorHex.value = this.value;
            colorPreview.style.backgroundColor = this.value;
        });
        
        colorHex.addEventListener('input', function() {
            if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                colorInput.value = this.value;
                colorPreview.style.backgroundColor = this.value;
            }
        });
    });

    // تابع تأیید و ارسال فرم حذف
    function confirmDelete() {
        if (confirm('آیا از حذف این جایزه اطمینان دارید؟ این عملیات قابل بازگشت نیست.')) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
@endsection