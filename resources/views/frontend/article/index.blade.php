@extends('frontend.layout.main')

@section('title', 'Articles')

@push('meta')
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ilham Lutfi | ilhamlutfi.github.io">
    <meta name="keyword" content="Articles MyBlog, Blog Technology">
    <meta name="description"
        content="MyBlog is a blog that shares knowledge about technology, programming, and web development.">
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
                <li class="breadcrumb-item active text-dark">Articles</li>
            </ol>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <a href="#" class="h1 display-5">Articles</a>

                        @if ($keyword)
                            <div class="d-flex align-items-center">
                                Displaying articles with keyword: <b>{{ $keyword }}</b>
                            </div>
                            <a href="{{ route('articles.index') }}" class="badge bg-secondary">Reset</a>
                        @endif
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @forelse ($articles as $article)
                                    <div class="col-lg-6">
                                        <div class="latest-news-carousel">
                                            <div class="latest-news-item mb-4">
                                                <div class="bg-light rounded">
                                                    <div class="rounded-top overflow-hidden">
                                                        <a href="{{ route('articles.show', $article->slug) }}">
                                                            <img src="{{ asset('storage/images/' . $article->image) }}"
                                                                class="img-zoomin img-fluid rounded-top w-100"
                                                                alt="{{ $article->title }}">
                                                        </a>
                                                    </div>
                                                    <div class="d-flex flex-column p-4">
                                                        <a href="{{ route('articles.show', $article->slug) }}"
                                                            class="h4">{{ $article->title }}</a>
                                                        <div class="d-flex justify-content-between">
                                                            <a href="#" class="small text-body link-hover">by
                                                                {{ $article->user->name }}</a>
                                                            <small class="text-body d-block"><i
                                                                    class="fas fa-calendar-alt me-1"></i>
                                                                {{ date('d M Y', strtotime($article->published_at)) }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Sorry!</strong> No article found.
                                        </div>
                                    </div>
                                @endforelse

                                <div class="d-flex justify-content-center">
                                    {{ $articles->links() }}
                                </div>
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
