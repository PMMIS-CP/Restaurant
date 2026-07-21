@extends('admin.layouts.app')

@section('title', 'جزئیات رزرو')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">جزئیات رزرو #{{ $reserve->id }}</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.reserves.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors text-sm font-medium">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                بازگشت به لیست
            </a>
            @if($reserve->status !== 'confirmed')
            <a href="{{ route('admin.reserves.edit', $reserve->id) }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-amber-500 text-white hover:bg-amber-600 transition-colors text-sm font-medium">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                ویرایش
            </a>
            @endif
            @if($reserve->status === 'pending')
            <form action="{{ route('admin.reserves.status', $reserve->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="confirmed">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-green-500 text-white hover:bg-green-600 transition-colors text-sm font-medium">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    تأیید نهایی
                </button>
            </form>
            @endif
        </div>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">اطلاعات ثبت‌شده</h3>
        </div>
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><label class="block text-sm font-medium text-gray-500 mb-1">نام و نام خانوادگی</label><p class="text-base text-gray-900">{{ $reserve->name }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">شماره تماس</label><p class="text-base text-gray-900 dir-ltr" dir="ltr">{{ $reserve->phone }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">ایمیل</label><p class="text-base text-gray-900">{{ $reserve->email ?? 'وارد نشده' }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">نوع مراسم</label><p class="text-base text-gray-900">{{ $reserve->event_type ?? 'تعیین نشده' }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">تعداد مهمان</label><p class="text-base text-gray-900">{{ $reserve->guest_count ?? 'تعیین نشده' }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">تاریخ رزرو</label><p class="text-base text-gray-900">{{ $reserve->reservation_date }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">ساعت ورود</label><p class="text-base text-gray-900">{{ $reserve->entry_time }}</p></div>
                <div><label class="block text-sm font-medium text-gray-500 mb-1">ساعت خروج</label><p class="text-base text-gray-900">{{ $reserve->exit_time }}</p></div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">وضعیت</label>
                    <p>
                        @if($reserve->status === 'pending')
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-800">در انتظار بررسی</span>
                        @elseif($reserve->status === 'confirmed')
                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">تأیید شده</span>
                        @elseif($reserve->status === 'rejected')
                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800">رد شده</span>
                        @endif
                    </p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">توضیحات</label>
                    <div class="p-4 bg-gray-50 rounded-md text-gray-700">{{ $reserve->description ?? 'بدون توضیحات' }}</div>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-400">تاریخ ثبت: {{ $reserve->created_at->format('Y/m/d ساعت H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection