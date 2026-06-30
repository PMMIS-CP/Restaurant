@extends('front.layouts.auth')

@section('title', 'تأیید رمز عبور')

@section('page-title', 'تأیید هویت')

@section('content')
    <div class="mt-4 mb-6 text-sm text-gray-700">
        <p class="text-center">
            این بخش نیاز به تأیید امنیتی دارد. لطفاً رمز عبور خود را برای ادامه وارد کنید.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="mt-8 space-y-6">
        @csrf

        {{-- رمز عبور --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                رمز عبور
            </label>
            <input id="password" 
                   name="password" 
                   type="password" 
                   required 
                   autocomplete="current-password"
                   autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   placeholder="رمز عبور خود را وارد کنید">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- دکمه تأیید --}}
        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150">
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            تأیید رمز عبور
        </button>
    </form>

    {{-- لینک بازگشت --}}
    <div class="mt-6 text-center">
        <a href="{{ url()->previous() }}" 
           class="text-sm text-gray-600 hover:text-orange-600 transition">
            ← بازگشت به صفحه قبل
        </a>
    </div>
@endsection