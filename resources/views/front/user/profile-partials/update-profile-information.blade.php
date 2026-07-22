<div class="p-6">
    <h2 class="text-lg! font-semibold text-gray-800 mb-1">اطلاعات کاربری</h2>
    <p class="text-sm text-gray-600 mb-6">اطلاعات پروفایل و ایمیل خود را به‌روزرسانی کنید.</p>

    {{-- فرم تأیید ایمیل (مخفی) --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        {{-- نام --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">نام</label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   value="{{ old('name', auth()->user()->name) }}" 
                   required 
                   autofocus
                   autocomplete="name"
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- ایمیل --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">ایمیل</label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   value="{{ old('email', auth()->user()->email) }}" 
                   required
                   autocomplete="username"
                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            {{-- هشدار تأیید ایمیل --}}
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800 mb-2">
                        ⚠️ ایمیل شما هنوز تأیید نشده است.
                    </p>
                    <button form="send-verification" 
                            class="text-sm text-orange-600 hover:text-orange-700 underline">
                        برای دریافت لینک تأیید کلیک کنید
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            ✓ لینک تأیید جدید به ایمیل شما ارسال شد.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- دکمه ذخیره --}}
        <div class="flex items-center gap-4">
            <button type="submit"
                    class="px-6 py-2.5 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 transition">
                ذخیره تغییرات
            </button>

            @if (session('status') === 'profile-updated')
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