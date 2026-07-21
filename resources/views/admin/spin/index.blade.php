@extends('admin.layouts.app')

@section('title', 'مدیریت گردونه شانس')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">جوایز گردونه شانس</h1>
            <p class="text-sm text-gray-500 mt-1">مدیریت ۱۰ جایزه پیش‌فرض گردونه</p>
        </div>
        <div class="flex items-center gap-3">
            @php
                $activeCount = collect($displaySpins)->where('is_active', true)->count();
            @endphp
            <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                جوایز فعال: {{ $activeCount }} از ۱۰
            </span>
        </div>
    </div>

    {{-- پیام راهنما --}}
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
        <div class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-sm text-yellow-800">
                <p class="font-medium mb-1">نحوه مدیریت جوایز:</p>
                <ul class="list-disc list-inside space-y-1 text-yellow-700">
                    <li>حداقل <strong>۲</strong> و حداکثر <strong>۱۰</strong> جایزه باید فعال باشد.</li>
                    <li>درصد شانس به صورت خودکار و مساوی بین جوایز فعال تقسیم می‌شود.</li>
                    <li>برای فعال‌سازی هر جایزه، ابتدا باید نام آن را وارد کنید.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-right">
                <thead class="bg-gray-50 text-gray-600 font-medium">
                    <tr>
                        <th class="px-6 py-4">شماره</th>
                        <th class="px-6 py-4">نام جایزه</th>
                        <th class="px-6 py-4">رنگ</th>
                        <th class="px-6 py-4 text-center">درصد شانس</th>
                        <th class="px-6 py-4 text-center">وضعیت</th>
                        <th class="px-6 py-4 text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($displaySpins as $spin)
                        <tr class="hover:bg-gray-50/50 transition-colors {{ !$spin->is_active ? 'bg-gray-50/30' : '' }}">
                            {{-- شماره --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-600 text-xs font-bold">
                                    {{ $spin->id }}
                                </span>
                            </td>

                            {{-- نام جایزه --}}
                            <td class="px-6 py-4">
                                @if($spin->name)
                                    <p class="font-medium text-gray-800">{{ $spin->name }}</p>
                                @else
                                    <p class="text-gray-400 italic">تعریف نشده</p>
                                @endif
                            </td>

                            {{-- رنگ --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div style="background-color: {{ $spin->color }}" 
                                         class="w-8 h-8 rounded-full border-2 {{ $spin->is_active ? 'border-gray-300' : 'border-gray-200 opacity-50' }} shadow-sm"></div>
                                    <span class="text-xs text-gray-400 font-mono">{{ $spin->color }}</span>
                                </div>
                            </td>

                            {{-- درصد شانس --}}
                            <td class="px-6 py-4 text-center">
                                @if($spin->is_active && $spin->probability > 0)
                                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        {{ $spin->probability }}%
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-50 text-gray-400 px-3 py-1 rounded-full text-xs font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                        ۰%
                                    </span>
                                @endif
                            </td>

                            {{-- وضعیت --}}
                            <td class="px-6 py-4 text-center">
                                @if($spin->is_active)
                                    <span class="inline-flex items-center gap-1 text-green-700 bg-green-50 px-3 py-1 rounded-full text-xs font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                        </svg>
                                        فعال
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-red-700 bg-red-50 px-3 py-1 rounded-full text-xs font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                        </svg>
                                        غیرفعال
                                    </span>
                                @endif
                            </td>

                            {{-- عملیات --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center">
                                    {{-- فقط دکمه ویرایش --}}
                                    <a href="{{ route('admin.spins.edit', $spin->id) }}" 
                                       class="inline-flex items-center gap-1 p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                       title="ویرایش جایزه">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="text-xs">ویرایش</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection