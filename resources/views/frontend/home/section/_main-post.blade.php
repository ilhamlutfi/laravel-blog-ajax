<!-- Main Post Section Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-4">
            {{-- main post --}}
            <div class="col-lg-7 col-xl-8 mt-0">
                {{-- main post --}}
                <div class="position-relative overflow-hidden rounded">
                    <a href="{{ route('articles.show', $main_post->slug) }}">
                        <img src="{{ asset('storage/images/' . $main_post->image) }}"
                            class="img-fluid rounded img-zoomin w-100" alt="{{ $main_post->title }}">
                    </a>
                    <div class="d-flex justify-content-center px-4 position-absolute flex-wrap"
                        style="bottom: 10px; left: 0;">
                        <a href="#" class="text-white me-3 link-hover"><i class="fa fa-folder"></i>
                            {{ $main_post->category->name }}</a>
                        <a href="#" class="text-white me-3 link-hover"><i class="fa fa-eye"></i>
                            {{ $main_post->views }} Views</a>
                        <a href="#" class="text-white link-hover"><i class="fa fa-user-edit"></i>
                            {{ $main_post->user->name }}</a>
                    </div>
                </div>

                <div class="border-bottom py-3">
                    <a href="{{ route('articles.show', $main_post->slug) }}" class="display-4 text-dark mb-0 link-hover">
                        {{ $main_post->title }}
                    </a>
                </div>

                <p class="mt-3 mb-4">
                    {{ Str::limit($main_post->content, 200, '...') }}
                </p>

                {{-- top views --}}
                <div class="bg-light p-4 rounded">
                    <div class="news-2">
                        <h3 class="mb-4">Top Views</h3>
                    </div>
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="rounded overflow-hidden">
                                <img src="{{ asset('storage/images/' . $top_view->image) }}"
                                    class="img-fluid rounded img-zoomin w-100" alt="{{ $top_view->title }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <a href="#" class="h3">{{ $top_view->title }}</a>
                                <p class="mb-0 fs-5"><i class="fa fa-eye"> {{ $top_view->views }} Views</i></p>
                                <p class="mb-0 fs-5"><i class="fa fa-folder"> {{ $top_view->category->name }}</i></p>
                                <p class="mb-0 fs-5">
                                    <i class="fa fa-tag">
                                        @foreach ($top_view->tags as $tag)
                                            {{ $tag->name }},
                                        @endforeach
                                    </i>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- main post all --}}
            <div class="col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 pt-0">
                    <div class="row g-4">
                        <div class="col-12">
                            <p class="text-dark" style="font-size: 18px"><b>Campaign</b></p>

                            <div class="rounded overflow-hidden">
                                <a href="https://www.domainesia.com/cloud-vps/?promo=cloudhandal" target="_blank">
                                    <img src="{{ asset('assets/frontend') }}/img/promo-domainesia.jpg"
                                        class="img-fluid rounded w-100" alt="promo hosting cloud vps">
                                </a>
                            </div>
                        </div>

                        <hr>

                        @foreach ($main_post_all as $item)
                            <div class="col-12">
                                <div class="row g-4 align-items-center">
                                    <div class="col-5">
                                        <div class="overflow-hidden rounded">
                                            <img src="{{ asset('storage/images/' . $item->image) }}"
                                                class="img-zoomin img-fluid rounded w-100" alt="{{ $item->title }}">
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="features-content d-flex flex-column">
                                            <a href="#" class="h6">{{ $item->title }}</a>
                                            <small><i class="fa fa-folder"> {{ $item->category->name }}</i> </small>
                                            <small><i class="fa fa-eye"> {{ $item->views }} Views</i></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Post Section End -->
