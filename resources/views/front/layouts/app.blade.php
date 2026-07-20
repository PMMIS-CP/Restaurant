<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ in_array(app()->getLocale(), ['fa', 'ar']) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#450a0a">
    
    {{-- SEO Basics --}}
    <title>@yield('title', __('app.name'))</title>
    <meta name="description" content="@yield('meta_description', __('app.default_description'))">
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Open Graph / Social Media (Facebook, Telegram, WhatsApp) --}}
    <meta property="og:title" content="@yield('title', __('app.name'))">
    <meta property="og:description" content="@yield('meta_description', __('app.default_description'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ __('app.name') }}">
    <meta property="og:locale" content="{{ app()->getLocale() }}">
    {{-- تصویر بهینه شده شما --}}
    <meta property="og:image" content="{{ asset('assets/images/og-image.webp') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ __('app.og_image_alt') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', __('app.default_description'))">
    <meta name="twitter:image" content="{{ asset('assets/images/og-image.webp') }}">
    
    {{-- Favicon & Assets --}}
    <link rel="icon" type="image/webp" href="{{ asset('assets/logo/logo.webp') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400;700;900&family=Nunito:wght@200..1000&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body.loading {
            overflow: hidden;
        }
    </style>
    <style>

    @font-face {
        font-family: 'Vazirmatn';
        src: url('/assets/fonts/vazirmatn/Vazirmatn-Bold.woff2') format('woff2');
        font-weight: 700;
        font-style: normal;
        font-display: swap;
    }
    @font-face {
        font-family: 'TAN-Pearl';
        src: url('/assets/fonts/TANPearl/TAN-Pearl-Regular.woff2') format('woff2');
        font-style: normal;
        font-display: swap;
    }

    html:lang(fa) {
        font-family: 'Vazirmatn';
        font-weight: 700;
    }
    html:lang(ar) {
        font-family: 'Vazirmatn';
        font-weight: 700;
    }
    html:lang(en) {
        font-family: "Lato", system-ui, sans-serif;
    }
    h1:lang(en), h2:lang(en){
        font-family: 'TAN-Pearl', sans-serif;
    }
    h1:lang(en) {
        font-size: 4rem;
        letter-spacing: 0.05em;
        line-height: 1.4;
    }

    h2:lang(en) {
        font-size: 2rem;
        letter-spacing: 0.03em;
        line-height: 1.5;
    }
    </style>

</head>
<body class="bg-gray-50 antialiased max-w-full w-full">
    <div id="loader" style="position: fixed; inset: 0; z-index: 9999; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: white; transition: opacity 0.5s ease; padding: 1rem;">
        <div style="position: relative; width: 8rem; height: 8rem; margin-bottom: 2.5rem; display: flex; align-items: center; justify-content: center;">
            <svg style="position: absolute; inset: 0; width: 100%; height: 100%; animation: spin-linear 10s linear infinite;" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="47" stroke="#FDE68A" stroke-width="2" fill="none" stroke-dasharray="10 10"></circle>
            </svg>
            <div style="position: relative; width: 5rem; height: 5rem; animation: pulse-slow 4s ease-in-out infinite;">
                <svg style="width: 100%; height: 100%; color: #164e63;" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0L14.59 8.41L23 12L14.59 15.59L12 24L9.41 15.59L1 12L9.41 8.41L12 0Z" opacity="0.3"/>
                </svg>
                <svg style="position: absolute; inset: 0; width: 100%; height: 100%; transform: rotate(-45deg); animation: spin-reverse-linear 4s linear infinite;" viewBox="0 0 24 24">
                    <defs>
                        <linearGradient id="morocco-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#164E63" /> <stop offset="100%" stop-color="#06B6D4" />
                        </linearGradient>
                    </defs>
                    <path d="M12 0L14.59 8.41L23 12L14.59 15.59L12 24L9.41 15.59L1 12L9.41 8.41L12 0Z" fill="url(#morocco-gradient)"/>
                </svg>
            </div>
            <div style="position: absolute; width: 1.5rem; height: 1.5rem; background-color: #f59e0b; border-radius: 9999px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 2px solid white; animation: pulse-fast 1.5s infinite;">
                <div style="width: 0.75rem; height: 0.75rem; background-color: #fee2e2; border-radius: 9999px;"></div>
            </div>
        </div>
        <div style="text-align: center; max-width: 28rem;">
            <p style="font-size: 1.875rem; font-weight: 700; color: #111827; margin: 0;">{!! __('loading.welcome') !!}</p>
            <p style="font-size: 1.125rem; color: #374151; margin-top: 0.75rem; font-weight: 500;">{!! __('loading.preparing') !!}</p>
        </div>
    </div>
    <style>
        @keyframes spin-linear { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        @keyframes spin-reverse-linear { from { transform: rotate(-45deg); } to { transform: rotate(-405deg); } }
        @keyframes pulse-slow { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.7; transform: scale(0.95); } }
        @keyframes pulse-fast { 0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(217, 119, 6, 0.4); } 50% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(217, 119, 6, 0); } }
    </style>
    {{-- هدر --}}
    @if(!isset($hideHeader) || !$hideHeader)
        @include('front.partials.header')
    @endif

    {{-- محتوای اصلی --}}
    <main class="min-h-screen max-w-full w-full">
        @yield('content')
    </main>

    {{-- فوتر --}}
    @if(!isset($hideFooter) || !$hideFooter)
        @include('front.partials.footer')
    @endif

    @if(!isset($hideFooter) || !$hideFooter)
        @include('components.cart-dropdown')
    @endif

    @stack('scripts')

    <script>
        document.body.classList.add('loading');

        window.addEventListener("load", function() {
            const loader = document.getElementById("loader");
            loader.style.opacity = "0";
            document.body.classList.remove('loading');
            
            setTimeout(() => {
                loader.style.display = "none";
            }, 500);
        });
    </script>
    @php
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Restaurant",
            "name" => __('app.name'),
            "image" => asset('assets/images/og-image.webp'), 
            "url" => url('/'),
            "priceRange" => "$$",
            "telephone" => ["09353077797", "02191094044"],
            "servesCuisine" => ["ایرانی", "سنتی"], 
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "ولیعصر، غزایی عتیق، پلاک 29، محله‌ی کشاورز",
                "addressLocality" => "تهران",
                // "postalCode" => "1234567890",
                "addressCountry" => "IR"
            ],
            "menu" => url('/menu'),
            "potentialAction" => [
                "@type" => "ReserveAction",
                "target" => [
                    "@type" => "EntryPoint",
                    "urlTemplate" => url('/reserve'),
                    "actionPlatform" => ["http://schema.org/DesktopWebPlatform", "http://schema.org/MobileWebPlatform"]
                ],
                "result" => [
                    "@type" => "Reservation",
                    "name" => "رزرو میز"
                ]
            ],
            "hasMenu" => [
                ["@type" => "Menu", "name" => "منوی سالن", "url" => url('/menu')],
                ["@type" => "Menu", "name" => "منوی بیرون‌بر", "url" => url('/menu/takeout')],
                ["@type" => "Menu", "name" => "منوی سازمانی", "url" => url('/menu/organizational')]
            ]
        ];
    @endphp

    <script type="application/ld+json">
        @json($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    </script>
</body>
</html>