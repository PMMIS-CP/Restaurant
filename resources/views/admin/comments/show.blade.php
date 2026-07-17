@extends('admin.layouts.app')

@section('title', 'جزئیات نظر')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.comments.index') }}" class="p-2 rounded-lg hover:bg-gray-100 text-gray-500 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">جزئیات نظر</h1>
        @if($comment->is_active)
            <span class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full font-medium">فعال</span>
        @else
            <span class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded-full font-medium">غیرفعال</span>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-6">
        {{-- کاربر ارسال‌کننده --}}
        <div class="p-4 bg-gray-50 rounded-xl flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-[#8B0000]/10 flex items-center justify-center text-[#8B0000] font-bold text-lg">
                {{ $comment->user ? Str::substr($comment->user->name, 0, 1) : '?' }}
            </div>
            <div>
                <p class="text-sm text-gray-500">ثبت‌شده توسط</p>
                @if($comment->user)
                    <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $comment->user->email }}</p>
                @else
                    <p class="text-gray-500 italic">مهمان (بدون اکانت)</p>
                @endif
            </div>
        </div>

        {{-- فرستنده (نام نمایشی) --}}
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-lg">
                {{ Str::substr($comment->name, 0, 1) }}
            </div>
            <div>
                <p class="text-sm text-gray-500">نام نمایشی در سایت</p>
                <p class="font-semibold text-gray-800 text-lg">{{ $comment->name }}</p>
            </div>
        </div>

        {{-- متن نظر --}}
        <div>
            <p class="text-sm text-gray-500 mb-1">متن نظر</p>
            <div class="p-4 bg-gray-50 rounded-xl text-gray-700 leading-relaxed whitespace-pre-line">
                {{ $comment->comment }}
            </div>
        </div>

        {{-- تگ‌ها --}}
        <div>
            <p class="text-sm text-gray-500 mb-2">تگ‌ها</p>
            @if(is_array($comment->tags) && count($comment->tags))
                <div class="flex flex-wrap gap-2">
                    @foreach($comment->tags as $tag)
                        <span class="bg-amber-50 text-amber-800 px-3 py-1 rounded-full text-sm border border-amber-200">{{ $tag }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">بدون تگ</p>
            @endif
        </div>

        {{-- تاریخ‌ها --}}
        <div class="flex justify-between border-t border-gray-100 pt-4 text-sm text-gray-500">
            <span>تاریخ ثبت: {{ $comment->created_at->format('Y/m/d H:i') }}</span>
            <span>آخرین ویرایش: {{ $comment->updated_at->format('Y/m/d H:i') }}</span>
        </div>

        {{-- عملیات سریع --}}
        <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
            <a href="{{ route('admin.comments.edit', $comment) }}" 
               class="inline-flex items-center gap-2 px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                ویرایش
            </a>

            <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-5 py-2 {{ $comment->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-xl transition text-sm font-medium">
                    @if($comment->is_active)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        غیرفعال کردن
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        فعال کردن
                    @endif
                </button>
            </form>
        </div>
    </div>
</div>
@endsection