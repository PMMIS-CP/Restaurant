@extends('admin.layouts.app')

@section('title', 'ویرایش نظر')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.comments.index') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">ویرایش نظر</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
        {{-- اطلاعات کاربر (فقط نمایش) --}}
        <div class="mb-8 p-4 bg-gray-50 rounded-xl flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-[#8B0000]/10 flex items-center justify-center text-[#8B0000] font-bold">
                {{ $comment->user ? Str::substr($comment->user->name, 0, 1) : '?' }}
            </div>
            <div>
                <p class="text-sm text-gray-500">ثبت‌شده توسط</p>
                @if($comment->user)
                    <p class="font-medium text-gray-800">{{ $comment->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $comment->user->email }}</p>
                @else
                    <p class="text-gray-500 italic text-sm">مهمان (بدون اکانت)</p>
                @endif
            </div>
            <span class="mr-auto text-xs text-gray-400">(غیرقابل تغییر)</span>
        </div>

        <form action="{{ route('admin.comments.update', $comment) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- نام نمایشی --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">نام نمایشی در سایت</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name', $comment->name) }}"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-[#8B0000]/50 focus:border-[#8B0000] transition"
                       required>
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- متن نظر --}}
            <div class="mb-6">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">متن نظر</label>
                <textarea name="comment" id="comment" rows="6"
                          class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-[#8B0000]/50 focus:border-[#8B0000] transition"
                          required>{{ old('comment', $comment->comment) }}</textarea>
                @error('comment')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- تگ‌ها --}}
            <div class="mb-6">
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">
                    تگ‌ها 
                    <span class="text-gray-400 text-xs font-normal">(با کاما جدا کنید)</span>
                </label>
                <input type="text" name="tags_input" id="tags" 
                       value="{{ old('tags_input', is_array($comment->tags) ? implode('، ', $comment->tags) : '') }}"
                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:ring-2 focus:ring-[#8B0000]/50 focus:border-[#8B0000] transition"
                       placeholder="مثال: VIP، رزرو میز، سفارش آنلاین">
                <p class="mt-1 text-xs text-gray-400">تگ‌ها در فرانت به‌صورت خودکار دسته‌بندی می‌شوند. می‌توانید ویرایش کنید.</p>
                @error('tags')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- وضعیت فعال/غیرفعال --}}
            <div class="mb-8">
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $comment->is_active) ? 'checked' : '' }}
                           class="w-5 h-5 rounded border-gray-300 text-[#8B0000] focus:ring-[#8B0000]/50">
                    <span class="text-sm font-medium text-gray-700">نمایش در سایت (فعال)</span>
                </label>
                <p class="mt-1 text-xs text-gray-400 mr-8">در صورت غیرفعال بودن، این نظر در بخش بازخورد مشتریان نمایش داده نمی‌شود.</p>
            </div>

            {{-- دکمه‌ها --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.comments.index') }}" 
                   class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition text-sm">
                    انصراف
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#8B0000] text-white rounded-xl hover:bg-[#6b0000] transition text-sm font-medium">
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection