@extends('admin.layouts.app')

@section('title', 'مدیریت گردونه شانس')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800">جوایز گردونه شانس</h1>
        <a href="{{ route('admin.spins.create') }}" 
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            افزودن جایزه جدید
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-right">
                <thead class="bg-gray-50 text-gray-600 font-medium">
                    <tr>
                        <th class="px-6 py-4">نام جایزه</th>
                        <th class="px-6 py-4">رنگ</th>
                        <th class="px-6 py-4 text-center">احتمال (%)</th>
                        <th class="px-6 py-4 text-center">وضعیت</th>
                        <th class="px-6 py-4 text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($spins as $spin)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            {{-- نام جایزه --}}
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ $spin->name }}</p>
                            </td>

                            {{-- رنگ --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div style="background-color: {{ $spin->color }}" 
                                         class="w-8 h-8 rounded-full border-2 border-gray-200 shadow-sm"></div>
                                    <span class="text-xs text-gray-400 font-mono">{{ $spin->color }}</span>
                                </div>
                            </td>

                            {{-- احتمال --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $spin->probability }}%
                                </span>
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        غیرفعال
                                    </span>
                                @endif
                            </td>

                            {{-- عملیات --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- ویرایش --}}
                                    <a href="{{ route('admin.spins.edit', $spin->id) }}" 
                                       class="p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                       title="ویرایش">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    {{-- حذف --}}
                                    <form action="{{ route('admin.spins.destroy', $spin->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این جایزه اطمینان دارید؟')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-lg">
                                هنوز جایزه‌ای برای گردونه شانس تعریف نشده است.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection