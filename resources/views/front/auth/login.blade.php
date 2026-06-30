@extends('front.layouts.auth')

@section('title', 'ورود')

@section('page-title', 'ورود به حساب کاربری')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input id="email" name="email" type="email" required autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('email') }}">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                <span class="mr-2 text-sm text-gray-600">مرا به خاطر بسپار</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-orange-600 hover:text-orange-500">
                    رمز عبور را فراموش کردید؟
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            ورود
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600">
                حساب کاربری ندارید؟
                <a href="{{ route('register') }}" class="font-medium text-orange-600 hover:text-orange-500">
                    ثبت‌نام کنید
                </a>
            </p>
        @endif
    </form>
@endsection