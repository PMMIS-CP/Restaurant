@extends('front.layouts.auth')

@section('title', 'ثبت‌نام')

@section('page-title', 'ایجاد حساب کاربری')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">نام</label>
            <input id="name" name="name" type="text" required autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('name') }}">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input id="email" name="email" type="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('email') }}">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تکرار رمز عبور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            ثبت‌نام
        </button>

        <p class="text-center text-sm text-gray-600">
            قبلاً ثبت‌نام کرده‌اید؟
            <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500">وارد شوید</a>
        </p>
    </form>
@endsection