@extends('admin.layouts.guest')

@section('title', 'ورود به پنل مدیریت')

@section('content')
<div class="min-h-screen bg-linear-to-br from-gray-900 via-red-950 to-gray-900 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Brand Area -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-linear-to-br from-yellow-500 to-amber-600 shadow-lg shadow-yellow-500/20 mb-4">
                <svg class="w-10 h-10 text-red-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-linear-to-r from-yellow-400 to-amber-400 bg-clip-text text-transparent">
                پنل مدیریت
            </h1>
            <p class="text-red-300/60 mt-2 text-sm">به بخش مدیریت رستوران خوش آمدید</p>
        </div>

        <!-- Login Card -->
        <div class="bg-gray-900/80 backdrop-blur-sm border border-red-800/30 rounded-2xl shadow-2xl shadow-black/50 p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-yellow-400">ورود به حساب کاربری</h2>
                <p class="text-red-300/50 text-sm mt-1">اطلاعات خود را وارد کنید</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="mb-4 p-3 rounded-xl bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-yellow-400/80 text-sm font-medium mb-2">
                        آدرس ایمیل
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-red-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            class="w-full pr-10 pl-4 py-3 bg-red-950/50 border border-red-800/50 rounded-xl text-yellow-100 placeholder-red-300/30 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20 transition-all duration-300"
                            required 
                            autofocus
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-yellow-400/80 text-sm font-medium mb-2">
                        رمز عبور
                    </label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-red-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            :type="show ? 'text' : 'password'"
                            name="password" 
                            id="password" 
                            placeholder="••••••••"
                            class="w-full pr-10 pl-12 py-3 bg-red-950/50 border border-red-800/50 rounded-xl text-yellow-100 placeholder-red-300/30 focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-500/20 transition-all duration-300"
                            required
                        >
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <button type="button" @click="show = !show" class="text-red-400/50 hover:text-yellow-400 transition-colors">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-2 text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember_me"
                            class="w-4 h-4 rounded bg-red-950/50 border-red-800/50 text-yellow-500 focus:ring-yellow-500/30"
                        >
                        <span class="mr-2 text-sm text-red-300/70">مرا به خاطر بسپار</span>
                    </label>

                    @if(isset($password_reset_route))
                        <a href="{{ $password_reset_route }}" class="text-sm text-yellow-400/70 hover:text-yellow-400 transition-colors">
                            رمز عبور را فراموش کردید؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-linear-to-r from-yellow-500 to-amber-500 hover:from-yellow-400 hover:to-amber-400 text-red-950 font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-yellow-500/50 shadow-lg shadow-yellow-500/20">
                    ورود به پنل
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-red-300/30 text-xs">
                © {{ date('Y') }} تمامی حقوق محفوظ است
            </p>
        </div>
    </div>
</div>
@endsection