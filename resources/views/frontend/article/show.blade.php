@extends('frontend.layout.main')

@section('title', $article->title)

@push('meta')
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ilham Lutfi | ilhamlutfi.github.io">
    <meta name="keyword" content="{{ $article->keywords }}">
    <meta name="description"
        content="{{ Str::limit($article->content, 200, '...') }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:image" content="{{ url(asset('storage/images/'. $article->image)) }}">
    <meta name="image" content="{{ url(asset('storage/images/'. $article->image)) }}">
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
                <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
                <li class="breadcrumb-item active text-dark">{{ $article->title }}</li>
            </ol>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <a href="#" class="h1 display-5">{{ $article->title }}</a>
                    </div>
                    <div class="position-relative rounded overflow-hidden mb-3">
                        <img src="{{ asset('storage/images/' . $article->image) }}"
                            class="img-zoomin img-fluid rounded w-100" alt="{{ $article->title }}">

                        <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                            style="top: 20px; right: 20px;">
                            {{ $article->category->name }}
                        </div>
                    </div>

                    <div class="d-flex">
                        <span class="text-dark link-hover me-3"><i class="fa fa-folder"></i> {{ $article->category->name }}
                            </>
                            <span class="text-dark link-hover me-3"><i class="fa fa-eye"></i> {{ $article->views }}
                                Views</span>
                            <span class="text-dark link-hover me-3"><i class="fa fa-user-edit"></i>
                                {{ $article->user->name }}</span>
                    </div>

                    <p class="mb-4">{{ $article->content }}</p>

                    <div class="tab-class">
                        <div class="d-flex justify-content-between border-bottom mb-4">
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <li class="nav-item mb-3">
                                    <h5 class="mt-2 me-3 mb-0">Tags:</h5>
                                </li>
                                @foreach ($article->tags as $item)
                                    <li class="nav-item mb-3">
                                        <a href="" class="d-flex py-2 bg-light rounded-pill active me-2"
                                            data-bs-toggle="pill" href="#tab-1">
                                            <span class="text-dark" style="width: 100px;">{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="d-flex align-items-center">
                                <h5 class="mb-0 me-3">Share:</h5>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    target="_blank" title="Share on Facebook">
                                    <i
                                        class="fab fa-facebook-f link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}" target="_blank" title="Share on WhatsApp">
                                    <i
                                        class="btn fab fa-whatsapp link-hover btn btn-square rounded-circle border-primary text-dark me-2"></i>
                                </a>

                                <i
                                    class="btn fas fa-copy link-hover btn btn-square rounded-circle border-primary text-dark copy-url" title="Copy URL"></i>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show active">
                                <div class="row g-4 align-items-center">
                                    <div class="col-3">
                                        <img src="https://mubatekno.com/ilham-min.webp" class="img-fluid w-100 rounded"
                                            alt="">
                                    </div>
                                    <div class="col-9">
                                        <h3>{{ $article->user->name }}</h3>
                                        <p class="mb-0">Saya Backend Web Developer berpengalaman dengan keahlian dalam
                                            Laravel, CodeIgniter 4, Adonis Js, Bootstrap, jQuery, MySQL/MariaDB, dan
                                            pengelolaan Server web atau Web hosting. Saya siap untuk memberikan kontribusi
                                            yang berarti dalam proyek Anda dengan keahlian dan semangat yang saya miliki.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    @include('frontend.article._related-article')

                    {{-- comments section --}}
                    {{-- <div class="bg-light rounded p-4">
                        <h4 class="mb-4">Comments</h4>
                        <div class="p-4 bg-white rounded mb-4">
                            <div class="row g-4">
                                <div class="col-3">
                                    <img src="{{ asset('assets/frontend') }}/img/footer-4.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-9">
                                    <div class="d-flex justify-content-between">
                                        <h5>James Boreego</h5>
                                        <a href="#" class="link-hover text-body fs-6"><i
                                                class="fas fa-long-arrow-alt-right me-1"></i> Reply</a>
                                    </div>
                                    <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                        2024</small>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has been
                                        the industry's standard dummy type and scrambled it to make a type specimen book. It
                                        has survived not only five centuries, but also the leap into electronic
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-white rounded mb-0">
                            <div class="row g-4">
                                <div class="col-3">
                                    <img src="{{ asset('assets/frontend') }}/img/footer-4.jpg" class="img-fluid rounded-circle w-100" alt="">
                                </div>
                                <div class="col-9">
                                    <div class="d-flex justify-content-between">
                                        <h5>James Boreego</h5>
                                        <a href="#" class="link-hover text-body fs-6"><i
                                                class="fas fa-long-arrow-alt-right me-1"></i> Reply</a>
                                    </div>
                                    <small class="text-body d-block mb-3"><i class="fas fa-calendar-alt me-1"></i> Dec 9,
                                        2024</small>
                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum has been
                                        the industry's standard dummy type and scrambled it to make a type specimen book. It
                                        has survived not only five centuries, but also the leap into electronic
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded p-4 my-4">
                        <h4 class="mb-4">Leave A Comment</h4>
                        <form action="#">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control py-3" placeholder="Full Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" class="form-control py-3" placeholder="Email Address">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" name="textarea" id="" cols="30" rows="7"
                                        placeholder="Write Your Comment Here"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="form-control btn btn-primary py-3" type="button">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}

                </div>

                @include('frontend.article._side-menu')
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection

@push('js')
    <script>
        $('.copy-url').on('click', function() {
            let currentUrl = window.location.href;

            let tempText = $('<textarea>');

            tempText.val(currentUrl);
            $("body").append(tempText);
            tempText.select();
            document.execCommand("copy");
            tempText.remove();

            alert('URL copied to clipboard');
        });
    </script>
@endpush
