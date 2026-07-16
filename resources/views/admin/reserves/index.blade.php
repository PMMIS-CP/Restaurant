{{-- resources/views/admin/reserves/index.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'مدیریت رزروها')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">لیست درخواست‌های رزرو</h1>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 w-fit">
            {{ $reserves->total() }} درخواست
        </span>
    </div>

    {{-- پیام موفقیت / خطا --}}
    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6 flex items-start gap-3">
            <div class="flex-1 text-sm text-green-700">{{ session('success') }}</div>
            <button type="button" class="text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-md bg-red-50 p-4 mb-6 flex items-start gap-3">
            <div class="flex-1 text-sm text-red-700">{{ session('error') }}</div>
            <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    {{-- Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 sm:p-6">
            
            {{-- نمایش کارتی برای موبایل --}}
            <div class="block lg:hidden space-y-4">
                @forelse($reserves as $reserve)
                <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    {{-- هدر کارت --}}
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-medium text-gray-500">#{{ $reserves->firstItem() + $loop->index }}</span>
                            <h3 class="font-semibold text-gray-900">{{ $reserve->name }}</h3>
                        </div>
                        @if($reserve->status === 'pending')
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">در انتظار</span>
                        @elseif($reserve->status === 'confirmed')
                            <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">تأیید شده</span>
                        @elseif($reserve->status === 'rejected')
                            <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">رد شده</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">{{ $reserve->status }}</span>
                        @endif
                    </div>

                    {{-- اطلاعات --}}
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                        <div><span class="text-gray-500 text-xs">شماره تماس:</span><p class="text-gray-900 dir-ltr" dir="ltr">{{ $reserve->phone }}</p></div>
                        <div><span class="text-gray-500 text-xs">ایمیل:</span><p class="text-gray-900 truncate">{{ $reserve->email ?? '-' }}</p></div>
                        <div><span class="text-gray-500 text-xs">نوع مراسم:</span><p class="text-gray-900">{{ $reserve->event_type ?? '-' }}</p></div>
                        <div><span class="text-gray-500 text-xs">تعداد مهمان:</span><p class="text-gray-900">{{ $reserve->guest_count ?? '-' }} نفر</p></div>
                        <div><span class="text-gray-500 text-xs">تاریخ رزرو:</span><p class="text-gray-900">{{ $reserve->reservation_date }}</p></div>
                        <div><span class="text-gray-500 text-xs">ساعت:</span><p class="text-gray-900">{{ $reserve->entry_time }} تا {{ $reserve->exit_time }}</p></div>
                        <div class="col-span-2"><span class="text-gray-500 text-xs">تاریخ ثبت:</span><p class="text-gray-900">{{ $reserve->created_at->format('Y/m/d H:i') }}</p></div>
                    </div>

                    {{-- دکمه‌های عملیات --}}
                    <div class="flex flex-wrap items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.reserves.show', $reserve->id) }}" 
                           class="flex-1 min-w-20 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-md text-white text-xs font-medium bg-sky-500 hover:bg-sky-600 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            مشاهده
                        </a>
                        @if($reserve->status !== 'confirmed')
                        <a href="{{ route('admin.reserves.edit', $reserve->id) }}" 
                           class="flex-1 min-w-20 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-md text-white text-xs font-medium bg-amber-500 hover:bg-amber-600 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            ویرایش
                        </a>
                        @endif
                        @if($reserve->status === 'pending')
                        <form action="{{ route('admin.reserves.status', $reserve->id) }}" method="POST" class="flex-1 min-w-20">
                            @csrf
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-md text-white text-xs font-medium bg-green-500 hover:bg-green-600 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                تأیید
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.reserves.destroy', $reserve->id) }}" 
                              method="POST" 
                              class="flex-1 min-w-20"
                              onsubmit="return confirm('آیا از حذف این رزرو اطمینان دارید؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-md text-white text-xs font-medium bg-red-500 hover:bg-red-600 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="flex flex-col items-center text-gray-400">
                        <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-base">هیچ درخواست رزروی ثبت نشده است.</p>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- نمایش جدولی برای دسکتاپ --}}
            <div class="hidden lg:block">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">#</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">نام</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">شماره تماس</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">نوع مراسم</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">تاریخ رزرو</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">وضعیت</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">تاریخ ثبت</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-700">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($reserves as $reserve)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-600">{{ $reserves->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $reserve->name }}</td>
                            <td class="px-4 py-3 text-gray-600 dir-ltr" dir="ltr">{{ $reserve->phone }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $reserve->event_type ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $reserve->reservation_date }}</td>
                            <td class="px-4 py-3">
                                @if($reserve->status === 'pending')
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">در انتظار</span>
                                @elseif($reserve->status === 'confirmed')
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">تأیید شده</span>
                                @elseif($reserve->status === 'rejected')
                                    <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">رد شده</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">{{ $reserve->status }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $reserve->created_at->format('Y/m/d H:i') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('admin.reserves.show', $reserve->id) }}" class="p-1.5 rounded-md text-white bg-sky-500 hover:bg-sky-600" title="مشاهده">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    @if($reserve->status !== 'confirmed')
                                    <a href="{{ route('admin.reserves.edit', $reserve->id) }}" class="p-1.5 rounded-md text-white bg-amber-500 hover:bg-amber-600" title="ویرایش">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    @endif
                                    @if($reserve->status === 'pending')
                                    <form action="{{ route('admin.reserves.status', $reserve->id) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="p-1.5 rounded-md text-white bg-green-500 hover:bg-green-600" title="تأیید نهایی">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.reserves.destroy', $reserve->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این رزرو اطمینان دارید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-md text-white bg-red-500 hover:bg-red-600" title="حذف">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p>هیچ درخواست رزروی ثبت نشده است.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- صفحه‌بندی --}}
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm text-gray-600">
                <div>نمایش {{ $reserves->firstItem() ?? 0 }} تا {{ $reserves->lastItem() ?? 0 }} از {{ $reserves->total() }} نتیجه</div>
                <div>{{ $reserves->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection