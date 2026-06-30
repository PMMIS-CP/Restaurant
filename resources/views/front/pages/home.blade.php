@extends('front.layouts.app')

@section('title', 'خانه')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-cover bg-center h-96 flex items-center justify-center text-white"
             style="background-image: url('https://via.placeholder.com/1920x600?text=Restaurant+Hero');">
        <div class="text-center bg-black bg-opacity-50 p-8 rounded-lg">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">به {{ config('app.name') }} خوش آمدید</h1>
            <p class="text-lg mb-6">طعمی که هرگز فراموش نمی‌کنید</p>
            <a href="#" class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-full font-semibold transition">
                مشاهده منو
            </a>
        </div>
    </section>

    {{-- Featured Items --}}
    <section class="py-16 container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">غذاهای ویژه</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- نمونه کارت غذا --}}
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x250?text=Food+1" alt="غذا" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">غذای شماره ۱</h3>
                    <p class="text-gray-600 mt-2">توضیح کوتاه</p>
                    <span class="text-orange-600 font-bold mt-2 inline-block">۵۰,۰۰۰ تومان</span>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x250?text=Food+2" alt="غذا" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">غذای شماره ۲</h3>
                    <p class="text-gray-600 mt-2">توضیح کوتاه</p>
                    <span class="text-orange-600 font-bold mt-2 inline-block">۶۵,۰۰۰ تومان</span>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x250?text=Food+3" alt="غذا" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">غذای شماره ۳</h3>
                    <p class="text-gray-600 mt-2">توضیح کوتاه</p>
                    <span class="text-orange-600 font-bold mt-2 inline-block">۷۵,۰۰۰ تومان</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section class="bg-orange-600 text-white py-12 text-center">
        <h2 class="text-3xl font-bold mb-4">میز رزرو کنید</h2>
        <p class="mb-6">برای تجربه‌ای به‌یادماندنی با ما تماس بگیرید</p>
        <a href="#" class="bg-white text-orange-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
            رزرو میز
        </a>
    </section>
@endsection