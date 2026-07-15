{{-- resources/views/front/user/dashboard.blade.php --}}
@extends('front.layouts.app')

@section('title', 'داشبورد کاربری')

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- هدر داشبورد --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">داشبورد من</h1>
        <p class="text-gray-600 mt-2">خوش آمدید، {{ auth()->user()->name }} 👋</p>
    </div>

    {{-- کارت‌های آمار --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        {{-- سفارش‌های فعال --}}
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">سفارش‌های فعال</p>
                    <p class="text-3xl font-bold text-orange-600">۰</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- رزروهای فعال --}}
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">رزروهای فعال</p>
                    <p class="text-3xl font-bold text-green-600">{{ $activeReservationsCount }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- رزروهای امروز --}}
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">کل رزروها</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $activeReservationsCount }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- بخش‌های اصلی --}}
    <div class="grid grid-cols-1 gap-8">

        {{-- رزروهای من --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">رزروهای من</h2>
                <a href="#" class="text-sm text-orange-600 hover:text-orange-700">
                    رزرو جدید ←
                </a>
            </div>

            @if($upcomingReservations->isNotEmpty())
                <div class="space-y-4">
                    @foreach($upcomingReservations as $reservation)
                        <div class="border rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    {{-- نمایش تاریخ به صورت رشته مستقیم از دیتابیس --}}
                                    <p class="font-medium text-gray-800">
                                        📅 {{ $reservation->reservation_date }}
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $reservation->event_type ?? 'بدون عنوان' }}
                                    </p>
                                </div>
                                {{-- وضعیت رزرو --}}
                                <span class="px-3 py-1 text-sm rounded-full 
                                    @if($reservation->status == 'confirmed')
                                    @elseif($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($reservation->status == 'cancelled')
                                    @else
                                    @endif">
                                    @switch($reservation->status)
                                        @case('confirmed') تأیید شده @break
                                        @case('pending') در انتظار تأیید @break
                                        @case('cancelled') لغو شده @break
                                        @default {{ $reservation->status }}
                                    @endswitch
                                </span>
                            </div>
                            <div class="flex flex-wrap text-sm text-gray-600 gap-x-4 gap-y-1">
                                <span>🕒 {{ $reservation->entry_time }} تا {{ $reservation->exit_time }}</span>
                                <span>👥 {{ $reservation->guest_count }} نفر</span>
                                @if($reservation->description)
                                    <span class="text-gray-400 truncate max-w-50">📝 {{ $reservation->description }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 mb-2">هنوز هیچ رزروی ثبت نکرده‌اید</p>
                    <a href="#" class="inline-block mt-2 px-4 py-2 bg-orange-600 text-white rounded-md text-sm hover:bg-orange-700 transition">
                        رزرو میز
                    </a>
                </div>
            @endif
        </div>

    </div>

    {{-- منوی سریع --}}
    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('profile.edit') }}" 
           class="bg-white rounded-lg shadow p-4 flex flex-col items-center hover:shadow-md transition text-center">
            <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-sm font-medium text-gray-700">ویرایش پروفایل</span>
        </a>

        <a href="#" 
           class="bg-white rounded-lg shadow p-4 flex flex-col items-center hover:shadow-md transition text-center">
            <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <span class="text-sm font-medium text-gray-700">سفارش‌های من</span>
        </a>

        <a href="#" 
           class="bg-white rounded-lg shadow p-4 flex flex-col items-center hover:shadow-md transition text-center">
            <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="text-sm font-medium text-gray-700">رزروهای من</span>
        </a>

        <a href="{{ route('reserve') }}" 
           class="bg-white rounded-lg shadow p-4 flex flex-col items-center hover:shadow-md transition text-center">
            <svg class="w-8 h-8 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span class="text-sm font-medium text-gray-700">رزرو جدید</span>
        </a>
    </div>
</div>
@endsection