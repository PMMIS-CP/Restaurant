@extends('front.layouts.auth')

@section('title', 'تأیید ایمیل')

@section('page-title', 'تأیید آدرس ایمیل')

@section('content')
    <div class="mt-8 text-sm text-gray-700 space-y-4">
        <p>لینک تأیید به ایمیل شما ارسال شد.</p>
        <p>اگر ایمیل را دریافت نکرده‌اید، روی دکمه زیر کلیک کنید تا دوباره ارسال شود.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mt-4 p-3 bg-green-100 text-green-800 rounded-md text-sm">
            لینک جدید ارسال شد.
        </div>
    @endif

    <div class="mt-6 space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                ارسال دوباره لینک
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-orange-600 bg-white border border-orange-600 hover:bg-orange-50">
                خروج
            </button>
        </form>
    </div>
@endsection