<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'پنل مدیریت') | {{ config('app.name', 'رستوران') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.webp') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="font-[Vazirmatn] antialiased">
    <main>
        @yield('content')
    </main>
</body>
</html>