<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'پنل مدیریت') - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=vazirmatn:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    
    @stack('styles')
</head>
<body class="font-vazirmatn antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- نویگیشن بار ادمین -->
        <nav class="bg-zinc-900 border-b border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- لوگو -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-rose-500 font-bold text-xl">
                                {{ config('app.name') }} ادمین
                            </a>
                        </div>
                        
                        <!-- لینک‌های نویگیشن -->
                        <div class="hidden sm:flex sm:space-x-8 sm:rtl:space-x-reverse mr-10">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="text-white hover:text-rose-400 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-800' : '' }}">
                                داشبورد
                            </a>
                            <a href="{{ route('admin.reserves.index') }}" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                رزروها
                            </a>
                            <a href="{{ route('admin.menu.index') }}" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                منو سالن
                            </a>
                            <a href="{{ route('admin.takeout.index') }}" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                منو بیرون‌بر
                            </a>
                            <a href="{{ route('admin.organizational.index') }}" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                منو سازمانی
                            </a>
                            <a href="{{ route('admin.users.index') }}" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                کاربران
                            </a>
                            <a href="#" 
                               class="text-zinc-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                سفارشات
                            </a>
                        </div>
                    </div>
                    
                    <!-- کاربر ادمین و خروج -->
                    <div class="flex items-center">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <span class="text-zinc-400 text-sm ml-4">
                                {{ auth('admin')->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="text-zinc-400 hover:text-white text-sm">
                                    خروج
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- محتوای اصلی -->
        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>