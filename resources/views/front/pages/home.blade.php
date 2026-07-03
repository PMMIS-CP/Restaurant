@extends('front.layouts.app')

@section('content')

@php
    $images = [
        'assets/images/790015.webp',
        'assets/images/790636.webp',
        'assets/images/792410.webp',
        'assets/images/792412.webp',
        'assets/images/831644.webp',
        'assets/images/839115.webp',
        'assets/images/839110.webp',
        'assets/images/839111.webp',
        'assets/images/839112.webp',
        'assets/images/839116.webp',
        'assets/images/839119.webp',
        'assets/images/8391157.webp',
    ];
@endphp
@include('front.components.hero')
@include('front.components.about')
@include('front.components.gallery')
@include('front.components.services')
@include('front.components.ceremony')
@include('front.components.cart')
@include('front.components.commetns')
@endsection