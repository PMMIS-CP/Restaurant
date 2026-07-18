<div class="hidden lg:flex absolute top-0 w-full z-10 justify-end">
    <div class="relative w-4/9 h-24 bg-red-900 flex items-center px-10 shadow-xl 
                rounded-none rounded-es-[6rem]">
        <h1 class="text-white text-3xl font-bold">
            {{ __('reserve.desktop.title') }}
        </h1>
        <a href="{{ url('/') }}" class="absolute top-1/2 -translate-y-1/2 h-20 w-20 z-20 end-25 rtl:-translate-x-1/4 ltr:translate-x-1/4">
            <img src="{{ asset('assets/logo/logo.webp') }}" alt="logo" class="h-full w-full object-contain brightness-200">
        </a>
    </div>
</div>

<div class="lg:hidden absolute top-0 w-full z-10 bg-red-900 h-16 flex items-center justify-center shadow-md">
    <h1 class="text-white text-xl font-bold">
        {{ __('reserve.mobile.title') }}
    </h1>
</div>