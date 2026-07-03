<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'fa' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#450a0a">

    <title>{{ config('app.name') }} | @yield('title', 'خانه')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.webp') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
    /* @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-Thin.woff2') format('woff2');
        font-weight: 100;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-ExtraLight.woff2') format('woff2');
        font-weight: 200;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-Light.woff2') format('woff2');
        font-weight: 300;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-Regular.woff2') format('woff2');
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-Medium.woff2') format('woff2');
        font-weight: 500;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-SemiBold.woff2') format('woff2');
        font-weight: 600;
        font-style: normal;
        font-display: swap;
    } */

    @font-face {
        font-family: 'Vazirmatn';
        src: url('assets/fonts/vazirmatn/Vazirmatn-Bold.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }

    /* @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-ExtraBold.woff2') format('woff2');
        font-weight: 800;
        font-style: normal;
        font-display: swap;
    }

    @font-face {
        font-family: 'Vazirmatn';
        src: url('../fonts/vazirmatn/Vazirmatn-Black.woff2') format('woff2');
        font-weight: 900;
        font-style: normal;
        font-display: swap;
    } */

    /* body {
        font-family: 'Vazirmatn';
        font-weight: 400;
    } */

    html:lang(fa) {
        font-family: 'Vazirmatn';
        font-weight: 700;
    }

    html:lang(en) {
        font-family: 'Inter', 'Vazirmatn', sans-serif;
    }
    </style>
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