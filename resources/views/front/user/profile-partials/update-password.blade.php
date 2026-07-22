<div class="p-6">
    <h2 class="text-lg! font-semibold text-gray-800 mb-1">تغییر رمز عبور</h2>
    <p class="text-sm text-gray-600 mb-6">برای امنیت بیشتر، از رمز عبور طولانی و تصادفی استفاده کنید.</p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        {{-- رمز فعلی --}}
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1">
                رمز عبور فعلی
            </label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password"
                   autocomplete="current-password"
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- رمز جدید --}}
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">
                رمز عبور جدید
            </label>
            <input id="update_password_password" 
                   name="password" 
                   type="password"
                   autocomplete="new-password"
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- تکرار رمز جدید --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                تکرار رمز عبور جدید
            </label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password"
                   autocomplete="new-password"
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- دکمه --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                    class="px-6 py-2.5 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                تغییر رمز عبور
            </button>

            @if (session('status') === 'password-updated')
                <span x-data="{ show: true }" 
                      x-show="show" 
                      x-transition 
                      x-init="setTimeout(() => show = false, 2000)"
                      class="text-sm text-green-600">
                    ✓ ذخیره شد
                </span>
            @endif
        </div>
    </form>
</div>