{{-- resources/views/admin/menu/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'مدیریت منو')

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">مدیریت منو</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.menu-categories.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                مدیریت دسته‌بندی‌ها
            </a>
            <a href="{{ route('admin.menu.create') }}" 
               class="bg-rose-500 hover:bg-rose-600 text-white px-4 py-2 rounded-lg transition-colors">
                + افزودن غذای جدید
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">#</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">تصویر</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام (فارسی)</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">نام (انگلیسی)</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">دسته‌بندی</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">قیمت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">وضعیت</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">عملیات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($menuItems as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $loop->iteration + ($menuItems->currentPage() - 1) * $menuItems->perPage() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $images = $item->images ?? [];
                            $firstImage = $images[0] ?? null;
                            $imageCount = count($images);
                        @endphp
                        @if($firstImage)
                            <div class="relative">
                                <img src="{{ Storage::disk('public')->url($firstImage) }}" 
                                     alt="{{ $item->getNameInLocale('fa') }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                                @if($imageCount > 1)
                                    <span class="absolute -bottom-1 -right-1 bg-rose-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                        {{ $imageCount }}
                                    </span>
                                @endif
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->getNameInLocale('fa') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" dir="ltr">
                        {{ $item->getNameInLocale('en') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-gray-100 rounded-full text-xs">
                            {{ $item->category->name_fa ?? 'بدون دسته' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ number_format($item->price) }} تومان
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer toggle-active" data-id="{{ $item->id }}"
                                   {{ $item->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-rose-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:inset-s-0.5 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-500">
                            </div>
                            <span class="mr-3 text-sm font-medium text-gray-700 toggle-label">
                                {{ $item->is_active ? 'موجود' : 'ناموجود' }}
                            </span>
                        </label>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <a href="{{ route('admin.menu.edit', $item) }}" class="text-blue-600 hover:text-blue-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.menu.destroy', $item) }}" method="POST" 
                                  onsubmit="return confirm('آیا از حذف این آیتم مطمئن هستید؟')" class="inline">
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
                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <p class="text-lg">هیچ آیتمی در منو وجود ندارد</p>
                        <a href="{{ route('admin.menu.create') }}" class="text-rose-500 hover:text-rose-600 mt-2 inline-block">
                            ایجاد اولین آیتم منو
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($menuItems->hasPages())
    <div class="p-6 border-t border-gray-200">
        {{ $menuItems->links() }}
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleSwitches = document.querySelectorAll('.toggle-active');
    toggleSwitches.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const id = this.dataset.id;
            const label = this.parentElement.querySelector('.toggle-label');
            fetch(`/admin/menu/${id}/toggle-active`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    label.textContent = this.checked ? 'موجود' : 'ناموجود';
                } else {
                    this.checked = !this.checked;
                    alert('خطا در تغییر وضعیت!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !this.checked;
                alert('خطا در برقراری ارتباط با سرور!');
            });
        });
    });
});
</script>
@endpush
@endsection