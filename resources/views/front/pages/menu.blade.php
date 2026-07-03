{{-- resources/views/front/pages/menu.blade.php --}}

<h1 style="color: blue; font-family: Arial;">🍽️ صفحه منوی رستوران</h1>
<p style="font-size: 18px;">این صفحه منوی رستوران است.</p>
<p>زمان فعلی: {{ now() }}</p>
<p>آدرس: {{ request()->url() }}</p>

@php
    $items = ['پیتزا', 'برگر', 'ساندویچ', 'سالاد'];
@endphp

<h3>غذاهای پیشنهادی:</h3>
<ul>
    @foreach($items as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>

{{-- تست اتصال به دیتابیس --}}
@if(isset($categories))
    <p>تعداد دسته‌بندی‌ها: {{ $categories->count() }}</p>
@else
    <p style="color: orange;">⚠️ داده‌ای وجود ندارد (کنترلگر داده ارسال نکرده)</p>
@endif

<p style="margin-top: 20px; color: green;">✅ صفحه با موفقیت بارگذاری شد!</p>