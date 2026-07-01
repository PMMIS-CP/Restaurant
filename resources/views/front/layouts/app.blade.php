<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#450a0a">

    <title>{{ config('app.name') }} | @yield('title', 'خانه')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased max-w-full overflow-x-hidden">

    {{-- هدر --}}
    @include('front.partials.header')

    {{-- محتوای اصلی --}}
    <main class="min-h-screen max-w-full overflow-x-hidden">
        @yield('content')
    </main>

    {{-- فوتر --}}
    @include('front.partials.footer')

    @stack('scripts')
</body>
</html>