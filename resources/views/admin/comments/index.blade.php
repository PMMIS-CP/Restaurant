@extends('admin.layouts.app')

@section('title', 'مدیریت نظرات')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800">نظرات ثبت‌شده</h1>
        <div class="text-sm text-gray-500">
            نظرات جدید به‌صورت پیش‌فرض <span class="font-semibold text-red-600">غیرفعال</span> ذخیره می‌شوند.
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-right">
                <thead class="bg-gray-50 text-gray-600 font-medium">
                    <tr>
                        <th class="px-6 py-4">کاربر</th>
                        <th class="px-6 py-4">فرستنده (نمایشی)</th>
                        <th class="px-6 py-4">نظر</th>
                        <th class="px-6 py-4">تگ‌ها</th>
                        <th class="px-6 py-4 text-center">وضعیت</th>
                        <th class="px-6 py-4 text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            {{-- کاربر ارسال‌کننده --}}
                            <td class="px-6 py-4">
                                @if($comment->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-[#8B0000]/10 flex items-center justify-center text-[#8B0000] font-bold text-sm">
                                            {{ Str::substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $comment->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $comment->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-xs">مهمان (بدون اکانت)</span>
                                @endif
                            </td>

                            {{-- نام نمایشی --}}
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $comment->name }}</td>

                            {{-- متن نظر --}}
                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">{{ Str::limit($comment->comment, 60) }}</td>

                            {{-- تگ‌ها --}}
                            <td class="px-6 py-4">
                                @if(is_array($comment->tags) && count($comment->tags))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($comment->tags as $tag)
                                            <span class="inline-block bg-amber-50 text-amber-800 text-xs px-2 py-0.5 rounded-full border border-amber-200">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">_</span>
                                @endif
                            </td>

                            {{-- وضعیت --}}
                            <td class="px-6 py-4 text-center">
                                @if($comment->is_active)
                                    <span class="inline-flex items-center gap-1 text-green-700 bg-green-50 px-3 py-1 rounded-full text-xs font-medium">
                                        فعال
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-red-700 bg-red-50 px-3 py-1 rounded-full text-xs font-medium">
                                        غیرفعال
                                    </span>
                                @endif
                            </td>

                            {{-- عملیات --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- مشاهده --}}
                                    <a href="{{ route('admin.comments.show', $comment) }}" 
                                       class="p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 transition"
                                       title="مشاهده">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>

                                    {{-- ویرایش --}}
                                    <a href="{{ route('admin.comments.edit', $comment) }}" 
                                       class="p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                       title="ویرایش">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- تغییر وضعیت --}}
                                    <form action="{{ route('admin.comments.toggle', $comment) }}" method="POST" title="{{ $comment->is_active ? 'غیرفعال کردن' : 'فعال کردن' }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="p-2 rounded-lg transition {{ $comment->is_active ? 'text-red-500 hover:text-red-700 hover:bg-red-50' : 'text-green-500 hover:text-green-700 hover:bg-green-50' }}">
                                            @if($comment->is_active)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>

                                    {{-- حذف --}}
                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('آیا از حذف این نظر اطمینان دارید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-red-50 transition"
                                                title="حذف">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-lg">
                                هنوز نظری ثبت نشده است.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($comments->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection