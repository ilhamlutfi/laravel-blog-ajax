@extends('frontend.layout.main')

@section('title', 'All Category')

@push('meta')
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ilham Lutfi | ilhamlutfi.github.io">
    <meta name="keyword" content="Category MyBlog, Blog Technology">
    <meta name="description" content="MyBlog is a blog that shares knowledge about technology, programming, and web development.">
    <meta property="og:title" content="MyBlog">
    <meta property="og:image" content="contoh.jpg">
    <meta name="image" content="contoh.jpg">
@endpush

@push('css')
@endpush

@push('js')
@endpush

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item active text-dark">All Category</li>
            </ol>
            <div class="row g-4">
                <div class="col-lg-8">
                     <div class="mb-4">
                        <a href="#" class="h1 display-5">All Category</a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-lg-4">
                                        <a href="{{ route('category.show', $category->slug) }}">
                                            <div class="card bg-light mb-3">
                                                <div class="card-body text-center p-4">
                                                    <h5 class="card-title mb-0">{{ $category->name }} ({{ $category->total_articles }})</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @include('frontend.article._side-menu')
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
