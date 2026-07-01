<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'حساب کاربری')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center">
                <a href="{{ url('/') }}" class="text-3xl font-bold text-orange-600">
                    {{ config('app.name', 'Restaurant') }}
                </a>
                <h2 class="mt-2 text-2xl font-semibold text-gray-700">@yield('page-title')</h2>
            </div>

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>