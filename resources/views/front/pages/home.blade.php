@extends('front.layouts.app')

@section('content')

@php
    $images = [
        'assets/images/790015.png',
        'assets/images/790636.png',
        'assets/images/792410.png',
        'assets/images/792412.png',
        'assets/images/831644.png',
        'assets/images/839115.png',
        'assets/images/839110.jpg',
        'assets/images/839111.png',
        'assets/images/839112.jpg',
        'assets/images/839116.jpg',
        'assets/images/839119.png',
        'assets/images/8391157.jpg',
    ];
@endphp
@include('front.components.header')
@include('front.components.galley')

@endsection