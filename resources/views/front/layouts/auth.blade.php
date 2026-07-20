<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ __('app.name') }} | @hasSection('title') @yield('title') @else {{ __('auth.login.page_title') }} @endif</title>
    <meta name="description" content="@yield('meta_description', __('auth.meta_description'))">
    <link rel="canonical" href="{{ url()->current() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <main role="main">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>