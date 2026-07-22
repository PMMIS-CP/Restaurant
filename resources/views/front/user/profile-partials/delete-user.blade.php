<div class="p-6">
    <h2 class="text-lg! font-semibold text-red-600 mb-1">حذف حساب کاربری</h2>
    <p class="text-sm text-gray-600 mb-6">
        پس از حذف حساب، تمام اطلاعات و داده‌های شما برای همیشه پاک خواهد شد. 
        لطفاً قبل از حذف، اطلاعات مورد نیاز خود را دانلود کنید.
    </p>

    <button x-data="" 
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
        حذف حساب
    </button>

    {{-- مودال تأیید حذف --}}
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-modal.window="$event.detail === 'confirm-user-deletion' ? show = true : null"
         x-on:close.stop="show = false"
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        
        {{-- Overlay --}}
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" x-on:click="show = false"></div>

        {{-- Modal Content --}}
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
                <h2! class="text-lg font-semibold text-gray-800 mb-2">
                    آیا از حذف حساب خود اطمینان دارید؟
                </h2>
                <p class="text-sm text-gray-600 mb-6">
                    پس از حذف حساب، تمام اطلاعات شما برای همیشه از بین خواهد رفت. 
                    لطفاً رمز عبور خود را برای تأیید وارد کنید.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-6">
                        <label for="password" class="sr-only">رمز عبور</label>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               placeholder="رمز عبور خود را وارد کنید"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        @error('password', 'userDeletion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" 
                                x-on:click="show = false"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                            انصراف
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            حذف حساب
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>