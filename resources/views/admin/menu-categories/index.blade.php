{{-- resources/views/admin/menu-categories/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'مدیریت دسته‌بندی‌ها')

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">مدیریت دسته‌بندی‌ها</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.menu.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                    بازگشت به منو
                </a>
                <a href="{{ route('admin.menu-categories.create') }}" 
                   class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg transition-colors">
                    + ایجاد دسته‌بندی جدید
                </a>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام فارسی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام انگلیسی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام عربی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">تعداد غذاها</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $category->name_fa }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" dir="ltr">
                        {{ $category->name_en }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" dir="rtl">
                        {{ $category->name_ar }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                            {{ $category->menus_count }} غذا
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <a href="{{ route('admin.menu-categories.edit', $category) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.menu-categories.destroy', $category) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('هشدار! با حذف این دسته‌بندی، تمام غذاهای مرتبط با آن نیز حذف خواهند شد. آیا مطمئن هستید؟')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <p class="text-lg">هیچ دسته‌بندی‌ای وجود ندارد</p>
                        <a href="{{ route('admin.menu-categories.create') }}" class="text-rose-500 hover:text-rose-600 mt-2 inline-block">
                            ایجاد اولین دسته‌بندی
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection