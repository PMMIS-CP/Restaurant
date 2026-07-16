@extends('admin.layouts.app')

@section('title', 'ویرایش رزرو')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">ویرایش رزرو #{{ $reserve->id }}</h1>
        <a href="{{ route('admin.reserves.show', $reserve->id) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors text-sm font-medium">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            بازگشت به جزئیات
        </a>
    </div>

    @if(session('error'))
        <div class="rounded-md bg-red-50 p-4 mb-6 text-sm text-red-700">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">فرم ویرایش</h3>
        </div>
        <div class="p-4 sm:p-6">
            <form action="{{ route('admin.reserves.update', $reserve->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">نام و نام خانوادگی <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $reserve->name) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">شماره تماس <span class="text-red-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $reserve->phone) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm dir-ltr" dir="ltr">
                        @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ایمیل</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $reserve->email) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm dir-ltr" dir="ltr">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="event_type" class="block text-sm font-medium text-gray-700 mb-1">نوع مراسم</label>
                        <input type="text" name="event_type" id="event_type" value="{{ old('event_type', $reserve->event_type) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label for="guest_count" class="block text-sm font-medium text-gray-700 mb-1">تعداد مهمان</label>
                        <input type="text" name="guest_count" id="guest_count" value="{{ old('guest_count', $reserve->guest_count) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>

                    <div>
                        <label for="reservation_date" class="block text-sm font-medium text-gray-700 mb-1">تاریخ رزرو <span class="text-red-500">*</span></label>
                        <input type="text" name="reservation_date" id="reservation_date" value="{{ old('reservation_date', $reserve->reservation_date) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('reservation_date') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="entry_time" class="block text-sm font-medium text-gray-700 mb-1">ساعت ورود <span class="text-red-500">*</span></label>
                        <input type="text" name="entry_time" id="entry_time" value="{{ old('entry_time', $reserve->entry_time) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('entry_time') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="exit_time" class="block text-sm font-medium text-gray-700 mb-1">ساعت خروج <span class="text-red-500">*</span></label>
                        <input type="text" name="exit_time" id="exit_time" value="{{ old('exit_time', $reserve->exit_time) }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('exit_time') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">توضیحات</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('description', $reserve->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('admin.reserves.show', $reserve->id) }}" 
                       class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 text-sm font-medium">
                        انصراف
                    </a>
                    <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 text-sm font-medium">
                        ذخیره تغییرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection