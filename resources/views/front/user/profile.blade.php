@extends('front.layouts.app')

@section('title', 'ویرایش پروفایل')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    
    <h1 class="text-3xl font-bold text-gray-800 mb-8">تنظیمات حساب کاربری</h1>

    {{-- تب‌ها --}}
    <div class="bg-white rounded-lg shadow">
        {{-- اطلاعات کاربری --}}
        @include('front.user.profile-partials.update-profile-information')
        
        <hr class="my-0">
        
        {{-- تغییر رمز عبور --}}
        @include('front.user.profile-partials.update-password')
        
        <hr class="my-0">
        
        {{-- حذف حساب --}}
        @include('front.user.profile-partials.delete-user')
    </div>

</div>
@endsection