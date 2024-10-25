@extends('frontend.layout.main')

@section('title', 'Home')

@push('meta')
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ilham Lutfi | ilhamlutfi.github.io">
    <meta name="keyword" content="MyBlog, Blog Technology">
    <meta name="description" content="MyBlog is a blog that shares knowledge about technology, programming, and web development.">
    <meta property="og:title" content="MyBlog">
    <meta property="og:image" content="contoh.jpg">
    <meta name="image" content="contoh.jpg">
@endpush

@push('css')
    <link href="{{ asset('assets/frontend') }}/lib/owlcarousel/assets/owl.carousel.min.css"
        rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('assets/frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>
@endpush

@section('content')
{{-- main post --}}
@include('frontend.home.section._main-post')

{{-- banner start --}}
@include('frontend.home.section._banner-start')

{{-- banner start --}}
@include('frontend.home.section._latest-news')

{{-- populer news --}}
@include('frontend.home.section._populer-news')

@endsection
