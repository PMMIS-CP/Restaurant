<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'خانه')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- استایل‌های اضافه فرانت (بعداً اضافه کن) --}}
</head>
<body class="bg-gray-50 font-sans antialiased">

    {{-- هدر --}}
    @include('front.partials.header')

    {{-- محتوای اصلی --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- فوتر --}}
    @include('front.partials.footer')

    @stack('scripts')
</body>
</html>