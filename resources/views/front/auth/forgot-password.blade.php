@extends('front.layouts.auth')

@section('title', 'فراموشی رمز')

@section('page-title', 'بازیابی رمز عبور')

@section('content')
    <div class="mt-8 text-sm text-gray-600">
        ایمیل خود را وارد کنید تا لینک بازیابی برایتان ارسال شود.
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="mt-4 space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input id="email" name="email" type="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('email') }}">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            ارسال لینک
        </button>

        <p class="text-center text-sm text-gray-600">
            <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500">بازگشت به ورود</a>
        </p>
    </form>
@endsection