@extends('front.layouts.auth')

@section('title', __('auth.forgot_password.title'))

@section('page-title', __('auth.forgot_password.page_title'))

@section('content')
    <div class="mt-8 text-sm text-gray-600">
        {{ __('auth.forgot_password.message') }}
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="mt-4 space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth.forgot_password.email_label') }}</label>
            <input id="email" name="email" type="email" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                   value="{{ old('email') }}">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            {{ __('auth.forgot_password.send_link') }}
        </button>

        <p class="text-center text-sm text-gray-600">
            <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500">{{ __('auth.forgot_password.back_to_login') }}</a>
        </p>
    </form>
@endsection