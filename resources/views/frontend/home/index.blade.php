@extends('frontend.layout.main')

@section('title', 'Home')

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
