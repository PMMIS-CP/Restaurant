@extends('front.layouts.app')

@section('content')

@php
    $images = [
        'assets/images/gallery/6.webp',
        'assets/images/gallery/8.webp',
        'assets/images/gallery/3.webp',
        'assets/images/gallery/4.webp',
        'assets/images/gallery/2.webp',
        'assets/images/gallery/5.webp',
        'assets/images/gallery/7.webp',
        'assets/images/gallery/1.webp',
        'assets/images/gallery/11.webp',
        'assets/images/gallery/9.webp',
        'assets/images/gallery/10.webp',
    ];
@endphp
@include('front.components.hero')
@include('front.components.about')
@include('front.components.gallery')
{{-- @include('front.components.services') --}}
@include('front.components.ceremony')
@include('front.components.spinner')
{{-- @include('front.components.banner') --}}
@include('front.components.commetns')
@endsection