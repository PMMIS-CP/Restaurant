@extends('admin.layouts.app')

@section('title', 'داشبورد')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- کارت تعداد کاربران -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div class="mr-4">
                <h3 class="text-gray-500 text-sm">کل کاربران</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
            </div>
        </div>
    </div>

    <!-- کارت تعداد رزروها -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="mr-4">
                <h3 class="text-gray-500 text-sm">کل رزروها</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_reservations'] }}</p>
            </div>
        </div>
    </div>

    <!-- کارت تعداد سفارشات -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="mr-4">
                <h3 class="text-gray-500 text-sm">کل سفارشات</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
    </div>

    <!-- کارت آیتم‌های منو -->
    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
        <div class="flex items-center">
            <div class="p-3 bg-rose-100 rounded-full">
                <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <div class="mr-4">
                <h3 class="text-gray-500 text-sm">آیتم‌های منو سالن</h3>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_menu_items'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- جداول اخیر -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- رزروهای اخیر -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">رزروهای اخیر</h3>
        </div>
        <div class="p-6">
            @if(count($stats['recent_reservations']) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">تاریخ</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($stats['recent_reservations'] as $reservation)
                            <tr>
                                <td class="px-4 py-3 text-sm">{{ $reservation->user->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $reservation->date }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        {{ $reservation->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">هیچ رزروی وجود ندارد</p>
            @endif
        </div>
    </div>

    <!-- سفارشات اخیر -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">سفارشات اخیر</h3>
        </div>
        <div class="p-6">
            @if(count($stats['recent_orders']) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">سفارش</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">مبلغ</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($stats['recent_orders'] as $order)
                            <tr>
                                <td class="px-4 py-3 text-sm">#{{ $order->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ number_format($order->total) }} تومان</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">هیچ سفارشی وجود ندارد</p>
            @endif
        </div>
    </div>
</div>
@endsection