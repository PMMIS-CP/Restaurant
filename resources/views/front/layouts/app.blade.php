<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'خانه')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- استایل‌های اضافه فرانت (بعداً اضافه کن) --}}
</head>
<body class="bg-white">
    {{-- هدر (بعداً با partials کامل می‌شه) --}}
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-orange-600">
                {{ config('app.name', 'رستوران') }}
            </a>
            <nav class="space-x-4 rtl:space-x-reverse">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-orange-600">خانه</a>
                <a href="#" class="text-gray-700 hover:text-orange-600">منو</a>
                <a href="#" class="text-gray-700 hover:text-orange-600">تماس</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600">داشبورد</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600">ورود</a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- محتوای اصلی --}}
    <main>
        @yield('content')
    </main>

    {{-- فوتر (بعداً کامل می‌شه) --}}
    <footer class="bg-gray-800 text-white py-4 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. تمام حقوق محفوظ است.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>