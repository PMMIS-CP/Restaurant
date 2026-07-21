@extends('admin.layouts.app')

@section('title', 'ایجاد جایزه جدید')

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
        <h1 class="text-2xl font-bold text-gray-800">ایجاد جایزه جدید</h1>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.spins.store') }}" method="POST">
                @csrf
                
                {{-- نام جایزه --}}
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        نام جایزه
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name"
                        value="{{ old('name') }}"
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
                            value="{{ old('color', '#ef4444') }}"
                            class="h-12 w-20 rounded-lg border border-gray-300 cursor-pointer p-1"
                        >
                        <div class="flex-1">
                            <input 
                                type="text" 
                                id="colorHex"
                                value="{{ old('color', '#ef4444') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-gray-800 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none"
                                placeholder="#ef4444"
                                readonly
                            >
                        </div>
                        {{-- پیش‌نمایش رنگ --}}
                        <div id="colorPreview" 
                             class="w-12 h-12 rounded-full border-2 border-gray-200 shadow-sm transition-all duration-200"
                             style="background-color: {{ old('color', '#ef4444') }}">
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
                            value="{{ old('probability', 10) }}"
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
                            checked
                            class="w-5 h-5 rounded-lg border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
                        >
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900 transition">
                            فعال بودن جایزه
                        </span>
                    </label>
                    <p class="mt-1.5 mr-8 text-xs text-gray-400">در صورت فعال بودن، این جایزه در گردونه شانس نمایش داده می‌شود</p>
                </div>

                {{-- دکمه‌ها --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.spins.index') }}" 
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                        انصراف
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-xl transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        ذخیره جایزه
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- اسکریپت هماهنگ‌سازی رنگ --}}
<script>
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
</script>
@endsection