@extends('front.layouts.auth')

@section('title', __('auth.reset_password.title'))

@section('page-title', __('auth.reset_password.page_title'))

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('auth.reset_password.email_label') }}</label>
            <input id="email" name="email" type="email" required readonly
                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm"
                   value="{{ old('email', request()->email) }}">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('auth.reset_password.new_password_label') }}</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('auth.reset_password.confirm_password_label') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
        </div>

        <button type="submit"
                class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
            {{ __('auth.reset_password.button') }}
        </button>
    </form>
@endsection